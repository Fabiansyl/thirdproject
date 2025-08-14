<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:25'],
            'town' => ['required', 'string', 'max:30'],
            'state' => ['required', 'string', 'max:35'],
            'zip_code' => ['required', 'integer', 'regex:/^\d{1,10}$/'],
            'phone_number' => ['required', 'string', 'regex:/^\d{1,15}$/'],
            // regex pattern for secure password
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'town' => $data['town'],
            'state' => $data['state'],
            'zip_code' => $data['zip_code'],
            'phone_number' =>$data['phone_number'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
