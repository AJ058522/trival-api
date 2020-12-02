<?php

namespace App\Repositories\Search;

use Illuminate\Support\Facades\Http;

use App\Transformers\CrcindTransformer;
use App\Transformers\ItunesTransformer;
use App\Transformers\TvmazeTransformer;

class SearchRepository implements SearchRepositoryInterface
{

    public function index()
    {

        $term = (request()->has('term')) ? request()->term : '';
        $ebook = $this->itunesSearch($term, 'ebook');
        $movie = $this->itunesSearch($term, 'movie');
        $music = $this->itunesSearch($term, 'music');
        $crcind =  $this->crcindSearch($term);
        $tvmaze = $this->tvmazeSearch($term);

        $data = array_merge($ebook, $movie, $music, $crcind, $tvmaze);
        $data = collect($data);
        return $data->sortBy->name->values();
    }

    private function itunesSearch(string $term, string $media)
    {

        $response = Http::get('https://itunes.apple.com/search?term=' . $term . '&media=' . $media);
        $data = json_decode($response->body());
        $transformedData = array();

        if ($data->results) {
            foreach ($data->results as $row) {
                array_push($transformedData, ItunesTransformer::transform($row, $media));
            }
        }

        return $transformedData;
    }

    private function tvmazeSearch(string $term)
    {

        $response = Http::get('http://api.tvmaze.com/search/shows?q=' . $term);
        $data = json_decode($response->body());
        $transformedData = array();

        if (count($data) > 0) {
            foreach ($data as $row) {
                array_push($transformedData, TvmazeTransformer::transform($row));
            }
        }

        return $transformedData;
    }

    private function crcindSearch(string $term)
    {

        $response = Http::get('http://www.crcind.com/csp/samples/SOAP.Demo.cls?soap_method=GetByName&name=' . $term);
        $xml = $this->removeNamespaceFromXML($response->body());
        $xml = simplexml_load_string($xml);
        $elementos = $xml->xpath('SOAP-ENV:Body');
        $data = $elementos[0]->GetByNameResponse->GetByNameResult->diffgram->ListByName;
        $transformedData = array();

        foreach ($data->SQL as $row) {
            array_push($transformedData, CrcindTransformer::transform($row));
        }

        return $transformedData;
    }

    function removeNamespaceFromXML($xml)
    {
        $toRemove = ['diffgr', 'diffgram'];
        $nameSpaceDefRegEx = '(\S+)=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?';

        foreach ($toRemove as $remove) {
            $xml = str_replace('<' . $remove . ':', '<', $xml);
            $xml = str_replace('</' . $remove . ':', '</', $xml);
            $xml = str_replace($remove . ':commentText', 'commentText', $xml);
            $pattern = "/xmlns:{$remove}{$nameSpaceDefRegEx}/";
            $xml = preg_replace($pattern, '', $xml, 1);
        }

        return $xml;
    }
}
