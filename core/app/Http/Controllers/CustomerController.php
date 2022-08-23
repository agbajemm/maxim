<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomerController extends Controller
{

    /**
     * Create new customer
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

        return response()->json([
            'status'=> "success",
            'message'=> 'Customer Created',
            'customer'=> [
            'name'=> $customer->name,
            'phone'=> $customer->phone_no,
            'email'=> $customer->email,
            ]
        ],200);
    }

    /**
     * Display Customers
     */
    public function display(Request $request)
    {
        $customers = Customer::all();
        return response()->json([
            'status'=> "success",
            'data' => $customers
        ],200);
    }

    /**
     * Update Customer
     */
    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'phone_no' => 'required|numeric',
            'budget' => 'required|numeric',
            'message' => 'required|string',
            ]);

        $id = DB::table('customers')->where('email', $request->email)->first();

        $customer = Customer::find($id->id);
        $customer->name = $request->name;
        $customer->phone_no = $request->phone_no;
        $customer->budget = $request->budget;
        $customer->message = $request->message;
        $customer->update();

        return response()->json([
            'status'=> "success",
            'message'=> 'Customer Updated',
            'customer'=> [
            'name'=> $customer->name,
            'phone'=> $customer->phone_no,
            'email'=> $customer->email,
            ]
        ],200);
    }

    /**
     * Delete Customer
     */
    public function delete(Request $request)
    {
        DB::table('customers')->where('email', $request->email)->delete();
        return response()->json([
            'status'=> "success",
            'message'=> 'Customer Deleted',
        ],200);
        $databaseName = \DB::connection()->getDatabaseName();
    }
    public function dbInfo()
    {
        $databaseName = \DB::connection()->getDatabaseName();
        $tables = DB::select('SHOW TABLES');
        $customers = Schema::getColumnListing('customers');
        $failed_jobs = Schema::getColumnListing('failed_jobs');
        $migrations = Schema::getColumnListing('migrations');
        $password_resets = Schema::getColumnListing('password_resets');
        $personal_access_tokens = Schema::getColumnListing('personal_access_tokens');
        $users = Schema::getColumnListing('users');

        return response()->json([
            'status'=> "success",
            'data'=> [
                "database name" => $databaseName,
                "tables" => $tables,
                "customers" => $customers,
                "failed_jobs" => $failed_jobs,
                "migrations" => $migrations,
                "password_resets" => $password_resets,
                "personal_access_tokens" => $personal_access_tokens,
                "users" => $users,
            ],
        ],200);
        
    }
}