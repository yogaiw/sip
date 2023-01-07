@extends('lecturer.main')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>
<!-- Content Row -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Profil Dosen</div>
                    <div class="d-flex justify-content-between">
                        <div class="mb-0 font-weight-bold text-gray-800">Nama</div>
                        <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->lecturer->name }}</div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="mb-0 font-weight-bold text-gray-800">NIP</div>
                        <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->lecturer->nip }}</div>
                    </div>
                    <a href="" class="btn btn-primary btn-sm mt-3">Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sebagai Pembimbing 1</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Sebagai Pembimbing 2</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Sebagai Penguji</a>
                    </li>
                    @if ($profile->has('kaprodiTo')->first()->id == $profile->id)
                    <li class="nav-item">
                        <a class="nav-link" id="kaprodi-tab" data-toggle="tab" href="#kaprodi" role="tab" aria-controls="kaprodi" aria-selected="false">Sebagai Kepala Prodi</a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p class="mb-3">Mahasiswa bimbingan anda sebagai Dosen Pembimbing 1</p>
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Proposal</th>
                                        <th>Mahasiswa</th>
                                        <th>Prodi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mhsBimbingan1 as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                            @if ($item->user->proposal->count() == 0)
                                                <td>Belum ada judul</td>
                                            @else
                                                <td><a href="{{ route('proposal.detail', ['id' => $item->user->proposal->first()->id]) }}">{{ $item->user->proposal->first()->title }}</a></td>
                                            @endif
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->department->name }}</td>
                                        <td>
                                            @if ($item->user->proposal->count() == 0)
                                                <span class="badge badge-warning">Belum ada judul</span>
                                            @else
                                                @if ($item->user->proposal->first()->status == 0)
                                                    <span class="badge badge-warning">Draft</span>
                                                @elseif ($item->user->proposal->first()->status == 1)
                                                    <span class="badge badge-success">ACC Pembimbing / Siap Sempro</span>
                                                @elseif ($item->user->proposal->first()->status == 2)
                                                    <span class="badge badge-success">ACC Penguji / Lanjutkan TA</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p class="mb-3">Mahasiswa bimbingan anda sebagai Dosen Pembimbing 2</p>
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Proposal</th>
                                        <th>Mahasiswa</th>
                                        <th>Prodi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mhsBimbingan2 as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                            @if ($item->user->proposal->count() == 0)
                                                <td>Belum ada judul</td>
                                            @else
                                                <td><a href="{{ route('proposal.detail', ['id' => $item->user->proposal->first()->id]) }}">{{ $item->user->proposal->first()->title }}</a></td>
                                            @endif
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->department->name }}</td>
                                        <td>
                                            @if ($item->user->proposal->count() == 0)
                                                <span class="badge badge-warning">Belum ada judul</span>
                                            @else
                                                @if ($item->user->proposal->first()->status == 0)
                                                    <span class="badge badge-warning">Draft</span>
                                                @elseif ($item->user->proposal->first()->status == 1)
                                                    <span class="badge badge-success">ACC Pembimbing / Siap Sempro</span>
                                                @elseif ($item->user->proposal->first()->status == 2)
                                                    <span class="badge badge-success">ACC Penguji / Lanjutkan TA</span>
                                                @endif
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
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Proposal</th>
                                        <th>Mahasiswa</th>
                                        <th>Prodi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mhsPengujian as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                            @if ($item->user->proposal->count() == 0)
                                                <td>Belum ada judul</td>
                                            @else
                                                <td><a href="{{ route('proposal.detail', ['id' => $item->user->proposal->first()->id]) }}">{{ $item->user->proposal->first()->title }}</a></td>
                                            @endif
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->department->name }}</td>
                                        <td>
                                            @if ($item->user->proposal->count() == 0)
                                                <span class="badge badge-warning">Belum ada judul</span>
                                            @else
                                                @if ($item->user->proposal->first()->status == 0)
                                                    <span class="badge badge-warning">Draft</span>
                                                @elseif ($item->user->proposal->first()->status == 1)
                                                    <span class="badge badge-success">ACC Pembimbing / Siap Sempro</span>
                                                @elseif ($item->user->proposal->first()->status == 2)
                                                    <span class="badge badge-success">ACC Penguji / Lanjutkan TA</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($profile->has('kaprodiTo')->first()->id == $profile->id)
                    <div class="tab-pane fade" id="kaprodi" role="tabpanel" aria-labelledby="kaprodi-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Proposal</th>
                                        <th>Mahasiswa</th>
                                        <th>Prodi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mhsPengajuanTtdKaprodi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->author->student->name }}</td>
                                            <td>{{ $item->author->student->department->name }}</td>
                                            <td>
                                                @if ($item->status == 0)
                                                        <span class="badge badge-warning">Draft</span>
                                                @elseif ($item->status == 1)
                                                    <span class="badge badge-success">ACC Pembimbing / Siap Sempro</span>
                                                @elseif ($item->status == 2)
                                                    <span class="badge badge-success">ACC Penguji / Lanjutkan TA</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
