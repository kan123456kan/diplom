<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
public function index(Request $request)
{
    $id = $request->id;
    $product = DB::table('products')->join(
        'categories',
        'categories.id',
        '=',
        'products.product_type'
    )->where('products.id', $id)
    ->first();

    if (!is_null($product)) {
        $product->id = intval($id);

        $similarProducts = $this->showSimilarProducts($product->id);

        return view('product', [
            'product' => $product,
            'similarProducts' => $similarProducts
        ]);
    } else {
        return abort(404);
    }
}

    public function getProducts(Request $request){
        $products = DB::table('products')->join(
            'categories',
            'categories.id',
            '=',
            'products.product_type'
        )->select(
            'products.id as id',
            'products.*',
            'categories.product_type as product_type'
        )->get();
        return view('admin.products', ['products'=>$products]);
    }

    public function getProductById(Request $request){
        $id=$request->id;
        $categories = DB::table('categories')->get();
        $product = DB::table('products')->join(
            'categories',
            'categories.id',
            '=',
            'products.product_type'
        )->select(
            'products.id as id',
            'products.*',
            'categories.product_type as product_type',
        )->where('products.id',$id)->first();

        if (!is_null($product)){
            return view('admin.product-edit', ['categories' => $categories, 'product'=>$product]);
        }else {
            return abort(404);
        }
    }

    public function editProduct(Request $request, $id){

        $product = DB::table('products')->where('id', $id)->first();

        if($request->hasFile('img')) {

            $imgPath = $request->file('img')->store('images', 'public');
        } else {

            $imgPath = $product->img;
        }


        DB::table('products')->where('id', $id)->update([
            'title'=> $request->input('title'),
            'qty'=> $request->input('qty'),
            'price'=> $request->input('price'),
            'product_type'=> $request->input('category'),
            'img'=> $imgPath ?   $imgPath : '',
            'country'=> $request->input('country'),
            'flavor'=> $request->input('flavor'),
            'rating'=> $request->input('rating'),
            'updated_at'=> now()
        ]);


        return redirect()->route('admin.products');
    }

    public function createProductView(){
        $categories = DB::table('categories')->get();
        return view('admin.product-create', ['categories'=>$categories]);
    }

    public function deleteProduct(Request $request){
        $product = DB::table('products')->where('id', $request->id);
        $product->delete();
        return redirect()->route('admin.products');
    }

    public function createProduct(Request $request){
        $imgPath = null;
        if($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('images', 'public');
        }

        DB::table('products')->insert([
            'title'=> $request->input('title'),
            'qty'=> $request->input('qty'),
            'price'=> $request->input('price'),
            'product_type'=> $request->input('category'),
            'img'=> $imgPath ? 'storage/' . $imgPath : '',
            'country'=> $request->input('country'),
            'flavor'=> $request->input('flavor'),
            'rating'=> $request->input('rating'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP')
        ]);

        return redirect()->route('admin.products');
    }

    public function showSimilarProducts($productId)
    {
        $product = DB::table('products')->where('id', $productId)->first();

        $similarProducts = DB::table('products')
        ->where('product_type', $product->product_type)
        ->where('id', '!=', $productId)
        ->limit(4)
        ->get();

        return $similarProducts;
    }
}