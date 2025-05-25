<!DOCTYPE html>
@extends('layouts.mainlayout')


@section('content')
    <div class="container">

        <div class="row">
            <div class="container">
                <br /><br /><br /><br /><br />
                <h1 style='text-align:center'> Fixed Assets - Pending Goods Received Note</h1>

                <table class="table table-dark">
                    <thead>
                        <th>GIN No*</th>
                        <th>GIN Sub</th>
                        <th>GRN No*</th>
                        <th>Header</th>
                        <th>Date</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach ($fxGinData as $row)
                                <tr>
                                    <td>{{ $row->fxGINNo }}</td>
                                    <td>{{ $row->fxGINSub }}</td>
                                    <td>{{ $row->fxGRN }}</td>
                                    <td>{{ $row->headers->fh_Desc }}</td>
                                    <td>{{ $row->fxIDate }}</td>
                                    <td>{{ $row->department->deptName }}</td>
                                    <td>
                                        @if($row->status == -1)
                                            <span class="badge badge-danger">Rejected</span>
                                        @elseif($row->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/viewFxGINItem/' . $row->fxGINNo . '/' . urlencode($row->fxGINSub)) }}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>

                </table>
                <br /><br />
            </div>
        </div>
    </div>
    </div>
@endsection
