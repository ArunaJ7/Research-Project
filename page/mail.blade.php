@extends('layouts.mainlayout')
@section('title', 'Home')
@section('content')

    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="row" id="container03">
                <h2>Stores</h2>
                <table class="table table-dark" width="100%">
                    <tr>
                        <th align="center" colspan="6">List of Items that Reached the Re-order Level</th>
                    </tr>
                    <tr>
                        <th>Item No:</th>
                        <th>Description</th>
                        <th>Re-order Level</th>
                        <th>Last Purchase Date</th>
                        <th>Issued Qty:(For last 06 months)</th>
                        <th>Current Balance</th>
                    </tr>
                    @foreach ($data1 as $data1)
                        <tr>
                            <td>{{ $data1->st_ConItem }}</td>
                            <td>{{ $data1->st_ConIDesc }}</td>
                            <td>{{ $data1->st_ConROL }}</td>
                            <td>
                                {{ $data1->binDate }}
                            </td>
                            <td>{{ $issue[$data1->st_ConItem] }}</td>
                            <td>{{ $data1->st_ConBalance }}</td>
                    @endforeach
                    </tr>
                    <tr>
                    <tr>
                        <td><a href="{{ url('materialsRequest') }}" class="btn btn-danger">Request Meaterials</a>
                        </td>
                        <td><a href="{{ url('mailExcel/excel') }}" class="btn btn-danger">Download as Excel</a></td>

                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
