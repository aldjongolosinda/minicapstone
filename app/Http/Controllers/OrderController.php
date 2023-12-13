<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Events\UserLog;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    // show all orders
    public function index(){
        $orders = Order::all();
        // $instruments = Instrument::where('category_id', $category->id)->get();
        return view('orders.index', compact('orders'));
    }

    // user orders only
    public function userOrders(User $user){
        $orders = Order::where('user_id', $user->id)->get();

        return view('customer.my_orders', compact('orders'));
    }

    //create order
    public function createOrder(Request $request, Instrument $instrument){


        // dd($request->all);
        $request->validate([
            'user_id'               => 'required|exists:users,id',
            'instrument_id'         => 'required|exists:instruments,id',
            'order_quantity'        => 'required|integer|min:1',
            'total_price'           => 'required|numeric',
            'status'                => 'required|string',
        ]);

        if ($instrument->instrument_quantity == 0) {
            return back()->with('error', 'No available. Please check another one.');
        } else {

            $instrument->decrement('instrument_quantity', 1);

            $order = Order::create([
                'user_id'           => $request->input('user_id'),
                'instrument_id'     => $instrument->id,
                'order_quantity'    => 1,
                'total_price'       => $instrument->price,
                'status'            => 'pending',
            ]);

            $log_entry = Auth::user()->name . " ordered : " . $instrument->name . " with order id# " . $order->id;
            event(new UserLog($log_entry));

            return back()->with('message', 'Order successful. Please check "My Orders".');
        }
    }

    public function editOrder(Order $order){

        return view('orders.edit', compact('order'));
    }

    public function updateOrder(Request $request, Order $order){

        $order->update([
            'status'     => 'confirmed',
        ]);

        $log_entry = Auth::user()->name . " confirmed its order.";
            event(new UserLog($log_entry));

        return back()->with('message', 'Please prepare the exact amount upon delivery.');

    }

    public function receiveOrder(Order $order){

        $order->update([
            'status'     => 'received',
        ]);

        $log_entry = "Order delivered.";
            event(new UserLog($log_entry));

        return back()->with('success', 'Received');

    }

    public function orders(Instrument $instruments){
        // dd($instruments);
        return view('customer.instrument_category', compact('instruments'));
    }

    public function deleteOrder(Order $orders){

        $log_entry = Auth::user()->name . " cancelled the order.";
            event(new UserLog($log_entry));

        $instruments = $orders->instrument;

        // $totalOrderQuantity = $orders->sum('order_quantity');

        $instruments->increment('instrument_quantity', 1);
        $orders->delete();

        if(Auth::user()->isAdmin){
            return redirect('/all-orders')->with('message', 'Order deleted');

        }else {
            return back()->with('message', 'Order canceled');
        }
    }


}
