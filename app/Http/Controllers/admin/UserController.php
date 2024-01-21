<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Remark;


class UserController extends Controller
{
    public function index(){
        return view('admin.login');
      }
      public function authenticateUser(Request $request)
      {
          $request->validate([
              'email' => 'required|email',
              'password' => 'required',
          ]);
  
          if (Auth::guard('admin')->attempt(['email'=> $request->email, 'password' => $request->password], $request->get('remember'))) {
  
            $admin = Auth::guard('admin')->user();
  
            $request->session()->flash('success', '🎉🎉 You login successfully!!');
            
            return redirect()->route('admin.dashboard');
              
    }
      // Authentication failed
      return back()->with('error','Invalid Credential !!');
      }

      public function Dashboards(){
        $employee = Employee::latest('id');
        
        $employee = $employee->paginate();
        $data['employee'] = $employee;
      return view('admin.dashboard', $data);
      }

      public function Logout () {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login'); 
       }
    

       public function edit($employeeId, Request $req) {
        $employee = Employee::findOrFail($employeeId);
       
        if(empty($employee)){
          return redirect()->route('admin.dashboard');
        }
        return view('admin.remark', ['employee' => $employee]);
    
       }
       
       public function addRemark(Request $request, $employeeId)
       {
        
         $validated =  $request->validate([
               'remark' => 'required',
           ]);
   
           $employee = Employee::findOrFail($employeeId);
           if(empty($employee)){
            return redirect()->route('admin.dashboard');
          }
          $remark = new Remark ;
          $remark->employee_id = $employeeId;
          $remark->remark = $validated['remark'];
          
          $remark->save();
          
          $request->session()->flash('success', 'Remark added successfully');
          
           return redirect()->route('admin.dashboard')->with('success', 'Remark added successfully.');
       }
       public function getRemark($employeeId){
        $remarks = Remark::where('employee_id', $employeeId)->get();
    
        $data['remarks'] = $remarks;
        return response()->json([
          'status' => true,
         $data,
      ]);
       }
}