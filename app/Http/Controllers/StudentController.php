<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user()->id;
        $lecturer = User::where('role', 2)->get();
        $myProposal =  Proposal::where('author_id', $currentUser)->get();
        return view('student.dashboard', [
            'myProposal' => $myProposal,
            'profile' => Auth::user(),
            'lecturer' => $lecturer
        ]);
    }
}
