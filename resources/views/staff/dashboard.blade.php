@extends('staff.main')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (Session::has('success_edit_profile'))
    <div class="alert alert-success">{{ Session::get('success_edit_profile') }}</div>
@endif

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Profil Staff</div>
                    <div class="d-flex justify-content-between">
                        <div class="mb-0 font-weight-bold text-gray-800">Nama</div>
                        <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->staff->name }}</div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="mb-0 font-weight-bold text-gray-800">NIK</div>
                        <div class="mb-0 font-weight-bold text-gray-800">{{ $profile->staff->nik }}</div>
                    </div>
                    <button type="button" class="btn btn-primary mt-2 btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
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
                    {{-- <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">coba</a>
                    </li> --}}
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
                                            @elseif ($item->status == 2)
                                                <span class="badge badge-success">ACC Penguji / Lanjutkan TA</span>
                                            @elseif ($item->status == 3)
                                                <span class="badge badge-success">ACC Kaprodi / Selesai</span>
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
                                            @elseif ($item->status == 2)
                                                <span class="badge badge-success">ACC Penguji / Lanjutkan TA</span>
                                            @elseif ($item->status == 3)
                                                <span class="badge badge-success">ACC Kaprodi / Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <p class="mb-3">Proposal Mahasiswa yang Anda Uji</p>

                    </div> --}}
                </div>
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
                    <form action="{{ route('account.editusername') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" placeholder="Username" value="{{ $profile->username }}">
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Ganti Username</button>
                    </form>
                    <hr>
                    <form action="{{ route('account.editpassword') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Password Lama</label>
                            <input type="password" class="form-control" name="oldPassword" required>
                        </div>
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" class="form-control" name="newPassword" required>
                        </div>
                        <div class="form-group">
                            <label>Ketik Ulang Password Baru</label>
                            <input type="password" class="form-control" name="newPassword_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary mb-3">Ganti Password</button>
                    </form>
                </div><hr><br>
                <div class="col-lg-6">
                    <h5><b>Akademik</b></h5>
                    <hr>
                    <form action="{{ route('staff.editprofil') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input class="form-control" type="text" name="name" placeholder="Nama Lengkap" value="{{ $profile->staff->name }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" placeholder="Email" value="{{ $profile->email }}">
                        </div>
                        <div class="form-group">
                            <label>NIK</label>
                            <input class="form-control" type="number" name="nik" placeholder="NIK" value="{{ $profile->staff->nik }}">
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
