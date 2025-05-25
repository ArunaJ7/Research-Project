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
                        <td>Supplier Name</td>
                        <td>GRN No*</td>
                        <td>Date</td>
                        <td>Status</td>
                        <td>Action</td>
                    </thead>

                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $row->SupplierName }}</td>
                                <td>{{ $row->GRN_No }}</td>
                                <td>{{ $row->date }}</td>
                                <td>
                                    @if($row->status == -1)
                                        <span class="badge badge-danger">Rejected</span>
                                    @elseif($row->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url( '/updateFxGRNView/'. $row->id )}}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <br /><br/>
            </div>
        </div>
    </div>
    </div>
@endsection
