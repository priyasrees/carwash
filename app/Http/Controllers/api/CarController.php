<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarDetail;

class CarController extends Controller
{
    public function index()
    {
        $cardetail = CarDetail::orderby('id', 'desc')->get();
        return response()->json([
            'message' => 'Success',
            'List' => $cardetail
        ]);
    }
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'car_name' => 'required',
            'car_model'=>'required',
            'car_type' => 'required|numeric',
        ], [
            'car_type.numeric' => 'This Car Type Must Be a Number'
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error' => $validator->errors()
                ],
                422
            );
        }
        $car_type = $request->input('car_type');
        //check that value inside in array
        if (!in_array($car_type, [0,1, 2])) {
            return response()->json(
                [
                    'status' => true,
                    'error' => 'This Car Type Field Should Be 0,1,2'
                ]
            );
        }
        $duplicate = CarDetail::where('car_name', $request->input('car_name'))
            ->where('car_model', $request->input('car_model'))
            ->get();
        if (count($duplicate) > 0) {
            return response()->json([
                'status' => false,
                'Error' => "This Car Name and Model Already Exist"
            ]);
        }
        $car = CarDetail::create($request->all());
        return response()->json([
            'status' => true,
            'id' => $car->id
        ]);
    }
    public function update(Request $request,$id)
    {
        $cardetail = CarDetail::find($id);

        if(!$cardetail){
            return response()->json([
                'status' => false,
                'message' => 'Id Not Found'
            ]);
        }

        $validator = validator($request->all(), [
            'car_name' => 'required',
            'car_model'=>'required',
            'car_type' => 'required|numeric',
        ], [
            'car_type.numeric' => 'This Car Type Must Be a Number'
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error' => $validator->errors()
                ],
                422
            );
        }
        $car_type = $request->input('car_type');
        //check that value inside in array
        if (!in_array($car_type, [0,1, 2])) {
            return response()->json(
                [
                    'status' => true,
                    'error' => 'This Car Type Field Should Be 0,1,2'
                ]
            );
        }
        $duplicate = CarDetail::where('car_name', $request->input('car_name'))
        ->where('car_model', $request->input('car_model'))
        ->where('id', '!=', $id)
        ->get();
        if (count($duplicate) > 0) {
            return response()->json([
                'status' => false,
                'Error' => "This Car Name and Model Already Exist"
            ]);
        }

        $cardetail->update($request->all());
        return response()->json([
            'status' => true,
            'id' => $id
        ]);
    }
    public function destroy($id)
    {
        $cardetail = CarDetail::find($id);

        if(!$cardetail){
            return response()->json([
                'status' => false,
                'message' => 'Id Not Found'
            ]);
        }
        $cardetail->delete();
        return response()->json([
            'status' => true,
            'id' => $id,
            'message'=>'Deleted'
        ]);
    }
}
