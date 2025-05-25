<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Good Received Note - Fixed Assets')

@section('content')
<div class="container">
    <div class="row">

        <div class="container">

            <br /><br /><br /><br /><br />

            <h1 style='text-align:center'> Good Issue Note(GIN) - Fixed Asset Items</h1>
            <br /><br />
            <div class="row">
                <div class="col-md-12">

                    <form method="post" action="{{ url('/ginFx') }}">
                        {{csrf_field()}}

                        <div class="form-group form-row">
                            <label class="col-sm-2" for="GinNo">GIN No *</label>
                            <div class="col-sm-9">
                                <input value="" class="form-control" type="text" name="GinNo" placeholder="Enter GIN No" required="required" id="GinNo">
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