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
                        <div class="d-flex justify-content-between mt-2">
                            <div class="mb-0 font-weight-bold text-gray-800">Penguji</div>
                            <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->student->penguji->lecturer->name }}</div>
                        </div>
                        <a href="" class="btn btn-primary btn-sm mt-3">Edit Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table -->
    <div class="col-xl-9 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Proposal Aktif Anda</h6>
            </div>
            <div class="card-body">
                @if ($myProposal->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Judul Proposal</th>
                            <td>{{ $myProposal->first()->title }}</td>
                        </tr>
                        <tr>
                            <th>Abstrak</th>
                            <td>{{ $myProposal->first()->abstract_indonesian }}</td>
                        </tr>
                        <tr>
                            <th>Abstract</th>
                            <td>{{ $myProposal->first()->abstract_english }}</td>
                        </tr>
                    </table>
                </div>
                @else
                <span class="align-middle">Anda belum mengisi informasi proposal anda.</span>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadProposal">
                    Upload Proposal
                </button>
                @endif
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
                @if ($myProposal->isNotEmpty())
                <form action="{{ route('proposal.submitrevision', ['proposal_id' => $myProposal->first()->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <textarea class="form-control" name="message" rows="3" placeholder="Pesan Anda" required></textarea> <br>
                    <input type="file" name="file"> <br>
                    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                </form>
                <hr>
                @endif
                @forelse ($revisions as $item)
                    <div class="card shadow mb-3 {{ ($item->max('id')) ? 'border-left-primary' : '' }}">
                        <div class="card-header">
                            @if ($item->user->role == 1)
                                <b>{{ $item->user->student->name }}</b> <br>
                            @elseif ($item->user->role == 2)
                                <b>{{ $item->user->lecturer->name }}</b> <br>
                            @endif
                            {{ date('D, d M Y H:i', strtotime($item->created_at)) }}
                        </div>
                        <div class="card-body">
                            {{ $item->message}} <br>
                            <a href="#" class="btn btn-sm btn-primary">File</a>
                        </div>
                    </div>
                @empty
                    <span class="align-middle">Anda belum melakukan upload proposal</span>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadProposal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('proposal.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Abstrak (Indonesia)</label>
                    <textarea type="text" name="abstract_indonesian" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Abstract (English)</label>
                    <textarea type="text" name="abstract_english" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Unggah pdf</label>
                    <input type="file" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-success">Unggah Proposal</button>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection
