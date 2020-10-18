<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Category $category)
    {
        $products = Product::where(['category_id' => $category->id]);

        if($request->has('orderBy') && $request->get('orderBy') != 'default') {
            $orderBy = explode('-', $request->get('orderBy'));
            $products->orderBy($orderBy[0], $orderBy[1]);
        }
        $products = $products->paginate(12);

        return view('category.show', compact('products', 'category'));
    }
}
