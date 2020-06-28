<?php

namespace App\Http\Controllers\FrontEnd;
use App\Category;
use App\Http\Controllers\Controller;

use App\Product;
use View;
use App\Config;
use Session;

class FrontEndController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $CONF = Config::find(1);
        View::share('CONF',$CONF);
        $lastCat = Category::selectRaw('categories.name,count(products.id) as totalProduct')
            ->join('products','products.category_id','categories.id')
            ->where('categories.deleted',0)
            ->where('products.deleted',0)
            ->orderBy('categories.id','desc')
            ->groupBy('categories.id')
            ->limit(4)
            ->get();

        $randProducts = Product::select('id','image')
            ->active()
            ->limit(9)
            ->inRandomOrder()
            ->get();
        $categories = Category::selectRaw('categories.id,categories.name,count(products.id) as total')
            ->join('products','products.category_id','categories.id')
            ->where('categories.deleted',0)
            ->where('products.deleted',0)
            ->groupBy('categories.id','categories.name')
            ->orderBy('id','asc')
            ->get();
        View::share('CONF',$CONF);
        View::share('lastCategories',$lastCat);
        View::share('randProducts',$randProducts);
        View::share('resultCategories',$categories);

        $carts = [];
        Session::put('carts',$carts);
        Session::put('totalCart',0);
    }
}
