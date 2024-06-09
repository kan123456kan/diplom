<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function getProducts(Request $request){
        $query = DB::table('products')->where('qty', '>', 0);

        $countries = DB::table('products')->select('country')->distinct()->pluck('country');

        if ($request->query('sort_by')) {
            $sortField = $request->query('sort_by');
            $sortOrder = $request->query('sort_by_desc') ? 'desc' : 'asc';
            $query->orderBy($sortField, $sortOrder);
        }

        if ($country = $request->query('country')) {
            $query->where('country', $country);
        }

        if ($request->query('filter')) {
            $filterValue = $request->query('filter');
            $query->where('product_type', $filterValue);
        }

        $productsPerPage = 8;
        $totalProducts = $query->count();
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $productsPerPage;
        $products = $query->offset($offset)->limit($productsPerPage)->get();

        $categories = DB::table('categories')->get();

        $params = collect($request->query());

        return view('catalog', [
            'products' => $products,
            'countries' => $countries,
            'categories' => $categories,
            'params' => $params,
            'currentPage' => $currentPage,
            'totalProducts' => $totalProducts,
            'productsPerPage' => $productsPerPage
        ]);
    }
}
