<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $package = Package::orderby('id', 'desc')->get();
        return response()->json([
            'message' => 'Success',
            'List' => $package
        ]);
    }
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'package_name' => 'required|unique:packages,package_name',
            'package_amount' => 'required|numeric',
            'valid_days' => 'required|numeric',
            'validity' => 'required|numeric'
        ], [
            'package_name.unique' => 'This Package Already Exists',
            'package_amount.numeric' => 'Package Amount Accept Only Number',
            'valid_days' => 'Valid Days Accept Only Number',
            'validity' => 'Validity Accept Only 0 or 1'
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error' => $validator->errors()
                ],
                422
            );
        }
        // $validity = strtolower($request->input('validity'));//check case insensitive
        $validity = $request->input('validity');
        if (!in_array($validity, ['0', '1'])) {
            return response()->json([
                'status' => false,
                'error' => 'Validity Field Should Be 0 or 1'
            ]);
        }
        $package = Package::create([
            'package_name' => $request->package_name,
            'package_amount' => $request->package_amount,
            'valid_days' => $request->valid_days,
            'validity' => $request->validity,
        ]);
        return response()->json([
            'status' => true,
            'id' => $package->id
        ]);
    }
    public function update(Request $request, $id)
    {
        $valid_id = Package::find($id);

        if(!$valid_id){
            return response()->json([
                'status' => false,
                'message' => 'Id Not Found'
            ]);
        }
        $validator = validator($request->all(), [
            'package_name' => 'required|unique:packages,package_name,' . $id . '',
            'package_amount' => 'required|numeric',
            'valid_days' => 'required|numeric',
            'validity' => 'required|numeric'
        ], [
            'package_name.unique' => 'This Package Already Exists',
            'package_amount.numeric' => 'Package Amount Accept Only Number',
            'valid_days' => 'Valid Days Accept Only Number',
            'validity' => 'Validity Accept Only 0 or 1'
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error' => $validator->errors()
                ],
                422
            );
        }
        // $validity = strtolower($request->input('validity'));//check case insensitive
        $validity = $request->input('validity');
        if (!in_array($validity, ['0', '1'])) {
            return response()->json([
                'status' => false,
                'error' => 'Validity Field Should Be 0 or 1'
            ]);
        }
        $package =  Package::find($id);
        $package->update([
            'package_name' => $request->package_name,
            'package_amount' => $request->package_amount,
            'valid_days' => $request->valid_days,
            'validity' => $request->validity,

            // 'validity'=>($request->valid_days > 1)?$request->validity.'s':$request->validity,
        ]);
        return response()->json([
            'status' => true,
            'id' => $id
        ]);
    }
    public function destroy($id)
    {
        $package = Package::find($id);

        if (!$package) {
            return response()->json([
                'status' => false,
                'message' => 'Id Not Found'
            ]);
        }
        $package->delete();
        return response()->json([
            'status' => true,
            'id' => $id,
            'message' => 'Deleted'
        ]);
    }
}
