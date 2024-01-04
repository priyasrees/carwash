<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Validation\Rule;
use App\Models\Customer;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::orderby('id', 'desc')->get();
        return view('staff.list', compact('staff'));
    }
    public function create()
    {
        $customer = Customer::all();
        return view('staff.create', compact('customer'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'staff' => 'required|string',
                'mobile' => [
                    'required',
                    'numeric',
                    'digits:10',
                    'regex:/^[1-9]\d*$/',
                    Rule::unique('staff', 'mobile'),
                ],
                'address' => 'required|string'
            ],
            [

                'mobile.unique' => 'Mobile Number Already Exists'
            ]

        );
        $customer_ids = $request->customer_id;
        foreach ($customer_ids as $customer_id) {
            $existingStaff = Staff::whereRaw("FIND_IN_SET(?, customer_id)", [$customer_id])->first();
            if ($existingStaff) {
                $customer_name = Customer::where('id',$customer_id)->first();
                // Handle the case where the customer is already assigned
                return redirect()->back()->withInput()->withErrors(['error' => "$customer_name->customer is already assigned to another staff member."]);
            }

        }

        $data = $request->except('token');
        Staff::create([
            'staff' => $request->staff,
            'customer_id' => implode(',', $request->customer_id),
            'mobile' => $request->mobile,
            'address' => $request->address
        ]);
        //Staff::create($data);
        return redirect()->route('staff.index')->withMessage('Staff Saved Successfully');
    }
    public function edit(Staff $staff)
    {
        $customer = Customer::all();
        return view('staff.edit', compact('staff', 'customer'));
    }
    public function update(Request $request, Staff $staff)
    {
        $request->validate(
            [
                'staff' => 'required|string',
                'mobile' => [
                    'required',
                    'numeric',
                    'digits:10',
                    'regex:/^[1-9]\d*$/',
                    Rule::unique('staff', 'mobile')->ignore($staff->id), // $customerId is the ID of the current record
                ],
                'address' => 'required|string'
            ],
            [
                'mobile.unique' => 'Mobile Number Already Exists'
            ]
        );
        $customer_ids = $request->customer_id;
        foreach ($customer_ids as $customer_id) {
            $existingStaff = Staff::whereRaw("FIND_IN_SET(?, customer_id)", [$customer_id])->where('id','!=',$staff->id)->first();

            if ($existingStaff) {
                $customer_name = Customer::where('id',$customer_id)->first();
                // Handle the case where the customer is already assigned
                return redirect()->back()->withInput()->withErrors(['error' => "$customer_name->customer is already assigned to another staff member."]);
            }

        }

        //    $data = $request->except('token');
        $staff->staff = $request->staff;
        $staff->mobile = $request->mobile;
        $staff->customer_id = implode(',', $request->customer_id);
        $staff->address = $request->address;
        $staff->update();
        //  $staff->update($data);
        return redirect()->route('staff.index')->withMessage('Staff Updated Successfully');
    }
    public function destroy(Staff $staff)
    {
        $staff->delete();
        session()->flash('message', 'Record Deleted Successfully');
    }
    public function assign_customer(Staff $staff)
    { //assign customer to staff

        $staff = Staff::get();
        $stateCounts = [];

        foreach ($staff as $customer) {
            $stateIds = explode(',', $customer->customer_id);
            $uniqueStateIds = array_unique($stateIds);
            $stateCounts[$customer->id] = count($uniqueStateIds);
        }

        return view('staff.assign_customer', compact('staff', 'stateCounts'));
    }
    public function reassign_customer($id)
    { //$id refers staff table primary id
        $get_customer_list = Staff::where('id', $id)->first();
        $customer = Customer::whereIn('id', explode(',', $get_customer_list->customer_id))
            ->get();
        $staff = Staff::where('id','!=', $id)->get();
        return view('staff.reassign_customer', compact('id', 'get_customer_list', 'customer', 'staff'));
    }
    public function assignstaff(Request $request)
    {
        $customer_id = $request->customer_id;
        $assigned_staff_id = $request->assigned_staff_id;
        $check_exist_cuid =  Staff::where('id', $assigned_staff_id)->first();
        //convert string to array
        $remove_cusid = explode(',', $check_exist_cuid->customer_id);
        $remove_exist = array_diff($remove_cusid, [$customer_id]);
        $conv_arr_str = implode(',', $remove_exist);

        //remove customer_id from exist staff record
        Staff::where('id', $request->assigned_staff_id)->update(['customer_id' => $conv_arr_str]);


        $get_cus_id = Staff::where('id', $request->staff_id)->first();
        $update_cus_id = $get_cus_id->customer_id . ',' . $customer_id;
        Staff::where('id', $request->staff_id)->update(['customer_id' => $update_cus_id]);
        $get_cus_name = Customer::where('id', $customer_id)->first();
        $staff_name = Staff::where('id', $request->staff_id)->first();

        return redirect()->back()->withMessage('' . $get_cus_name->customer . ' Customer Successfully Reassigned To ' . $staff_name->staff . '');
    }
}
