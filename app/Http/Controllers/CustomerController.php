<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
public function index(){
    $customer = Customer::orderby('id', 'desc')->get();
    return view('customer.list', compact('customer'));
}
public function create(){
    return view('customer.create');
}
public function store(Request $request){
    $request->validate([
        'customer' => 'required|string',
        'email' => 'required|email',
        'mobile' => [
            'required',
            'numeric',
            'digits:10',
            'regex:/^[1-9]\d*$/',
            Rule::unique('customers', 'mobile'),
        ],
        'address'=>'required|string'],
[

    'mobile.unique'=>'Mobile Number Already Exists'
]

);
     $data = $request->except('token');

    Customer::create($data);
    return redirect()->route('customers.index')->withMessage('Customer Saved Successfully');

}
public function edit(Customer $customer)

{
    return view('customer.edit', compact('customer'));
}
public function update(Request $request, Customer $customer){
    $request->validate([
        'customer' => 'required|string',
        'email' => 'required|email',
        'mobile' => [
            'required',
            'numeric',
            'digits:10',
            'regex:/^[1-9]\d*$/',
            Rule::unique('customers', 'mobile')->ignore($customer->id), // $customerId is the ID of the current record
        ],
        'address'=>'required|string'
    ],
[
    'mobile.unique'=>'Mobile Number Already Exists'
]
);
     $data = $request->except('token');

     $customer->update($data);
    return redirect()->route('customers.index')->withMessage('Customer Details Updated Successfully');
}
public function destroy(Customer $customer)
    {
        $customer->delete();
        session()->flash('message', 'Record Deleted Successfully');
    }
}
