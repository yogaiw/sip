<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Proposal;
use App\Models\Revision;
use App\Models\Student;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index() {
        return view('staff.dashboard', [
            'proposal' => Proposal::all(),
            'proposalAccByDosbing' => Proposal::where('status','>=', 1)->get(),
            'profile' => Auth::user()
        ]);
    }

    public function plottingPenguji($id) {
        return view('staff.plotting',[
            'proposal' => Proposal::find($id),
            'revisions' => Revision::where('proposal_id', $id)->orderBy('id', 'desc')->get(),
            'lecturer' => Lecturer::all()
        ]);
    }

    public function plot($student_user_id, $penguji_id) {
        $student = Student::where('user_id', $student_user_id)->first();

        if($penguji_id == $student->pembimbing1_id || $penguji_id == $student->pembimbing2_id) {
            return back()->with('error', 'Penguji tidak boleh sama dengan pembimbing');
        } else {
            $student->penguji_id = $penguji_id;
            $student->save();
        }

        return back()->with('success', 'Berhasil memplot penguji');
    }

    public function kelola() {
        return view('staff.kelola', [
            'lecturer' => Lecturer::all(),
            'student' => Student::all(),
            'staff' => Staff::all()
        ]);
    }

    public function createLecturer(Request $request) {
        $this->validate($request,[
            'nip' => 'required|unique:lecturers',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->username),
            'role' => 2
        ]);

        Lecturer::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'name' => $request->name,
        ]);

        return back()->with('success', 'Berhasil menambahkan dosen');
    }

    public function createStaff(Request $request) {
        $this->validate($request,[
            'nik' => 'required|unique:staff',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->username),
            'role' => 3
        ]);

        Staff::create([
            'user_id' => $user->id,
            'nik' => $request->nik,
            'name' => $request->name,
        ]);

        return back()->with('success', 'Berhasil menambahkan staff');
    }

    public function editProfil(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'nik' => 'required|numeric|unique:staff,nik,'. Auth::user()->staff->id .''
        ]);

        $staff = Staff::where('user_id', Auth::user()->id)->first();
        $staff->name = $request->name;
        $staff->nik = $request->nik;
        $staff->save();

        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        $user->save();

        return back()->with('success_edit_profile', 'Berhasil mengubah profil');
    }
}
