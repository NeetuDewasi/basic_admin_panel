<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function get_all_customers()
    {
        $customers = Customer::orderBy('id', 'DESC')->get();

        return response()->json([
            'all_customers' => $customers
        ], 200);
    }
    public function createCustomer(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();
        if ($customer)
            return response()->json([
                'status' => 'error',
                'message' => 'This Customer already exist'
            ], 500);
        $image = '';
        if ($request->hasFile('photo')) {
            $image = '/storage/' . $request->file('photo')->store('customer/avatar');
        }

        $create = Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'photo' => $image,
            'address' => $request->address
        ]);
        if ($create) {
            return response()->json([
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Customer Created successfully'
            ]);
        }

        return response()->json([
            'status_code' => 401,
            'status' => 'error',
            'message' => 'Something Went Wrong'
        ]);
    }
    public function getCustomerOnEdit($customer_id)
    {
        // Check if $customer_id is received
        if (!$customer_id) {
            return response()->json([
                'error' => 'Customer ID is missing'
            ], 400);
        }

        // Try fetching the customer from the database
        $customer = Customer::where('id', $customer_id)->first();

        // Check if customer exists
        if (!$customer) {
            return response()->json([
                'error' => 'Customer not found'
            ], 404);
        }

        // Return the customer data
        return response()->json([
            'customer' => $customer
        ], 200);
    }
    public function customerUpdate($customer_id, Request $request)
    {
        $customer = Customer::find($customer_id);
        if (!$customer)
            return response()->json([

                'message' => 'This Customer does not exist'
            ], 404); // 404 for not found
        $image = '';
        if ($request->hasFile('photo')) {
            $image = '/storage/' . $request->file('photo')->store('customer/avatar');
        }
        $update = $customer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => (int) $request->mobile,
            'email' => $request->email,
            'photo' => $image,
            'address' => $request->address
        ]);

        return response()->json([
            'message' => 'Customer Updated successfully'
        ], 200);
    }

    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $delete = $customer->delete();
        }
        if ($delete)
            return response()->json([
                'message' => 'Customer deleted successfully'
            ], 200);

        return response()->json([
            'status_code' => 401,
            'status' => 'error',
            'message' => 'Something Went Wrong'
        ]);
    }
}
