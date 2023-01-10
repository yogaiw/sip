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
                            <div class="mb-0 font-weight-bold text-gray-800">Program Studi</div>
                            <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->student->department->name }}</div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="mb-0 font-weight-bold text-gray-800">Pembimbing 1</div>
                            <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->student->pembimbing1->lecturer->name }}</div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="mb-0 font-weight-bold text-gray-800">Pembimbing 2</div>
                            @if ($profile->student->pembimbing2_id != null)
                            <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->student->pembimbing2->lecturer->name }}</div>
                            @else
                            <div class="mb-0 font-weight-bold text-gray-800">-</div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="mb-0 font-weight-bold text-gray-800">Penguji</div>
                            @if ($profile->student->penguji_id != null)
                            <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->student->penguji->lecturer->name }}</div>
                            @else
                            <div class="mb-0 font-weight-bold text-gray-800">Belum ditetapkan</div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-primary mt-2 btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Edit</button>
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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($myProposal->first()->status == 0)
                                    <span class="badge badge-warning">DRAFT</span> <br>
                                    <small>Anda akan melaksanakan bimbingan revisi dengan Dosen Pembimbing disini</small>
                                @elseif ($myProposal->first()->status == 1)
                                    <span class="badge badge-success">ACC OLEH PEMBIMBING / SIAP SEMPRO</span> <br>
                                    <small>Proposal anda telah disetujui oleh Dosen Pembimbing, anda diperbolehkan melakukan seminar dengan menunggu atau menghubungi staff untuk plotting Dosen Penguji</small>
                                @elseif ($myProposal->first()->status == 2)
                                    <span class="badge badge-success">ACC OLEH PENGUJI / LANJUTKAN TA</span>
                                    <small>Proposal anda telah disetujui oleh Dosen Penguji, selanjutnya Kepala Program Studi akan menandatangani proposal anda</small>
                                @elseif ($myProposal->first()->status == 3)
                                    <span class="badge badge-success">ACC OLEH KEPALA PRODI</span>
                                    <small>Proposal anda telah disahkan oleh Kepala Program Studi, Lanjutkan ke Tugas Akhir II</small>
                                @endif
                                <hr>
                                <div class="alert-info p-3">
                                    @if ($myProposal->first()->approvedByDosbing1 != null)
                                        Telah acc oleh Pembimbing 1 pada <b>{{ date('D, d M Y H:i:s', strtotime($myProposal->first()->approvedByDosbing1)) }}</b> <br>
                                    @endif
                                    @if ($myProposal->first()->approvedByDosbing2 != null)
                                        Telah acc oleh Pembimbing 2 pada <b>{{ date('D, d M Y H:i:s', strtotime($myProposal->first()->approvedByDosbing2)) }}</b> <br>
                                    @endif
                                    @if ($myProposal->first()->approvedByPenguji != null)
                                        Telah acc oleh Penguji pada <b>{{ date('D, d M Y H:i:s', strtotime($myProposal->first()->approvedByPenguji)) }}</b> <br>
                                    @endif
                                </div>
                            </td>
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
                    <input type="file" name="proposal" required> <br>
                    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                </form>
                <hr>
                @endif
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
                        <div class="card-body {{ ($item->from_id == $profile->student->department->kaprodi_id) ? 'bg-success text-white' : '' }}">
                            {{ $item->message}} <br>
                            @if ($item->file != null)
                                <a href="{{ '/proposals/'.$item->file }}" target="_blank" class="btn btn-sm btn-primary">File</a>
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
                    <input name="proposal" type="file" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-success">Unggah Proposal</button>
            </form>
        </div>
      </div>
    </div>
</div>

<!-- Edit Profil Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h5><b>Akun</b></h5>
                    <hr>
                    <form action="">
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" placeholder="Username" value="{{ $profile->username }}">
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Ganti Username</button>
                    </form>
                    <hr>
                    <form action="">
                        <div class="form-group">
                            <label>Password Lama</label>
                            <input type="password" class="form-control" name="oldPassword">
                        </div>
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" class="form-control" name="newPassword">
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary mb-3">Ganti Password</button>
                    </form>
                </div><hr><br>
                <div class="col-lg-6">
                    <h5><b>Akademik</b></h5>
                    <hr>
                    <form action="">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input class="form-control" type="text" name="name" placeholder="Nama Lengkap" value="{{ $profile->student->name }}">
                        </div>
                        <div class="form-group">
                            <label>NIM</label>
                            <input class="form-control" type="number" name="nim" placeholder="Nama Lengkap" value="{{ $profile->student->nim }}">
                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <select name="department" class="custom-select">
                                @foreach ($departments as $item)
                                    <option value="{{ $item->id }}" {{ ($item->id == $profile->student->department_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen Pembimbing 1</label>
                            <select name="pembimbing1" class="custom-select">
                                @foreach ($lecturer as $item)
                                    <option value="{{ $item->id }}" {{ ($item->id == $profile->student->pembimbing2_id) ? 'selected' : '' }}>{{ $item->lecturer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen Pembimbing 2</label>
                            <select name="pembimbing2" class="custom-select">
                                @if ($profile->student->pembimbing2_id == null)
                                    <option value="" selected>-</option>
                                @endif
                                @foreach ($lecturer as $item)
                                    <option value="{{ $item->id }}" {{ ($item->id == $profile->student->pembimbing2_id) ? 'selected' : '' }}>{{ $item->lecturer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
