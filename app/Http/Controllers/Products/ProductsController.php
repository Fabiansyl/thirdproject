<?php

namespace App\Http\Controllers\Products;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Models\Product\Cart;
use App\Models\Product\Order;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function singleCategory($id){
        $validated = validator(['id' => $id], ['id' => 'required|integer']);
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated);
        }
        
        $products = Product::where('category_id', $id)->orderBy('id', 'desc')->get();
        return view('products.singlecategory', compact('products'));
    }

    public function singleProduct($id){
        $validated = validator(['id' => $id], ['id' => 'required|integer']);
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated);
        }

        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->get();
        $checkInCart = Cart::where('prod_id', $id)
            ->where('user_id', Auth::id())
            ->count();

        return view('products.singleproduct', compact('product', 'relatedProducts', 'checkInCart'));
    }

    public function shop(){
        $categories = Category::orderBy('id', 'desc')->get();
        $cashcrops = Product::where('category_id', 4)->orderBy('id', 'desc')->take(5)->get();
        $vegetables = Product::where('category_id', 3)->orderBy('id', 'desc')->take(5)->get();
        $fruits = Product::where('category_id', 2)->orderBy('id', 'desc')->take(5)->get();
        $cereals = Product::where('category_id', 1)->orderBy('id', 'desc')->take(5)->get();

        return view('products.shop', compact('categories', 'cashcrops', 'vegetables', 'fruits', 'cereals'));
    }
 
 
    public function addToCart(Request $request){
        
        $request->validate([
            'prod_id' => 'required|integer|exists:products,id',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'name' => 'required|string|max:255',
        ]);
    
        try {
            $cart = new Cart();
            $cart->name = $request->name;
            $cart->user_id = Auth::id();
            $cart->prod_id = $request->prod_id;
            $cart->qty = $request->qty;
            $cart->price = $request->price;
    
            
            $cart->save();
    
    
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        } catch (\Exception $e) {
           
            return redirect()->back()->with('error', 'Failed to add product to cart.');
        }
    }
    

    public function cart(){
        $cartProducts = Cart::where('user_id', Auth::id())->get();
        return view('products.cart', compact('cartProducts'));
    }

    public function deleteFromCart($id){
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cartItem->delete();

        return redirect()->route('products.cart')->with(['delete' => 'Product deleted from cart Successfully']);
    }

    public function prepareCheckout(Request $request){
        $validated = $request->validate(['price' => 'required|numeric']);
        Session::put('value', $validated['price']);
        $newPrice = Session::get('value');

        return $newPrice > 0 ? redirect()->route('products.checkout') : redirect()->back()->with(['error' => 'Invalid price']);
    }

    public function checkout(){
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $checkoutSubtotal = $cartItems->sum(function ($product) {
            return $product->price * $product->qty;
        });

        $shippingPrice = 2500;
        return view('products.checkout', compact('cartItems', 'checkoutSubtotal', 'shippingPrice'));
    }

    public function processCheckout(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'price' => 'required|numeric',
        ]);

        $checkoutData = [
            "name" => $validated['name'],
            "last_name" => $validated['last_name'],
            "address" => $validated['address'],
            "town" => $validated['town'],
            "state" => $validated['state'],
            "zip_code" => $validated['zip_code'],
            "email" => $validated['email'],
            "phone_number" => $validated['phone_number'],
            "price" => $validated['price'],
            "user_id" => Auth::id(),
        ];

        $checkout = Order::create($checkoutData);

        return $checkout 
            ? redirect()->route('products.pay') 
            : redirect()->back()->with(['error' => 'Checkout failed']);
    }

    public function payWithPaypal(){
        

        echo"Welcome to paymaent portal";
       //return view('products.checkout', compact('cartItems', 'checkoutSubtotal', 'shippingPrice'));
    }
}
