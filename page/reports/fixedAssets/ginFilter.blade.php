<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Reports - Fixed Assets (GIN)')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            <br /><br /><br /><br /><br />
            <h1 style='text-align:center'> Reports - Fixed Assets (GIN)</h1>
            <br /><br />
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ url('/reports/fxItem/gin/filter/results') }}">
                        {{csrf_field()}}

                        <div class="form-group form-row">
                            <div class="col-sm-6">
                                <label class="" for="ginNo"> GIN Number (From): </label>
                                <div class="">
                                    <input class="form-control" type="number" name="ginNoFrom" value="" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="" for="ginNo"> To : </label>
                                <div class="">
                                    <input class="form-control" type="number" name="ginNoTo" value="" >
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
