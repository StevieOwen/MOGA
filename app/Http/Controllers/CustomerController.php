<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function showFormation(){
        return view('customer/formations');
    }

    public function showAnnonces(){
        return view('customer/annonces');
    }
}

