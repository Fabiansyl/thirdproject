<?php

namespace App\Http\Controllers;

use App\Models\Product\category;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  /*  public function __construct()
    {
        $this->middleware('auth');
    }
*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $cashcrops = Product::where('category_id', 4)->orderBy('id', 'desc')->take(5)->get();
        $vegetables = Product::where('category_id', 3)->orderBy('id', 'desc')->take(5)->get();
        $fruits = Product::where('category_id', 2)->orderBy('id', 'desc')->take(5)->get();
        $cereals = Product::where('category_id', 1)->orderBy('id', 'desc')->take(5)->get();

        return view('products.shop', compact('categories', 'cashcrops', 'vegetables', 'fruits', 'cereals'));
    }
}
