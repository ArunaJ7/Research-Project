<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Good Received Note - Consumables')

@section('content')
<div class="container">
    <div class="row">

        <div class="container">

            <br /><br /><br /><br /><br />

            <h1 style='text-align:center'> Good Received Note Details </h1>
            <br /><br />
            <div class="row">
                <div class="col-md-12">

                    <form method="post" action="{{ url('/addConGrnHdr') }}">
                        {{csrf_field()}}

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="supplier">Supplier Name *</label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" placeholder="Select Supplier" id="supplier" name="supplier">
                                    <option value="0" disabled selected>Select Supplier</option>
                                    @foreach($supplier as $supplier)
                                    <option value="{{$supplier->id}}">
                                        {{ ucfirst($supplier->Supplier) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="supplier">GRN No * </label>
                            <div class="col-sm-9">
                                <input value="" class="form-control" type="number" name="GRNno" placeholder="Enter GRN No" required="required" id="GRNno">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-NIC"> Date </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="date" name="date" placeholder="Enter Date" id="date">
                            </div>
                        </div>
                        <br />

                        <input type="submit" class="btn btn-info" value="Add GRN">
                        <div class="form-group">
                            @if(session()->has('errors'))
                            <label class="text-danger font-weight-bold p-3"> {{session()->get('errors') }}</label>
                            @elseif(session()->has('success'))
                            <label class="text-success font-weight-bold p-3"> {{session()->get('success') }} </label>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection