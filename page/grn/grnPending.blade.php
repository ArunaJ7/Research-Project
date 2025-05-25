<!DOCTYPE html>
@extends('layouts.mainlayout')


@section('content')
    <div class="container">

        <div class="row">
            <div class="container">
                <br /><br /><br /><br /><br />
                <h1 style='text-align:center'> Pending Goods Received Note</h1>

                <table class="table table-dark">
                    <thead>
                        <th>Supplier Name</th>
                        <th>GRN No*</th>
                        <th>Date</th>
                        <th>Total Value</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $row->supplier->Supplier }}</td>
                                <td>{{ $row->GRN_No }}</td>
                                <td>{{ $row->date }}</td>
                                <td class="text-right">{{ $row->grnItems->count() > 0 ? number_format($row->grnItems[0]->total_amount,2,'.','') : '0.00'}}</td>
                                <td>
                                    @if($row->status == -1)
                                        <span class="badge badge-danger">Rejected</span>
                                    @elseif($row->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($row->status == -2)
                                        <span class="badge badge-warning">Opened To Edit</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url( '/updateConGRNView/'. $row->id )}}" class="btn btn-primary">View</a>
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
