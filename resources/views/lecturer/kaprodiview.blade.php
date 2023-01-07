@extends('lecturer.main')
@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header">Informasi Proposal</div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th colspan="2" class="text-center">{{ $proposal->title }}</th>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">oleh {{ $proposal->author->student->name }}</td>
                    </tr>
                    <tr>
                        <th>Dosen Pembimbing 1</th>
                        <td>{{ $proposal->author->student->pembimbing1->lecturer->name }}</td>
                    </tr>
                    @if ($proposal->author->student->pembimbing2_id != null)
                        <tr>
                            <th>Dosen Pembimbing 2</th>
                            <td>{{ $proposal->author->student->pembimbing2->lecturer->name }}</td>
                        </tr>
                    @endif
                    @if ($proposal->author->student->penguji_id != null)
                        <tr>
                            <th>Dosen Penguji</th>
                            <td>{{ $proposal->author->student->penguji->lecturer->name }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Asbtrak</th>
                        <td>{{ $proposal->abstract_indonesian }}</td>
                    </tr>
                    <tr>
                        <th>Abstract</th>
                        <td>{{ $proposal->abstract_english }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
