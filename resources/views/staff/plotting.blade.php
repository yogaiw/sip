@extends('staff.main')
@section('content')
<!-- Page Heading -->
<div class="mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $proposal->title }}</h1>
    <h5>oleh <b>{{ $proposal->author->student->name }}</b></h5>
</div>
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-body">
                <b>Dosen Pembimbing 1</b> {{ $proposal->author->student->pembimbing1->lecturer->name }} <br>
                @if ($proposal->author->student->pembimbing2_id != null)
                    <b>Dosen Pembimbing 2</b> {{ $proposal->author->student->pembimbing2->lecturer->name }} <br> <br>
                @endif
                <b>Asbtrak</b> <br>
                {{ $proposal->abstract_indonesian }} <br><br>

                <b>Abstract</b> <br>
                {{ $proposal->abstract_english }} <br>
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
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Plotting Dosen Penguji</a>
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
                                            <td style="width: 20%"><a href="" class="btn btn-primary btn-sm">Jadikan sebagai Penguji</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
