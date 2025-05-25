<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Reports - Consumables (GRN)')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            <br /><br /><br /><br /><br />
            <h1 style='text-align:center'> Reports - Consumables (GRN)</h1>
            <br /><br />
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ url('/reports/conItem/grn/filter/results') }}">
                        {{csrf_field()}}

                        <div class="form-group form-row">
                            <div class="col-sm-6">
                                <label class="" for="grnNo"> GRN Number (From): </label>
                                <div class="">
                                    <input class="form-control" type="number" name="grnNoFrom" value="" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="" for="grnNo"> To : </label>
                                <div class="">
                                    <input class="form-control" type="number" name="grnNoTo" value="" >
                                </div>
                            </div>
                        </div>

                        @include('layouts.messagePopup')
                        <div class="text-right">
                            <input type="submit" class="btn btn-info" value="View">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection