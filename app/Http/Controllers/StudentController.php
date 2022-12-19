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
        $myProposal =  Proposal::with(['authorRelation', 'pembimbing1Relation', 'pembimbing2Relation', 'pengujiRelation'])->where('author', $currentUser)->get();
        return view('student.dashboard', ['myProposal' => $myProposal]);
    }
}
