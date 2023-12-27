<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Carservice;
class PackageController extends Controller
{
    public function index()
    {
        $package = Package::orderby('id', 'desc')->get();
        return view('package.list', compact('package'));
    }
    public function create()

    {
        $carservice = CarService::all();
        return view('package.create',compact('carservice'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required|unique:packages,package_name',
        ],
        [
            'package_name.unique' =>'This Package Already Exist'
        ]
    );

        $data = $request->except('token');

        Package::create($data);
        return redirect()->route('packages.index')->withMessage('Package Added Successfully');
    }
    public function edit(Package $package)

    {
        $carservice = CarService::all();
        return view('package.edit', compact('package','carservice'));
    }
    public function update(Request $request, Package $package)

    {

        $request->validate(
            [
                'package_name' => 'required|unique:packages,package_name,' . $package->id . '',
            ],
            [
                'package_name.unique' =>'This Package Already Exist'
            ]
        );

        $data = $request->except('token');
        $package->update($data);
        return redirect()->route('packages.index')->withMessage('Package Updated Successfully');
    }
    public function destroy(Package $package)
    {
        $package->delete();
        session()->flash('message', 'Record Deleted Successfully');
        //  return redirect()->route('cardetail.index');
    }
    public function show(Package $package)
    {
        return response()->json(['package' => $package]);
    }
}
