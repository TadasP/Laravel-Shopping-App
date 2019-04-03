<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Post;
use App\Shop;

class SearchController extends Controller
{
    public function frontResults(Request $request)
    {
        
        $searchNeedle = $request->q;

        if(strlen($searchNeedle) <= 3){
            $data['error'] = 'Specify your query';
        } 

        $postResult = Post::
        where('title', 'LIKE', "%{$searchNeedle}%")->
        orWhere('content', 'LIKE', "%{$searchNeedle}%")->
        where('active', 1)->
        get();

        $shopResult = Shop::
        where('shop_name', 'LIKE', "%{$searchNeedle}%")->
        where('active', 1)->
        get();

        $productResult = Product::
        where('name', 'LIKE', "%{$searchNeedle}%")->
        orWhere('description', 'LIKE', "%{$searchNeedle}%")->
        where('active', 1)->
        paginate(6);
        
        $productResult->appends(['q' => $request->q]);

        $data['posts'] = $postResult;
        $data['shops'] = $shopResult;
        $data['products'] = $productResult;
        $data['searchNeedle'] = $searchNeedle;

        return view('front.search.results', $data);
    }

}