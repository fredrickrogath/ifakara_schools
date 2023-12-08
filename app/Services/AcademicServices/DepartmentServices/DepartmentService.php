<?php

namespace App\Services\AcademicServices\DepartmentServices;
use Illuminate\Support\Facades\Hash;

class DepartmentService
{
    /*
    |--------------------------------------------------------------------------
    | QUERIES FOR THE INVOICE
    |--------------------------------------------------------------------------
    */

    // public function addStaff($request){
    //     $created = \App\Models\User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'role' => $request->identifier,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     if($created){
    //         return true;
    //     }
    //     return false;
    // }

    public function getStaffs(){
        return \App\Models\User::where('school_id', auth()->user()->school_id)->orderBy('name', 'asc')->get();
    }

    public function getStaffsNew(){
        return \App\Models\User::where('school_id', auth()->user()->school_id)->orderBy('created_at', 'desc')->get();
    }

    public function headDashboardGetStaffs(){
        return \App\Models\User::where('school_id', auth()->user()->school_id)->orderBy('created_at', 'desc')->get();
    }
    
    // public function getInvoiceView($request){
    //     return \App\Models\Invoice::with('tools', 'seller', 'toolSum', 'invoiceTool.tool')->where('status', true)->where('id', $request->id)->orderBy('created_at', 'desc')->first();
    // }

    public function getDepartments(){
        return \App\Models\Department::where('school_id', auth()->user()->school_id)->orderBy('created_at', 'desc')->get();
    }

    // public function getStaffs(){
    //     return \App\Models\User::where('role', '!=', 1)->orderBy('name', 'asc')->get();
    // }

    // public function getStaffsNew(){
    //     return \App\Models\User::where('role', '!=', 1)->orderBy('created_at', 'desc')->get();
    // }

    // public function getInvoiceView($request){
    //     return \App\Models\Invoice::with('tools', 'seller', 'toolSum', 'invoiceTool.tool')->where('status', true)->where('id', $request->id)->orderBy('created_at', 'desc')->first();
    // }

    // public function getDepartments(){
    //     return \App\Models\Department::orderBy('created_at', 'desc')->get();
    // }

    // public function getStudents(){
    //     return \App\Models\Student::orderBy('created_at', 'desc')->get();
    // }

    // public function headDashboardGetStaffs(){
    //     return \App\Models\User::where('school_id', auth()->user()->school_id)->orderBy('created_at', 'desc')->get();
    // }
    
    // public function acceptInvoice($request){
    //     return \App\Models\Invoice::find($request->id)->update([
    //         'status_from_financial' => !$request->status_from_financial,
    //     ]);
    // }

    // public function deleteInvoice($request){
    //     return \App\Models\Invoice::findoRFail($request->id)->delete();
    // }

    // public function starredInvoices($request){
    //     return \App\Models\Invoice::find($request->id)->update([
    //         $request->column => !$request->data
    //     ]);
    // }

    // public function starredInvoice($request){
    //     return \App\Models\Invoice::find($request->id)->update([
    //         $request->column => !$request->data
    //     ]);
    // }

    // public function getTrashedInvoices(){
    //     return \App\Models\Invoice::onlyTrashed()->with('tools', 'seller', 'toolSum', 'invoiceTool.tool')->orderBy('created_at', 'desc')->get();
    // }

    // public function getStarredInvoices(){
    //     return \App\Models\Invoice::with('tools', 'seller', 'toolSum', 'invoiceTool.tool')->where('starred', true)->where('status', true)->orderBy('created_at', 'desc')->get();
    // }

    // public function restoreInvoice($request){
    //     return \App\Models\Invoice::onlyTrashed()->findoRFail($request->id)->restore();
    // }

    // public function permanentDeleteInvoice($request){
    //     return \App\Models\Invoice::onlyTrashed()->findoRFail($request->id)->forceDelete();
    // }
}