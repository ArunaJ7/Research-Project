<!DOCTYPE html>
@extends('layouts.mainlayout')


@section('content')
    <div class="container">

        <div class="row">
            <div class="container">
                <br /><br /><br /><br /><br />
                <h1 style='text-align:center'> Pending Goods Issue Note</h1>

                <table class="table table-dark">
                    <thead>
                        <th>Department</th>
                        <th>Employee</th>
                        <th>Project</th>
                        <th>Date</th>
                        <th>Issue No*</th>
                        <th>Total Value</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach ($ginData as $data)
                            <tr>
                                <td>{{ $data->department->deptName ?? '' }}</td>
                                <td>{{ $data->employees->namewithinitials ?? '' }}</td>
                                <td>{{ $data->project->projDesc ?? '' }}</td>
                                <td>{{ $data->cihDate }}</td>
                                <td>{{ $data->cihMSerial }}</td>
                                <td class="text-right">{{ $data->binItems->count() > 0 ? number_format($data->binItems[0]->total_amount,2,'.','') : '0.00'}}</td>
                                <td>
                                    @if($data->status == -1)
                                        <span class="badge badge-danger">Rejected</span>
                                    @elseif($data->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($data->status == -2)
                                        <span class="badge badge-warning">Opened To Edit</span>
                                    @endif
                                </td>
                                <td> <a href="{{ url('/goodIssueNoteCon/' . $data->id) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br /><br />
