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
                            <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->name }}</div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="mb-0 font-weight-bold text-gray-800">NIM</div>
                            <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->id_by_campus }}</div>
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
                                <td>{{ $item->pembimbing1Relation->name }}</td>
                                @if ($item->pembimbing2Relation != null)
                                    <td>{{ $item->pembimbing2Relation->name }}</td>
                                @else
                                    <td>-</td>
                                @endif
                                <td>{{ $item->pengujiRelation->name }}</td>
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

<!-- Proposal Modal -->
<div class="modal fade" id="unggahProposal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Unggah Proposal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Abstrak (Indonesia)</label>
                    <textarea type="text" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Abstract (English)</label>
                    <textarea type="text" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Dosen Pembimbing 1</label>
                    <select class="form-control">
                        @foreach ($lecturer as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
                </div>
                <div class="form-group">
                    <label>Dosen Pembimbing 2</label>
                    <small>Kosongkan jika tidak ada</small>
                    <select class="form-control">
                        <option value="null">-</option>
                        @foreach ($lecturer as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
                </div>
                <div class="form-group">
                    <label>Dosen Penguji</label>
                    <select class="form-control">
                        @foreach ($lecturer as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Unggah pdf</label>
                    <input type="file" class="form-control-file">
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection
