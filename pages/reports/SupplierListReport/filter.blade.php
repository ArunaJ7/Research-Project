<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title','Supplier List')
@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">
            <br><br>
            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> Supplier List Reports </h3>
            <br />
                <form action='{{url("/Supplier/view-reports")}}' method="POST">
                {{csrf_field()}}
                <!-- Header -->
                <!-- Item -->
                <div class="form-group form-row">
                            <label class="col-sm-3" for="sup">Select Supplier</label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" placeholder="Select Supplier" id="SupSelect" name="SupSelect">
                                    <option value="0" disabled selected>Select Supplier</option>
                                    @foreach($supplier as $supplier)
                                    <option value="{{$supplier->id}}">
                                        {{ ucfirst($supplier->Supplier) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                </br>
                <input type="submit" class="btn btn-warning"value="View">
                <input type="button" class="btn btn-danger" value="Close">
                </br></br>
            </form>


        </div>
    </div>
</div>
@endsection
