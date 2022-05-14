<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate();

        return view('dashboard', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'phone_no' => 'required|numeric',
            'budget' => 'required|numeric',
            'message' => 'required|string',
            ]);
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->phone_no = $request->phone_no;
        $customer->email = $request->email;
        $customer->budget = $request->budget;
        $customer->message = $request->message;
        $customer->save();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findorfail($id);
        return view('view', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
    public function createProfile($id)
    {
        $customer = Customer::findorfail($id);
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://localhost/elegant-wp/wp-json/wp/v2/users', [
                'auth' => [
                    'admin', 
                    'elegant1$'
                ],
                'form_params' => [
                    'username' => "$customer->name",
                    'email' => "$customer->email",
                    'password' => "$customer->name,$customer->phone_no",
                    'url' => "http://localhost/elegant/customer/$customer->id",
                ]
            ]);
        
        return redirect()->back();
    }
}
