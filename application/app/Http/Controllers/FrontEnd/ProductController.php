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
        $products = Product::with(['subCategory.category'])
                    ->limit(8,0);

        if(!empty($filter->price)){
            $ep = explode('-',$filter->price);
            $products->where('price','>=',$ep[0]);
            $products->where('price','<=',$ep[1]);
        }
        if(!empty($filter->label)){
            $products->where('label',$filter->label);
        }
        /*if(!empty($filter->category)){
            $products->subCategory->category->where('id',$filter->category);
        }*/
        if(!empty($filter->keyword)){
            $products->where('name','like','%'.$filter->keyword.'%');
        }
        if(!empty($filter->subCategory)){
            $subCategory = $filter->subCategory;
            $products->whereHas('subCategory', function ($query) use ($subCategory) {
                $query->where('subcategories.id',$subCategory);
            });
        }
        if(!empty($filter->sort)){
            $ex = explode('-',$filter->sort);
            $products->orderBy($ex[0],$ex[1]);
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
        $products = Product::with('subCategory.category')
            ->limit(8)
            ->offset($offset)
            ->orderBy('created_at','desc')
            ->get();
        foreach ($products as $product){
            $product->price = number_format($product->price);
            $product->stock= number_format($product->stock);
            $product->color = explode(',',$product->color);
            $product->size = explode(',',$product->size);
            $product->images = json_decode($product->images)[0];
            $product->label = $product->label;
            $product->labelText = Constant::PRODUCT_LABELS[$product->label];
            $category = [];
            foreach($product->subCategory as $sub){
                array_push($category,strtolower(trim($sub->category->name)).'-'.$sub->category->id);
            }
            $product->category = implode(' ',$category);
        }
        return Response::json($products);
    }

    public function detail($id)
    {
        $product = Product::with(['subCategory.category','city.province'])->find($id);
        $product->price = number_format($product->price);
        $product->stock= number_format($product->stock);
        $product->color = explode(',',$product->color);
        $product->size = explode(',',$product->size);
        $product->images = json_decode($product->images);
        $category = [];

        $subCategory = [];
        foreach ($product->subCategory as $sub) {
            array_push($subCategory, $sub->id);
            array_push($category,'<a href="'.route('product').'?category='.$sub->category->id.'">'.ucwords($sub->category->name).'</a>');
        }
        $related = SubCategory::with('product')
                    ->whereIn('id',$subCategory)
                    ->get();
        $relatedProduct = [];

        foreach ($related as $rel) {
            foreach ($rel->product as $key => $prd) {
                if($key<5 && $prd->id != $id){
                    $data['id'] = $prd->id;
                    $data['name'] = $prd->name;
                    $data['price'] = number_format($prd->price);
                    $data['stock'] = number_format($prd->stock);
                    $data['image'] = json_decode($prd->images)[0];
                    array_push($relatedProduct, (object) $data);
                }
            }
        }
        //echo json_encode($relatedProduct);
        return view('frontend.products.detail',[
            'product' => $product,
            'category' => $category,
            'related' => $relatedProduct
        ]);
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



