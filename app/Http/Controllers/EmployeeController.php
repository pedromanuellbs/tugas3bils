<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        $data = Employee::all();
        return view('content.tables.tables-basic', compact('data'));
    }

    public function tambahpegawai() {
        return view('content.form-layout.form-layouts-horizontal');
    }

    public function insertdata(Request $request) {
        // dd($request->all());
        $data = Employee::create($request->all());
        if($request->hasFile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success','Data Sudah Berhasil Ditambahkan!');
    }
    
    public function tampilkandata($id) {
        $data = Employee::find($id);
        // dd($data);
        return view('content.form-layout.form-layouts-horizontal-edit', compact('data'));
    }

    public function updatedata(Request $request, $id) {
        $data = Employee::find($id);
        $data->update($request->all());

        return redirect()->route('pegawai')->with('success','Data Sudah Berhasil Di Uptade!');
    }

    public function delete($id) {
        $data = Employee::find($id);
        $data->delete();

        return redirect()->route('pegawai')->with('success','Data Sudah Berhasil Di Hapus!');
    }
}
