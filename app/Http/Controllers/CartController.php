<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('cart.index', ['products' => $request->input()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkoutCart(Request $request)
    {
        $validator = Validator::make(
            $request->input(),
            [
                'first_name' => 'required|string|min:3',
                'second_name' => 'required|string|min:3',
                'email' => 'required|email',
            ]
        );

        if ($validator->fails()) {
            return back()->withInput($request->input())->withErrors($validator->getMessageBag()->getMessages());
        }

        if($request->products) {
            DB::transaction(function () use ($request) {
                $order = Order::create([
                    'customer_name' => $request->get('first_name'),
                    'customer_second_name' => $request->get('second_name'),
                    'customer_email' => $request->get('email'),
                ]);
                $orderDetails = [];
                foreach ($request->products as $id => $count) {
                    $orderDetail = OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $id,
                        'count' => $count,
                    ]);
                    $orderDetails[]= $orderDetail;
                }

                $service = new TelegramService();
                $service->setOrderInfo($order, $orderDetails);
            });

        }

        return redirect()->route('main.index');
    }
}
