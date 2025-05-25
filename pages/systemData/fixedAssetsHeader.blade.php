<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Fixed Assets Header Details')

@section('content')
<div class="container">
    <div class="row">

        <div class="container" id="faccontainer">

            <h1>Fixed Assets Header Details</h1>
            <div class="row">
                <div class="col-md-12">

                    <form action=" {{ url('/save_fix_assert') }}" method="POST">
                        {{csrf_field()}}

                        <br> </br>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-header">Header Code</label>
                            <div class="col-sm-9">

                                <input value="{{$nextNumber }}" readonly class="form-control" type="text" name="header" placeholder="Enter Header Code" required="required" id="header">


                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-details">Description</label>
                            <div class="col-sm-9">

                                <input value="" class="form-control" type="text" name="details" placeholder="Enter Header Code" required="required" id="details">


                            </div>
                        </div>

                        </br>
                        <input type="submit" class="btn btn-primary" value="ADD">
                        <input type="button" class="btn btn-warning" value="CLEAR">
                        </br> </br>
                    </form>

                    <table class="table table-dark">
                        <th> Header Code</th>
                        <th> Description</th>
                        @foreach($fix_assert as $fix_assert_header)
                        <tr>
                            <td> {{$fix_assert_header->fh_FxHdr}} </td>
                            <td> {{$fix_assert_header->fh_FxDesc}} </td>
                            <td>

                                <!-- {{csrf_field()}} -->
                                <!-- <a href="/Stores/public/delete_data_fix/{{$fix_assert_header->id}}" class="btn btn-danger">Delete</a> -->
                                <a href=" {{ url('/updatefixview/'.$fix_assert_header->id)}}" class="btn btn-warning">Update</a>

                            </td>
                        </tr>
                        @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #faccontainer {
        text-align: left;
        /* margin-top: 100px;
    margin-bottom: 80px; */
    }

    h1 {
        text-align: center;
    }
</style>
@endsection