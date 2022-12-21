@extends('student.main')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Student Profile -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Profil Mahasiswa</div>
                        <div class="d-flex justify-content-between">
                            <div class="mb-0 font-weight-bold text-gray-800">Nama</div>
                            <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->student->name }}</div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="mb-0 font-weight-bold text-gray-800">NIM</div>
                            <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->student->nim }}</div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="mb-0 font-weight-bold text-gray-800">Pembimbing 1</div>
                            <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->student->pembimbing1->lecturer->name }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Data Table -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Proposal Aktif Anda</h6>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#unggahProposal">
                    Buat Sekarang
                </button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Pembimbing 1</th>
                                <th>Pembimbing 2</th>
                                <th>Penguji</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($myProposal as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->author->student->pembimbing1->lecturer->name }}</td>
                                <td></td>
                                <td>{{ $item->author->student->penguji->lecturer->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada proposal aktif.
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#unggahProposal">
                                      Buat Sekarang
                                    </button>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
