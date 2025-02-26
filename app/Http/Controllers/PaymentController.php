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
            'start-month' => ['nullable', 'date_format:m-d-Y'],
            'end-month' => ['nullable', 'date_format:m-d-Y'],
            'start-year' => 'nullable|integer|min:2024|max:2030',
            'end-year' => 'nullable|integer|min:2024|max:2030',
        ]);

        $cart = Cart::findOrFail($cart->id);
        if ($request->hasFile('reference_image')) {
            $filePath = $request->file('reference_image')->store('payments', 'public');
            $cart->reference_image = $filePath;
        }

        $startMonth = ($cart->status !== 'Paid' && $request->filled('start-month'))
            ? \Carbon\Carbon::createFromFormat('m-d-Y', $request->input('start-month'))->format('Y-m-d')
            : $cart->start_month;

        $endMonth = ($cart->status !== 'Paid' && $request->filled('end-month'))
            ? \Carbon\Carbon::createFromFormat('m-d-Y', $request->input('end-month'))->format('Y-m-d')
            : $cart->end_month;

        $startYear = ($cart->status !== 'Paid' && $request->filled('start-year'))
            ? $request->input('start-year')
            : $cart->start_year;

        $endYear = ($cart->status !== 'Paid' && $request->filled('end-year'))
            ? $request->input('end-year')
            : $cart->end_year;
        if ($cart->status !== 'Paid' && $request->filled('plan')) {
            $cart->plan = $request->plan;
        }

        $cart->payment_option = $request->payment_option;
        $cart->start_month = $startMonth;
        $cart->end_month = $endMonth;
        $cart->start_year = $startYear;
        $cart->end_year = $endYear;
        $cart->total_payment = $request->total_payment;
        $cart->down_payment = $request->down_payment;

        if ($request->total_payment == 0.00) {
            $cart->status = 'Paid';
        } else {
            $cart->status = 'Pending';
        }
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
