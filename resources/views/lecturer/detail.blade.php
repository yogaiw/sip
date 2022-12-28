@extends('lecturer.main')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $proposal->title }}</h1>
    <h5>oleh <b>{{ $proposal->author->student->name }}</b></h5>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Log Revisi</h6>
            </div>
            <div class="card-body">
                @forelse ($revisions as $item)
                    @if ($item->user->role == 1)
                        <b>{{ $item->user->student->name }}</b> <br>
                    @elseif ($item->user->role == 2)
                        <b>{{ $item->user->lecturer->name }}</b> <br>
                    @endif
                    {{ $item->message}} <br>
                    {{ date('D, d M Y H:i', strtotime($item->created_at)) }} <br>
                    <a href="#" class="btn btn-sm btn-primary">File</a> <br><br>
                @empty
                    <span class="align-middle">Anda belum melakukan upload proposal</span>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
