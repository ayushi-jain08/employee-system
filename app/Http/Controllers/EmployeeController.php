<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function create(EmployeeRequest $request){
        $validated = $request->validated();
        
        $file = $request->file('photo');
        $fileName = time(). '.'. $file->getClientOriginalName();
    
        $filePath = $file->storeAs('images', $fileName, 'public');
        
        $employee = new Employee;
        $employee->name = $validated['name'];
        $employee->father_name = $validated['father_name'];
        $employee->mobile = $validated['mobile'];
        $employee->dob = $validated['dob'];
        $employee->applied_for = $validated['applied_for'];
        $employee->email = $validated['email'];
        $employee->photo = $filePath;
        
       $employee->save();
        
       return response()->json([
         'status' => true,
         'message' => 'employee registered successfully',
     ]);
    
    }
}