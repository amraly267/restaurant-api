<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\PrintInvoiceRequest;
use App\Meal;
use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\Reservations;

class OrderController extends Controller
{
    public function placeOrder(OrderRequest $request)
    {
        $reservation = Reservations::find($request->reservation_id);
        $order = Order::create([
            'table_id' => $reservation->table_id,
            'reservation_id' => $request->reservation_id,
            'customer_id' => $request->customer_id,
            'waiter_id' => $request->waiter_id,
            'total' => 0,
            'paid' => false,
        ]);

        $this->placeOrderDetail($order, $request->meals);
        return response()->json(['status' => 'success', 'order' => $order]);
    }

    private function placeOrderDetail($order, $meals)
    {
        foreach($meals as $orderMeal)
        {
            $meal = Meal::find($orderMeal);
            OrderDetail::create([
                'order_id' => $order->id,
                'meal_id' => $meal->id,
                'amount_to_pay' => $meal->price - $meal->discount,
            ]);
        }

        $order->total = OrderDetail::where('order_id', $order->id)->sum('amount_to_pay');
        $order->save();
    }

    public function printInvoice(PrintInvoiceRequest $request)
    {
        $invoice = [];
        $order = Order::find($request->order_id);

        foreach($order->detail as $index => $detail)
        {
            $invoice[$index]['meal_name'] = $detail->meal->description;
            $invoice[$index]['meal_price'] = $detail->meal->price;
            $invoice[$index]['meal_discount'] = $detail->meal->discount;
            $invoice[$index]['meal_total'] = $detail->meal->price - $detail->meal->discount;
        }

        $invoice['total'] = $order->total;
        return response()->json($invoice);
    }
}
