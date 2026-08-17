<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::query()
            ->with([
                'seller.sellerProfile',
                'items',
            ])
            ->where('buyer_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('buyer.orders.index', compact(
            'orders'
        ));
    }
}
