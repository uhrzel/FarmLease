<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class PaymentController extends Controller
{
    public function processPayment(Request $request, Cart $cart)
    {
        $request->validate([
            'payment_option' => 'required',
            'plan' => 'nullable',
            'total_payment' => 'required|numeric|min:0',
            'down_payment' => 'required|numeric|min:0',
            'reference_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start-month' => 'nullable|integer|min:1|max:12',
            'end-month' => 'nullable|integer|min:1|max:12',
            'start-year' => 'nullable|integer|min:2024|max:2030',
            'end-year' => 'nullable|integer|min:2024|max:2030',
        ]);

        $cart = Cart::findOrFail($cart->id);
        if ($request->hasFile('reference_image')) {
            $filePath = $request->file('reference_image')->store('payments', 'public');
            $cart->reference_image = $filePath;
        }

        $cart->payment_option = $request->payment_option;
        $cart->plan = $request->plan ?? null;
        $cart->start_month = $request->input('start-month');
        $cart->end_month = $request->input('end-month');
        $cart->start_year = $request->input('start-year');
        $cart->end_year = $request->input('end-year');
        $cart->total_payment = $request->total_payment;
        $cart->down_payment = $request->down_payment;
        $cart->status = ($request->total_payment == 0.00) ? 'Paid' : 'Pending';
        $cart->save();

        if ($cart->status === 'Pending') {
            return redirect()->back()->with('warning', 'Payment successful! You have a remaining balance of ₱' . number_format($request->total_payment, 2));
        } else if ($cart->status === 'Paid') {
            return redirect()->back()->with('success', 'Payment successful! Your balance is fully paid.');
        } else {
            return redirect()->back()->with('error', 'Payment failed! Please try again.');
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}
