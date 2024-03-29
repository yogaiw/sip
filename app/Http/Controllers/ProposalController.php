<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Revision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    public function create(Request $request) {

        $this->validate($request, [
            'title' => 'required',
            'abstract_indonesian' => 'required',
            'abstract_english' => 'required',
            'proposal' => 'required|mimes:pdf,doc,docx,txt'
        ]);

        $proposal = Proposal::create([
            'author_id' => Auth::user()->id,
            'title' => $request->title,
            'abstract_indonesian' => $request->abstract_indonesian,
            'abstract_english' => $request->abstract_english,
            'status' => 0
        ]);

        $filename = time().'-'.Auth::user()->username.'-'.$request->file('proposal')->getClientOriginalName();
        $request->file('proposal')->move('proposals', $filename);

        $revision = new Revision();
        $revision->proposal_id = $proposal->id;
        $revision->from_id = Auth::user()->id;
        $revision->message = "Inisiasi Proposal";
        $revision->file = $filename;
        $revision->save();

        return redirect()->route('dashboard.student');
    }

    public function detail($id) {
        $proposal = Proposal::find($id);

        if($proposal->author->student->pembimbing1_id == Auth::user()->id || $proposal->author->student->pembimbing2_id == Auth::user()->id || $proposal->author->student->penguji_id == Auth::user()->id) {
            $revisions = Revision::where('proposal_id', $id)->orderBy('id', 'desc')->get();
            return view('lecturer.detail', compact('proposal', 'revisions'));
        } else {
            return back();
        }
    }

    public function submitRevision(Request $request, $proposal_id) {
        $this->validate($request, [
            'message' => 'required',
            'proposal' => 'mimes:pdf,doc,docx,txt'
        ]);

        if($request->hasFile('proposal')) {
            $filename = time().'-'.Auth::user()->username.'-'.$request->file('proposal')->getClientOriginalName();
            $request->file('proposal')->move('proposals', $filename);
        } else {
            $filename = null;
        }

        Revision::create([
            'proposal_id' => $proposal_id,
            'from_id' => Auth::user()->id,
            'message' => $request->message,
            'file' => $filename
        ]);

        return back();
    }

    public function accDosbing(Request $request) {
        $proposal = Proposal::find($request->proposal_id);

        if($proposal->author->student->pembimbing1_id == Auth::user()->id) {
            $proposal->approvedByDosbing1 = now();
        } else if($proposal->author->student->pembimbing2_id == Auth::user()->id) {
            $proposal->approvedByDosbing2 = now();
        }

        if($proposal->author->student->pembimbing2_id != null) {
            if($proposal->approvedByDosbing1 != null && $proposal->approvedByDosbing2 != null) {
                $proposal->status = 1;
                $proposal->save();
            } else {
                $proposal->status = 0;
                $proposal->save();
            }
        } else {
            $proposal->status = 1;
            $proposal->save();
        }

        return back()->with('success', 'Berhasil meng-appove proposal');
    }

    public function accPenguji(Request $request) {
        $proposal = Proposal::find($request->proposal_id);
        $proposal->approvedByPenguji = now();
        $proposal->status = 2;
        $proposal->save();

        return back()->with('success', 'Berhasil meng-appove proposal');
    }

    public function accKaprodi(Request $request) {
        $this->validate($request, [
            'proposal' => 'required|mimes:pdf,doc,docx,txt'
        ]);

        if($request->hasFile('proposal')) {
            $filename = time().'-'.Auth::user()->username.'-'.$request->file('proposal')->getClientOriginalName();
            $request->file('proposal')->move('proposals', $filename);
        } else {
            $filename = null;
        }

        Revision::create([
            'proposal_id' => $request->proposal_id,
            'from_id' => Auth::user()->id,
            'message' => 'Telah disetujui dan ditandatangani Kepala Prodi Informatika, Lanjutkan ke Tugas Akhir II',
            'file' => $filename
        ]);

        $proposal = Proposal::find($request->proposal_id);
        $proposal->status = 3;
        $proposal->save();

        return back()->with('success', 'Berhasil meng-appove proposal');
    }
}
