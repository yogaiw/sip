<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Revision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    public function create(Request $request) {
        $proposal = new Proposal();
        $proposal->author = Auth::user()->id;
        $proposal->title = $request->title;
        $proposal->abstract_indonesian = $request->abstract_indonesian;
        $proposal->abstract_english = $request->abstract_english;
        $proposal->pembimbing1 = $request->pembimbing1;
        $proposal->pembimbing2 = $request->pembimbing2;
        $proposal->penguji = $request->penguji;
        $proposal->save();

        $revision = new Revision();
        $revision->proposal_id = Proposal::where('author', Auth::user()->id)->orderBy('id', 'desc')->first()->id;
        $revision->message = "Inisiasi Proposal";
        $revision->feedback = "-";
        // $revision->file = $request->file;
        $revision->save();

        return redirect()->route('dashboard.student');
    }
}
