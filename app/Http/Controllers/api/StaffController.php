<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::orderby('id', 'desc')->get();
        return response()->json([
            'message' => 'Success',
            'List' => $staff
        ]);
    }
}
