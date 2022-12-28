@extends('lecturer.main')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $proposal->title }}</h1>
    <h5>oleh <b>{{ $proposal->author->student->name }}</b></h5>
</div>
<div class="row">

</div>
@endsection
