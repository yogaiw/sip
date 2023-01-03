<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index() {
        return view('staff.dashboard', [
            'proposal' => Proposal::all(),
            'proposalAccByDosbing' => Proposal::where('status', 1)->get()
        ]);
    }
}
