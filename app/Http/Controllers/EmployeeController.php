<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function index(Request $request){
        //$data = Employee::all(); // panggil database
        if($request->has('search')){
            $data = Employee::where('nama','LIKE','%' .$request->search.'%')->paginate(5);
        }else{
            $data = Employee::paginate(5); // panggil database
        }
    
        //dd($data); //ngepin data sblm tampil ke website
        return view('datapegawai',compact('data'));
    }

    public function tambahpegawai(){
        return view('tambahdata');
    }

    public function insertdata(Request $request){ //request agar dari view inputnya diambil
        // dd($request->all()); //ngepin data sblm tampil ke website   
        $data=Employee::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/',$request->file('foto')->getClientOriginalName());
            $data -> foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success','Data berhasil ditambahkan');
    }

    public function tampilkandata($id){
        $data=Employee::find($id);
        //dd($data);
        return view('tampildata',compact('data'));
    }

    public function updatedata(Request $request ,  $id){
        $data=Employee::find($id);
        $data->update($request->all());
        return redirect()->route('pegawai')->with('success','Data berhasil diUpdate');
    }

    public function delete($id){
        $data=Employee::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success','Data berhasil Hapus');
    }

    public function exportpdf(){
        $data=Employee::all();
        view()->share('data',$data);
        $pdf=PDF::loadview('datapegawai-pdf');
        return $pdf->download('data.pdf');
    }

    public function exportexcel(){
        return Excel::download(new EmployeeExport,'datapegawai.xlsx');
    }
}
