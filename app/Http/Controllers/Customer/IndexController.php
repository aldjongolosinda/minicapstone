<?php

namespace App\Http\Controllers\Customer;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Instrument;
use App\Models\OrderItem;
use App\Models\User;

class IndexController extends Controller
{
    public function landing(){
        $categories = Category::all();
        return view('customer.product-category', compact('categories'));
    }

    public function productCategory(){
        $categories = Category::all();

        return view('customer.product-category', compact('categories'));
    }

    public function allUser(){
        $users = User::all();

        return view('admin.allusers', compact('users'));
    }
//    create order, cancel order

}
