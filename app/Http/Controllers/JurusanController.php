<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Major;
class JurusanController extends Controller
{
    //
    public function index()
    {
        $major = Major::all();
    	return view('admin/Jurusan/index',compact('major'));
 
    }

    public function create(Request $request)
    {
        Major::create($request->all());
        return redirect()->back();
    }


    public function delete($id)

    {
        $major = Major::find($id);
        $major->delete($major);
        return redirect()->back();
        }
}
