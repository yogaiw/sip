<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Proposal;
use App\Models\Revision;

class LecturerController extends Controller
{
    public function index() {
        $mhsBimbingan1 = Student::where('pembimbing1_id', Auth::user()->id)->get();
        $mhsBimbingan2 = Student::where('pembimbing2_id', Auth::user()->id)->get();
        $mhsPengujian = Student::where('penguji_id', Auth::user()->id)->get();

        if(Auth::user()->id == Department::find(1)->kaprodi_id) {
            $mhsPengajuanTtdKaprodi = Proposal::where('status','>=', 2)->get();
        } else {
            $mhsPengajuanTtdKaprodi = [];
        }

        return view('lecturer.dashboard', [
            'mhsBimbingan1' => $mhsBimbingan1,
            'mhsBimbingan2' => $mhsBimbingan2,
            'mhsPengujian' => $mhsPengujian,
            'profile' => Auth::user(),
            'mhsPengajuanTtdKaprodi' => $mhsPengajuanTtdKaprodi
        ]);
    }

    public function kaprodiView($id) {
        $proposal = Proposal::find($id);

        if($proposal->author->student->department->kaprodi_id == Auth::user()->id) {
            $revisions = Revision::where('proposal_id', $id)->orderBy('id', 'desc')->get();
            return view('lecturer.kaprodiview',[
                'proposal' => $proposal,
                'revisions' => $revisions
            ]);
        } else {
            return back();
        }
    }
}
