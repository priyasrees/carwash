<?php

namespace App\Http\Controllers;

use App\Models\Carservice;
use Illuminate\Http\Request;

class CarServiceController extends Controller
{
    public function index()
    {
        $carservice = Carservice::orderby('id', 'desc')->get();
        return view('car_service.list', compact('carservice'));
    }
    public function create()

    {
        return view('car_service.create');
    }
    public function store(Request $request)

    {

        $request->validate([
            'car_service_name' => 'required',
        ]);
        $id = $request->input('id');

        if (!empty($id) && $id !== "0") {
            $duplicate = Carservice::where('car_service_name', $request->input('car_service_name'))
                ->where('id', '!=', $id)
                ->get();
        } else {
            $duplicate = Carservice::where('car_service_name', $request->input('car_service_name'))
                ->get();
        }

        if (count($duplicate) > 0) {
            session()->flash('error', 'This Car Service Already Exist');
            return redirect()->back()->withInput()->withErrors(['error' => 'This Car Service Already Exist']);
        }
        $data = $request->except('token');
        if (!empty($id) && $id !== "0") {
            $carDetail = CarService::find($id);

            $carDetail->update($data);
            return redirect()->route('carservices.index')->withMessage('Car Service Updated Successfully');
        } else {
            CarService::create($data);
            return redirect()->route('carservices.index')->withMessage('Car Service Added Successfully');
        }
    }
    public function edit(Carservice $carservice)

    {
        return view('car_service.edit', compact('carservice'));
    }
    public function update(Request $request, Carservice $carservice)

    {

        $request->validate(
            [
                'car_service_name' => 'required|unique:carservices,car_service_name,' . $carservice->id . '',
            ],
            [
                'car_service_name.unique' => 'This Service Already Exist'
            ]

        );
        $data = $request->except('token');
        $carservice->update($data);
        return redirect()->route('carservices.index')->withMessage('Car Service Updated Successfully');
    }
    public function destroy(Carservice $carservice)
    {
        $carservice->delete();
        session()->flash('message', 'Record Deleted Successfully');
        //  return redirect()->route('cardetail.index');
    }
}
