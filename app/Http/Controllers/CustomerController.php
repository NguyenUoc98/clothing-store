<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Facades\File;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all(); 
        return view('customer.index',compact('customers'));
    }

  
    public function create()
    {
        return view('customer.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|unique:customers,phone',
            'address' => 'required|string',
            'password' => 'required|string|min:6',  // Validate mật khẩu
        ]);
    
        $customer = new Customer;
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');
        $customer->password = bcrypt($request->input('password'));  // Mã hóa mật khẩu
    
        $customer->save();
        return redirect()->back()->with('status', 'Create successful customers');
    }
   

   
    public function edit(Customer $customer,$id)
    {
        $customers = Customer::find($id); 
        return view ('customer.edit',compact('customers'));
    }

    
    public function update(Request $request, $id)
    {
        $customers = Customer::find($id); 
    
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required|unique:customers,phone,' . $id,
            'address' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);
    
        $customers->name = $request->input('name');
      // {
    //     //  $customers->email = $request->input('email');
        $customers->phone = $request->input('phone');
        $customers->address = $request->input('address');
    
        if ($request->filled('password')) {
            $customers->password = bcrypt($request->input('password'));
        }
    
        $customers->update();
        return redirect()->back()->with('status', 'Update successful customers');
    }

 
    public function destroy(Customer $customer,$id)
    {
        $customers = Customer::find($id); 
        $customers->delete();
        return redirect()->back()->with('status', 'Delete successful customers');

    }
}
