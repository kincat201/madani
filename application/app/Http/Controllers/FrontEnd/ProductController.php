<?php

namespace App\Http\Controllers\FrontEnd;

use App\Util\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Product;
use App\Category;
use Response;

use Session;

class ProductController extends FrontEndController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $filter)
    {
        $filter = (object)Input::all();
        $products = Product::with(['category','unit','variants'])->limit(8,0);

        if(!empty($filter->keyword)){
            $products->where('name','like','%'.$filter->keyword.'%');
        }
        $categories = Category::get();
        return view('frontend.products.product',[
            'products' => $products->get(),
            'categories' => $categories,
            'filter' => $filter
        ]);
    }

    public function loadMore(){
        $filter = (object)Input::all();
        $offset = (@$filter->page*8)+1;
        $products = Product::with(['category','unit','variants'])
            ->limit(8)
            ->offset($offset)
            ->orderBy('created_at','desc')
            ->get();
        foreach ($products as $product){
            $product->price = number_format($product->prices());
            $product->qty= number_format($product->qty);
            $product->image = $product->image;
            $product->category = 'cat-'.$product->category_id;
        }
        return Response::json($products);
    }

    public function productPreview($id){
        $product = Product::with(['category','unit','variants'])->find($id);
        $product->price = number_format($product->prices());
        $product->stock= number_format($product->qty);
        return Response::json($product);
    }

    public function productCategory($id){
        $category = SubCategory::select('id','name')
                    ->where('categoryId',$id)
                    ->get();
        return Response::json($category);
    }
}



