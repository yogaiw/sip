<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Proposal;
use App\Models\Revision;
use App\Models\User;
use App\Models\Lecturer;

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

    public function editProfil(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'nik' => 'required|unique:lecturers,nip,'   . Auth::user()->lecturer->id . ''
        ]);

        $lecturer = Lecturer::where('user_id', Auth::user()->id)->first();
        $lecturer->name = $request->name;
        $lecturer->nip = $request->nik;
        $lecturer->save();

        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        $user->save();

        return back()->with('success_edit_profile', 'Profil berhasil diubah');
    }
}
