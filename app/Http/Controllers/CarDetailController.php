<?php

namespace App\Http\Controllers;

use App\Models\CarDetail;
use Illuminate\Http\Request;

class CarDetailController extends Controller
{
    public function index()
    {
        //qw
        $cardetail = CarDetail::orderby('id', 'desc')->get();
        return view('car_details.list', compact('cardetail'));
    }
    public function create()

    {
        return view('car_details.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'car_name' => 'required',
            'car_model' => 'required'
        ]);
        // $id = $request->input('id');

        // if (!empty($id) && $id !== "0") {
        //     $duplicate = CarDetail::where('car_name', $request->input('car_name'))
        //         ->where('car_model', $request->input('car_model'))
        //         ->where('id', '!=', $id)
        //         ->get();
        // } else {
            $duplicate = CarDetail::where('car_name', $request->input('car_name'))
                ->where('car_model', $request->input('car_model'))
                ->get();


        if (count($duplicate) > 0) {
            session()->flash('error', 'This Car Name and Model Already Exist');
            return redirect()->back()->withInput()->withErrors(['error' => 'This Car Name and Model Already Exist']);
        }
        $data = $request->except('token');
        // if (!empty($id) && $id !== "0") {
        //     $carDetail = CarDetail::find($id);

        //     $carDetail->update($data);
        //     return redirect()->route('cardetail.index')->withMessage('Car Details Updated Successfully');
        // } else {
            CarDetail::create($data);
            return redirect()->route('cardetail.index')->withMessage('Car Details Saved Successfully');

    }
    public function edit(CarDetail $cardetail)

    {
        return view('car_details.edit', compact('cardetail'));
    }
    public function update(Request $request, CarDetail $cardetail)

    {

        $request->validate(
            [
                'car_name' => 'required',
                'car_model'=>'required'
            ]

        );
        $duplicate = CarDetail::where('car_name', $request->input('car_name'))
        ->where('car_model', $request->input('car_model'))
        ->where('id', '!=', $cardetail->id)
        ->get();
        if(count($duplicate) > 0){
            session()->flash('error', 'This Car Name and Model Already Exist');
            return redirect()->back()->withInput()->withErrors(['error' => 'This Car Name and Model Already Exist']);

        }
        $data = $request->except('token');
        $cardetail->update($data);
        return redirect()->route('cardetail.index')->withMessage('Car Details Updated Successfully');
    }
    public function destroy(CarDetail $cardetail)
    {
        $cardetail->delete();
        session()->flash('message', 'Record Deleted Successfully');
        //  return redirect()->route('cardetail.index');
    }
    public function show(CarDetail $cardetail)
    {
        return response()->json(['cardetail' => $cardetail]);
    }
}
