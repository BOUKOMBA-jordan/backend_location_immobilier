<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;

use function Laravel\Prompts\password;

//use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        $properties = Property::with('pictures')->available()->recent()->limit(4)->get();
        $user = User::first();
        $user->password = '0000';
       // dd($user->password, $user);
        return view('home', ['properties' => $properties]);
    }
}