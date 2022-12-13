<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportEmployee;
use App\Models\Employee;


class EmployeeController extends Controller
{

    public function import2(Request $request){

        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx'
           ]);


        Excel::import(new ImportEmployee,
                      $request->file('file')->store('files'));

        // $this->dispatchBrowserEvent('show_confirm_form', ['message' => 'Attendance Data Imported successfully.']);
        return back()->with('success', 'Excel Data Imported successfully.');
  }

}
