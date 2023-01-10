@extends('lecturer.main')
@section('content')
<div class="row mb-4">
    <div class="col">
        <div class="card shadow">
            <div class="card-header">Informasi Proposal</div>
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
                                <span class="badge badge-success">ACC Penguji / Lanjutkan TA</span>
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">oleh <b>{{ $proposal->author->student->name }}</b></td>
                    </tr>
                    <tr>
                        <th style="width: 20%">Dosen Pembimbing 1</th>
                        <td>
                            {{ $proposal->author->student->pembimbing1->lecturer->name }}
                            @if ($proposal->approvedByDosbing1 != null)
                                <span class="badge badge-success">Approved at {{ date('D, d M Y H:i:s', strtotime($proposal->approvedByDosbing1)) }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 20%">Dosen Pembimbing 2</th>
                        @if ($proposal->author->student->pembimbing2_id != null)
                        <td>
                            {{ $proposal->author->student->pembimbing2->lecturer->name }}
                            @if ($proposal->approvedByDosbing2 != null)
                                <span class="badge badge-success">Approved at {{ date('D, d M Y H:i:s', strtotime($proposal->approvedByDosbing2)) }}</span>
                            @endif
                        </td>
                        @else
                        <td>-</td>
                        @endif
                    </tr>
                    <tr>
                        <th style="width: 20%">Dosen Penguji</th>
                        @if ($proposal->author->student->penguji_id != null)
                        <td>
                            {{ $proposal->author->student->penguji->lecturer->name }}
                            @if ($proposal->approvedByPenguji != null)
                                <span class="badge badge-success">Approved at {{ date('D, d M Y H:i:s', strtotime($proposal->approvedByPenguji)) }}</span>
                            @endif
                        </td>
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

<div class="row mb-4">
    <div class="col">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="alert alert-info">Proposal ini membutuhkan tanda tangan dari Kepala Prodi, lakukan Unduh Proposal untuk tanda tangan digital lalu unggah kembali dokumen yang sudah tertanda tangan</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow text-center">
                            <div class="card-body">
                                <b>File Terbaru</b> <br>
                                <b>{{ date('D, d M Y H:i', strtotime($revisions->first()->created_at)) }}</b> <br>
                                @if ($revisions->first()->file != null)
                                    <a href="{{ '/proposals/'.$revisions->first()->file }}" target="_blank" class="btn btn-sm btn-primary">Unduh</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow text-center">
                            <div class="card-body">
                                <b>Unggah Disini</b> <br>
                                <form action="{{ route('proposal.acckaprodi') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="proposal_id" value="{{ $proposal->id }}">
                                        <input type="file" name="proposal" class="form-control" required>
                                        <button type="submit" class="btn btn-sm btn-success">Unggah dan Nyatakan Sah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header">Log Revisi</div>
        </div>
        <div class="card-body">
            @foreach ($revisions as $item)
            <div class="card shadow mb-3">
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
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
