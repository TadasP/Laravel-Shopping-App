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

    public function ajaxSearch(Request $request)
    {

        if(strlen($request->q) > 2){
            $output='<nav class="navbar navbar-default"><ul class="nav navbar-nav">';

            $productResult = Product::
            where('name', 'LIKE', "%{$request->q}%")->
            orWhere('description', 'LIKE', "%{$request->q}%")->
            where('active', 1)->
            paginate(6);

            foreach($productResult as $product){
                $route = route('frontproducts.show', $product->id);
                $output.= '<li class="nav-item pl-2"><a href="'.$route.'">'.$product->name.'</li>'.
                '</br>';
            }

            $shopResult = Shop::
            where('shop_name', 'LIKE', "%{$request->q}%")->
            where('active', 1)->
            paginate(3);

            foreach($shopResult as $shop){
                $route = route('shopping.show', $shop->id);
                $output.= '<li class="nav-item pl-2"><a href="'.$route.'">'.$shop->shop_name.'</li>'.
                '</br>';
            }

            $postResult = Post::
            where('title', 'LIKE', "%{$request->q}%")->
            orWhere('content', 'LIKE', "%{$request->q}%")->
            where('active', 1)->
            paginate(3);

            foreach($postResult as $post){
                $route = route('frontposts.show', $post->id);
                $output.= '<li class="nav-item pl-2"><a href="'.$route.'">'.$post->title.'</li>'.
                '</br>';
            }

            $output.= '</ul></nav>';

            /* if(count($productResult) == 0 && count($postResult) == 0 && count($shoptResult) == 0){
                $output = '';
            } */
        }else{
            $output = '';
        }
        
        return response($output);
    }

}