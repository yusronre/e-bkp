<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Punishment;
use  \App\Tr_input_punishment;
use \App\Student;
use \App\Score_punishment;
use PDF;


class Punishment_trController extends Controller
{
    public function index()
    {
        $total = Tr_input_punishment::all();
        $student= Student::all();
        $punishment = Punishment::all();
        

    	return view('guru/Punishment/index',compact ('punishment','student','total'));
 
    }

    public function point($id){
        return Punishment::findOrFail($id);
    }

    public function show()
    {
        $total = Tr_input_punishment::all();
        $student= Student::all();
    	return view('guru/Punishment/data',compact ('total','student'));
 
    }

    public function create(Request $request)

    {
        $punishments = Tr_input_punishment::firstOrCreate([
            'student_id' => $request->name,
            'punishment_id' => $request->deskripsi,
            'score' => $request->point,
            'spectator' => $request->spectator,
        ]);
        return redirect()->back();
    }
    public function detail()
    {   
        $student = Student::all();
        $punishment = Tr_input_punishment::all();
        return view('siswa/punishment',compact('punishment','student'));
    }

    public function delete($id)
    {
        $punishment = Tr_input_punishment::find($id);
        $punishment->delete($punishment);

        return redirect()->back();
    }
    public function cetak_pdf()
    {
    	$punishment = Tr_input_punishment::all();
        $student= Student::all();
    	$pdf = PDF::loadview('guru/Punishment/pdfpunishment',compact ('punishment','student'));
    	return $pdf->download('punishment-pdf.pdf');
    }
}
