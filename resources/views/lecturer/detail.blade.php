@extends('lecturer.main')
@section('content')
<!-- Page Heading -->
<div class="mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $proposal->title }}</h1>
    @if ($proposal->status == 0)
        <span class="badge badge-warning">Draft</span>
    @elseif ($proposal->status == 1)
        <span class="badge badge-success">ACC Pembimbing / Siap Sempro</span>
    @elseif ($proposal->status == 2)
        <span class="badge badge-success">ACC Pembimbing / Lanjutkan TA</span>
    @endif
    <h5>oleh <b>{{ $proposal->author->student->name }}</b></h5>
</div>
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-body">
                <b>Dosen Pembimbing 1</b> {{ $proposal->author->student->pembimbing1->lecturer->name }} <br>
                @if ($proposal->author->student->pembimbing2_id != null)
                    <b>Dosen Pembimbing 2</b> {{ $proposal->author->student->pembimbing2->lecturer->name }} <br> <br>
                @endif
                <b>Asbtrak</b> <br>
                {{ $proposal->abstract_indonesian }} <br><br>

                <b>Abstract</b> <br>
                {{ $proposal->abstract_english }} <br>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Log Revisi</h6>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <!--
                    Dibawah ini merupakan form untuk upload pesan dan file revisi.
                    Ketika dosen pembimbing / penguji sudah melakukan acc proposal, maka form
                    akan dimatikan/dosen sudah tidak bisa melakukan feedback revisi.

                    TODO : BUAT CONFIRMATION DIALOG SEBELUM PROSES ACC DILAKUKAN
                -->
                @if (Auth::user()->id == $proposal->author->student->pembimbing1_id || Auth::user()->id == $proposal->author->student->pembimbing2_id)
                    @if ($proposal->status == 0)
                        <form action="{{ route('proposal.submitrevision', ['proposal_id' => $proposal->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <textarea class="form-control" name="message" rows="3" placeholder="Pesan Anda" required></textarea> <br>
                            <input type="file" name="proposal"> <br>
                            <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                        </form>
                    @else
                        <div class="alert alert-info">Anda sebagai pembimbing sudah melakukan acc</div>
                    @endif
                @endif
                @if (Auth::user()->id == $proposal->author->student->penguji_id)
                    @if ($proposal->status == 1)
                        <form action="{{ route('proposal.submitrevision', ['proposal_id' => $proposal->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <textarea class="form-control" name="message" rows="3" placeholder="Pesan Anda" required></textarea> <br>
                            <input type="file" name="proposal"> <br>
                            <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                        </form>
                    @else
                        <div class="alert alert-info">Anda sebagai penguji sudah melakukan acc</div>
                    @endif
                @endif

                <hr>
                @forelse ($revisions as $item)
                <div class="card shadow mb-3 {{ ($item->from_id == Auth::user()->id) ? 'border-left-primary mr-5' : 'ml-4' }}">
                    <div class="card-header">
                        @if ($item->user->role == 1)
                            <b>{{ $item->user->student->name }}</b> <br>
                        @elseif ($item->user->role == 2)
                            <b>{{ $item->user->lecturer->name }}</b> <br>
                        @endif
                        {{ date('D, d M Y H:i', strtotime($item->created_at)) }}
                    </div>
                    <div class="card-body">
                        {{ $item->message }} <br>
                        @if ($item->file != null)
                            <a href="{{ '/proposals/'.$item->file }}" target="_blank" class="btn btn-sm btn-primary">File</a>
                        @endif
                        @if ($item->user->role == 1 && $item->proposal->status == 0 && $item->created_at == $item->max('created_at') && $item->proposal->author->student->penguji_id != Auth::user()->id)
                            <form action="{{ route('proposal.accdosbing') }}" method="POST">
                                @csrf
                                <input type="hidden" name="proposal_id" value="{{ $item->proposal->id }}">
                                <button class="btn btn-success btn-sm">Approve / Nyatakan Siap Sempro</a>
                            </form>
                        @endif
                        @if ($item->user->role == 1 && $item->proposal->status == 1 && $item->created_at == $item->max('created_at') && $item->proposal->author->student->penguji_id == Auth::user()->id)
                            <form action="{{ route('proposal.accpenguji') }}" method="POST">
                                @csrf
                                <input type="hidden" name="proposal_id" value="{{ $item->proposal->id }}">
                                <button class="btn btn-success btn-sm">Approve / Lanjutkan TA</a>
                            </form>
                        @endif
                    </div>
                </div>
                @empty
                    <span class="align-middle">Anda belum melakukan upload proposal</span>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
