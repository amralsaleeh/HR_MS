<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportAttendance;
use App\Models\Attendee;

class AttendanceController extends Controller
{

        public function import(Request $request){

        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx'
           ]);

        Excel::import(new ImportAttendance,
                      $request->file('file')->store('files'));


         return back()->with('success', 'Excel Data Imported successfully.');
  }
}
