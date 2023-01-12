<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Revision;
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

    public function changeUsername(Request $request) {
        $request->validate([
            'username' => 'required|unique:users,username'
        ]);

        $user = User::find(Auth::user()->id);
        $user->username = $request->username;
        $user->save();

        return back()->with('success_edit_profile', 'Username berhasil diubah');
    }
}
