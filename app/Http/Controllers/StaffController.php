<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Proposal;
use App\Models\Revision;
use App\Models\Student;
use App\Models\User;
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
}
