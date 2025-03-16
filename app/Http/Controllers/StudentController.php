<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $data = Student::where(function ($query) use ($request) {
            if ($request->input('nama')) {
                $query->where('student_name', $request->input('nama'));
            }
            if ($request->input('nim')) {
                $query->where('nim', $request->input('nim'));
            }
            if ($request->input('program_studi')) {
                $query->where('study_program', $request->input('program_studi'));
            }
        })->orderBy('nim', 'asc')->paginate(10);
        // dd($data);
        return view('pages.student.index', compact('data'));
    }

    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data = Student::find($id);
        return view('pages.student.show', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $data = Student::find($id);
        $request->validate([
            'password' => 'required|string|min:8|max:255',
        ],[
            'required' => ':attribute harus diisi',
            'string' => ':attribute harus berupa string',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter',
        ],[
            'password' => 'Password',
        ]);

        $user = User::find($data->user_id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('student')->with('success', 'Data berhasil diperbarui');
    }
}
