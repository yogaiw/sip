<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user()->id;
        $myProposal =  Proposal::with('author', 'pembimbing1', 'pembimbing2', 'penguji')->where('author', $currentUser)->get();
        return view('student.dashboard', ['myProposal' => $myProposal]);
    }
}
