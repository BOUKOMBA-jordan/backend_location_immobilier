<?php

namespace App\Http\Controllers;



class PictureController extends Controller
{
    public function index(int $propertyId) 
    {
        return view('property-mage.index');
    }
}