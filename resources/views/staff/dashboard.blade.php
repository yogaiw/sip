@extends('staff.main')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>
<!-- Content Row -->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Semua Proposal</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Proposal sudah ACC Pembimbing</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">coba</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p class="mb-3">Semua Proposal</p>
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Proposal</th>
                                        <th>Mahasiswa</th>
                                        <th>Pembimbing 1</th>
                                        <th>Pembimbing 2</th>
                                        <th>Prodi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proposal as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('plotting.staff',['id' => $item->id]) }}">{{ $item->title }}</a></td>
                                        <td>{{ $item->author->student->name }}</td>
                                        <td>{{ $item->author->student->pembimbing1->lecturer->name }}</td>
                                        @if ($item->author->pembimbing2_id != null)
                                            <td>{{ $item->author->student->pembimbing2->lecturer->name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>{{ $item->author->student->department->name }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                                <span class="badge badge-warning">Draft</span>
                                            @elseif ($item->status == 1)
                                                <span class="badge badge-success">ACC Pembimbing / Siap Sempro</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p class="mb-3">Proposal yang telah disetujui Dosen Pembimbing</p>
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Proposal</th>
                                        <th>Mahasiswa</th>
                                        <th>Pembimbing 1</th>
                                        <th>Pembimbing 2</th>
                                        <th>Penguji</th>
                                        <th>Prodi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proposalAccByDosbing as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('plotting.staff',['id' => $item->id]) }}">{{ $item->title }}</a></td>
                                        <td>{{ $item->author->student->name }}</td>
                                        <td>{{ $item->author->student->pembimbing1->lecturer->name }}</td>
                                        @if ($item->author->student->pembimbing2_id != null)
                                            <td>{{ $item->author->student->pembimbing2->lecturer->name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if ($item->author->student->penguji_id != null)
                                            <td>{{ $item->author->student->penguji->lecturer->name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>{{ $item->author->student->department->name }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                                <span class="badge badge-warning">Draft</span>
                                            @elseif ($item->status == 1)
                                                <span class="badge badge-success">ACC Pembimbing / Siap Sempro</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <p class="mb-3">Proposal Mahasiswa yang Anda Uji</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
