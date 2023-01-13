@extends('staff.main')
@section('content')
<div class="row">
    <div class="col-12">
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
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="card shdaow">
            <div class="card-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Dosen</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Staff</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Status Proposal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student as $item)
                                        <tr>
                                            <td>{{ $item->nim }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if ($item->user->proposal->count() == 0)
                                                    <span class="badge badge-danger">Belum Mengajukan</span>
                                                @elseif ($item->user->proposal->first()->status == 0)
                                                    <span class="badge badge-warning">Draft</span>
                                                @elseif ($item->user->proposal->first()->status == 1)
                                                    <span class="badge badge-success">Acc Pembimbing</span>
                                                @elseif ($item->user->proposal->first()->status == 2)
                                                    <span class="badge badge-success">Acc Penguji</span>
                                                @elseif ($item->user->proposal->first()->status == 3)
                                                    <span class="badge badge-success">Acc Kaprodi</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h5 class="mb-2">Buat Dosen Baru</h5>
                        <form action="{{ route('staff.createlecturer') }}" method="POST">
                            @csrf
                            <div class="d-lg-flex justify-content-start mb-4">
                                <div class="form-group mr-2">
                                    <input type="number" class="form-control" name="nip" placeholder="NIK" required>
                                </div>
                                <div class="form-group mr-2">
                                    <input type="text" class="form-control" name="name" placeholder="Nama" required>
                                </div>
                                <div class="form-group mr-2">
                                    <input type="text" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group mr-2">
                                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <small class="mr-2">Password akan disamakan dengan username</small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Tambah Dosen</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <h5 class="mb-3">List Dosen</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lecturer as $item)
                                        <tr>
                                            <td>{{ $item->nip }}</td>
                                            <td>{{ $item->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <h5 class="mb-2">Buat Staff Baru</h5>
                        <form action="{{ route('staff.createstaff') }}" method="POST">
                            @csrf
                            <div class="d-lg-flex justify-content-start mb-4">
                                <div class="form-group mr-2">
                                    <input type="number" class="form-control" name="nik" placeholder="NIK" required>
                                </div>
                                <div class="form-group mr-2">
                                    <input type="text" class="form-control" name="name" placeholder="Nama" required>
                                </div>
                                <div class="form-group mr-2">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group mr-2">
                                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <small class="mr-2">Password akan disamakan dengan username</small>
                                </div>
                                <div class="form-group mr-2">
                                    <button type="submit" class="btn btn-success">Buat Staff Baru</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <h5 class="mb-3">List Staff</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                <div class="table-responsive">
                                    <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($staff as $item)
                                                <tr>
                                                    <td>{{ $item->nik }}</td>
                                                    <td>{{ $item->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
