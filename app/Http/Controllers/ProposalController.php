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
            // 'file' => 'required'
        ]);

        $proposal = new Proposal();
        $proposal->author_id = Auth::user()->id;
        $proposal->title = $request->title;
        $proposal->abstract_indonesian = $request->abstract_indonesian;
        $proposal->abstract_english = $request->abstract_english;
        $proposal->save();

        $revision = new Revision();
        $revision->proposal_id = Proposal::where('author_id', Auth::user()->id)->orderBy('id', 'desc')->first()->id;
        $revision->from_id = Auth::user()->id;
        $revision->message = "Inisiasi Proposal";
        // $revision->file = $request->file;
        $revision->save();

        return redirect()->route('dashboard.student');
    }
}
