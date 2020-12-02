<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Search\SearchRepository;

class SearchController extends Controller
{

    private $searchRepository;

    public function __construct(SearchRepository $searchRepository)
    {

        $this->searchRepository = $searchRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->searchRepository->index();
        return response()->json($result);
    }

}
