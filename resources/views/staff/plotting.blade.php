@extends('staff.main')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">{{$message}}</div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
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
                                <span class="badge badge-success">ACC Penguji / Lanjutkan TA</span>
                            @elseif ($proposal->status == 3)
                                <span class="badge badge-success">ACC Kaprodi / Selesai</span>
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
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Log Revisi</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ ($proposal->status == 0) ? 'disabled' : '' }}" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Plotting Dosen Penguji {{ ($proposal->status == 0) ? '(Menunggu ACC dari Dosen Pembimbing)' : '' }}</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @if ($proposal->status == 1)
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama Dosen</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lecturer as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td style="width: 20%">
                                                <form action="{{ route('plot',[
                                                    'student_user_id' => $proposal->author->id,
                                                    'penguji_id' => $item->user->id,
                                                    ]) }}"
                                                    method="POST"
                                                    >
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">Jadikan sebagai Penguji</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @elseif ($proposal->status == 2)
                            <div class="alert alert-warning">
                                Penguji sudah melakukan ACC
                            </div>
                        @elseif ($proposal->status == 3)
                            <div class="alert alert-warning">
                                Kaprodi sudah melakukan ACC
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
