@extends('lecturer.main')
@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header">Informasi Proposal</div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th colspan="2" class="text-center">
                            {{ $proposal->title }}
                            @if ($proposal->status == 0)
                                <span class="badge badge-warning">Draft</span>
                            @elseif ($proposal->status == 1)
                                <span class="badge badge-success">ACC Pembimbing / Siap Sempro</span>
                            @elseif ($proposal->status == 2)
                                <span class="badge badge-success">ACC Penguji / Lanjutkan TA</span>
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">oleh <b>{{ $proposal->author->student->name }}</b></td>
                    </tr>
                    <tr>
                        <th style="width: 20%">Dosen Pembimbing 1</th>
                        <td>{{ $proposal->author->student->pembimbing1->lecturer->name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%">Dosen Pembimbing 2</th>
                        @if ($proposal->author->student->pembimbing2_id != null)
                        <td>{{ $proposal->author->student->pembimbing2->lecturer->name }}</td>
                        @else
                        <td>-</td>
                        @endif
                    </tr>
                    <tr>
                        <th style="width: 20%">Dosen Penguji</th>
                        @if ($proposal->author->student->penguji_id != null)
                        <td>{{ $proposal->author->student->penguji->lecturer->name }}</td>
                        @else
                        <td>Belum Ditetapkan</td>
                        @endif
                    </tr>
                    <tr>
                        <th style="width: 20%">Asbtrak</th>
                        <td>{{ $proposal->abstract_indonesian }}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%">Abstract</th>
                        <td>{{ $proposal->abstract_english }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
@endsection
