<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\Pets;

class SearchController extends Controller
{
    public function search(Request $request){

        $searchResults = (new Search())
        ->registerModel(Pets::class, 'name')
        ->search($request->get('search')); 
        return view('search', compact('searchResults'));

    }
}