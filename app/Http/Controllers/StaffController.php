<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Proposal;
use App\Models\Revision;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index() {
        return view('staff.dashboard', [
            'proposal' => Proposal::all(),
            'proposalAccByDosbing' => Proposal::where('status', 1)->get()
        ]);
    }

    public function plottingPenguji($id) {
        return view('staff.plotting',[
            'proposal' => Proposal::find($id),
            'revisions' => Revision::where('proposal_id', $id)->orderBy('id', 'desc')->get(),
            'lecturer' => Lecturer::all()
        ]);
    }
}
