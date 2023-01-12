<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Revision;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();
        $lecturer = User::where('role', 2)->get();
        $myProposal =  Proposal::where('author_id', $currentUser->id)->get();

        if($myProposal->isNotEmpty()) {
            $revisions = Revision::where('proposal_id', $currentUser->proposal->first()->id)->orderBy('id', 'desc')->get();
        } else {
            $revisions = [];
        }

        return view('student.dashboard', [
            'myProposal' => $myProposal,
            'profile' => Auth::user(),
            'lecturer' => $lecturer,
            'revisions' => $revisions,
            'departments' => Department::all()
        ]);
    }

    public function editProfil(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'nim' => 'required|numeric|unique:students,nim,' . Auth::user()->student->id . '',
            'email' => 'required|email',
            'pembimbing1' => 'required'
        ]);

        $user = Student::where('user_id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->nim = $request->nim;
        $user->pembimbing1_id = $request->pembimbing1;
        $user->pembimbing2_id = $request->pembimbing2;
        $user->save();

        $currentUser = User::find(Auth::user()->id);
        $currentUser->email = $request->email;
        $currentUser->save();

        return back()->with('success', 'Profil berhasil diubah');
    }
}
