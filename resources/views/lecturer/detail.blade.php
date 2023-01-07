@extends('lecturer.main')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th colspan="2" class="text-center">
                            {{ $proposal->title }}
                            @if ($proposal->status == 0)
                                <span class="badge badge-warning">Draft</span>
                            @elseif ($proposal->status == 1)
                                <span class="badge badge-success">ACC Pembimbing / Siap Sempro</span>
                            @elseif ($proposal->status == 2)
                                <span class="badge badge-success">ACC Pembimbing / Lanjutkan TA</span>
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">oleh <b>{{ $proposal->author->student->name }}</b></td>
                    </tr>
                    <tr>
                        <th style="width: 20%">Dosen Pembimbing 1</th>
                        <td>{{ $proposal->author->student->pembimbing1->lecturer->name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%">Dosen Pembimbing 2</th>
                        @if ($proposal->author->student->pembimbing2_id != null)
                        <td>{{ $proposal->author->student->pembimbing2->lecturer->name }}</td>
                        @else
                        <td>-</td>
                        @endif
                    </tr>
                    <tr>
                        <th style="width: 20%">Dosen Penguji</th>
                        @if ($proposal->author->student->penguji_id != null)
                        <td>{{ $proposal->author->student->penguji->lecturer->name }}</td>
                        @else
                        <td>Belum Ditetapkan</td>
                        @endif
                    </tr>
                    <tr>
                        <th style="width: 20%">Asbtrak</th>
                        <td>{{ $proposal->abstract_indonesian }}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%">Abstract</th>
                        <td>{{ $proposal->abstract_english }}</td>
                    </tr>
                </table>
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
