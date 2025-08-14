<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Product\category;
use App\Models\Product\Order;
use App\Models\Product\Product;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AdminsController extends Controller
{
    public function viewLogin(){

        return view('admins.login');
    }

    public function checkLogin(Request $request){

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            
            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
        return view('admins.login');
    }

    public function index(){
        $productsCount = Product::select()->count();
        $ordersCount =  Order::select()->count();
        $categoriesCount = category::select()->count();
        $adminsCount = Admin::select()->count();
        $expiredProducts = Product::where('is_expired', true)->get();
    
        return view('admins.index', compact('productsCount', 'ordersCount', 'categoriesCount', 'adminsCount', 'expiredProducts'));
    }
    
    public function displayAdmins(){
        
        $allAdmins = Admin::all();
    
        return view('admins.allAdmins',compact('allAdmins'));
    }

    public function createAdmins(){

        return view('admins.createAdmins');
    }
    
    
    public function storeAdmins(Request $request){
            
        $validator = FacadesValidator::make($request->all(), [
            'email' => 'required|email|unique:admins,email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/',
        ]);

        if ($validator->fails()) {
            
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $storeAdmins = Admin::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        if ($storeAdmins) {
            return Redirect::route('admins.all')->with('success', 'Admin Added successfully');
        }

        return Redirect::back()->with('error', 'Failed to add Admin');
}

public function displayCategories(){

    $allCategories = category::select()->orderBy('id','desc')->get();

    return view('admins.allcategories',compact('allCategories'));
}


public function createCategories(){

    return view('admins.createCategories');
}


public function storeCategories(Request $request){
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048', //  file validation
    ]);

    try {
        // Handle file uploads
        $imagePath = $request->file('image')->store('images', 'public');

        // Create a new category
        $category = Category::create([
            'name' => $validatedData['name'],
            'image' => $imagePath,
        ]);

        // Check if the category was created successfully
        if ($category) {
            return redirect()->route('categories.all')->with('success', 'Category added successfully');
        }
    } catch (\Exception $e) {
       
        return redirect()->back()->with('error', 'Failed to add category. Please try again.');
    }

    return redirect()->back()->with('error', 'Failed to add category.');
}

public function displayCategory($id){
   
    $showcategory = category::find($id);
    return view('admins.singlecategory',compact('showcategory'));
}

public function updateCategory(Request $request, $id){
    $request->validate([
        'name' => 'required|string|max:255',
        
    ]);
    $updatecategory = category::find($id);
    
    if (!$updatecategory) {
        // Handle the case where the category is not found, e.g., redirect or show an error message
        abort(404, 'Category not found');
    }

    // Update the category data
    $updatecategory ->update($request->all());

    // Redirect back to the categories page with a success message
    return redirect()->route('categories.all')->with('update', 'Category Updated Successfully');
   
}

public function deleteFromCategory($id){
    
    $deletecategory = category::where('id',$id);
    
    if (!$deletecategory) {
        // Handle the case where the category is not found, e.g., redirect or show an error message
        abort(404, 'Category not found');
    }

    // Update the category data
    $deletecategory ->delete();

    // Redirect back to the categories page with a success message
    return redirect()->route('categories.all')->with('delete', 'Category Deleted Successfully');
   
}

public function displayProducts(){

    $products = Product::select()->orderBy('id','desc')->get();

    return view('admins.allproducts',compact('products'));
}


public function showCreateProductForm() {
    $categories = category::select()->orderBy('id')->get();
    return view('admins.createProducts', compact('categories'));
}

public function storeProducts(Request $request){
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'required|string|max:2048',
        'category_id' => 'required|integer|exists:categories,id',
        'exp_date' => 'required|date|after_or_equal:tomorrow',
        'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Handle file uploads
    $imagePath = $request->file('image')->store('images', 'public');

    // Determine if the product is expired
    $isExpired = $validatedData['exp_date'] < now();

    // Create a new product
    $addProduct = Product::create([
        'name' => $validatedData['name'],
        'price' => $validatedData['price'],
        'description' => $validatedData['description'],
        'category_id' => $validatedData['category_id'],
        'exp_date' => $validatedData['exp_date'],
        'image' => $imagePath,
        'is_expired' => $isExpired,
    ]);

    // Check if the product was created successfully
    if ($addProduct) {
        if ($isExpired) {
            return redirect()->route('products.all')->with('warning', 'Product added successfully, but its expiration date has already passed. Please review.');
        } else {
            return redirect()->route('products.all')->with('success', 'Product added successfully');
        }
    } else {
        return redirect()->back()->withErrors('Failed to add product');
    }
}


public function deleteProducts($id) {
    // Find the product by ID
    $product = Product::findOrFail($id);

    // Delete the product
    $product->delete();

    // Redirect with a success message
    return redirect()->route('products.all')->with('success', 'Product deleted successfully');
}

public function displayOrders(){

    $allOrders = Order::select()->orderBy('id','desc')->get();

    return view('admins.allOrders',compact('allOrders'));
}

public function editOrders(Request $request) {
    $orderId = $request->input('id');
    $order = Order::find($orderId); 
    return view('admins.editOrders', compact('order'));
}

public function updateOrders(Request $request, $id){
    $request->validate([
        'status' => 'required|string|max:255',
        
    ]);
    $order = Order::find($id);
    
    if (!$order) {
        // Handle the case where the category is not found, e.g., redirect or show an error message
        abort(404, 'Status not found');
    }

    // Update the category data
    $order ->update($request->all());

    // Redirect back to the categories page with a success message
    return redirect()->route('orders.all')->with('update', 'Order Updated Successfully');
   
}

public function removeExpiredProducts()
{
    $expiredProducts = Product::whereDate('exp_date', '<', now())->get();

    foreach ($expiredProducts as $product) {
        $product->delete();
    }

    return redirect()->route('products.all')->with('success', 'Expired products removed successfully.');
}

}
