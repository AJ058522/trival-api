<?php

namespace App\Transformers;

class ItunesTransformer
{    
    static function transform(object $data, string $media): object
    {
        $data = (array) $data;

        $type = '';

        switch ($media) {
            case 'music':
                $type = 'Canciones';
            break;
            case 'movie':
                $type = 'Películas';
            break;
            case 'ebook':
                $type = 'Documentos';
            break;
          }
        
        $img = '';
        
        if(isset($data['artworkUrl30'])){

            $img = $data['artworkUrl30'];

        }else if(isset($data['artworkUrl60'])){

            $img = $data['artworkUrl60'];
        }

        return (object)[
            'name' => $data['trackName'],
            'img' => $img,
            'type' => $type,
            'source' => 'https://itunes.apple.com/'
        ];
    }

}
