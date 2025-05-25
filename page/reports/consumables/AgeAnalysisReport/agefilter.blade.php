<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title', 'Age Analysis - Consumable Items')
@section('content')
    <div class="container">
        <div class="row">
            <div class="container">
                <br /><br /><br /><br /><br />
                <h1 style='text-align:center'> Age Analysis - Consumable Items</h1>
                <br /><br />
                <div class="row">
                    <div class="col-md-12">
                        <br />
                        <form action="{{ url('/reports/conItem/AgeAnalysisReport/results') }}" method="post"
                            onsubmit="return validateForm()">
                            {{ csrf_field() }}
                            <div class="form-group form-row">
                                <br> <br>
                                <label class="col-sm-1" for="hdrSelect">To Date:</label>
                                <div class="col-sm-11">
                                    <input value="" class="form-control date" type="date" name="toDate"
                                        placeholder="Enter date here" id="toDate" max="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <br />
                            <div class="text-right">
                                <input type="submit" class="btn btn-info" value="View">
                            </div>
                        </form>
                    </div>
                </div>
                @include('layouts.messagePopup')
            </div>
        </div>
    </div>
    </div>
@endsection
