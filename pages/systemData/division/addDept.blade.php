<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Division')

@section('content')
<div class="container">
    <div class="row content-container">

        <div class="container">
            <h1> Divisions </h1>
            <br />
            <div class="row text-left">
                <div class="col-md-12 ">
                    <!--form action start at this point-->
                    <form action="{{ url('/dept/savedata') }}" method="POST">
                        {{csrf_field()}}
                        <br> </br>
                        <!--dropdown to select departments-->
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="dept">Select Department</label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" placeholder="Select Department" id="dname" required="required" name="dept">
                                    <option value="0" disabled selected>Select Department</option>
                                    @foreach($Department as $sto_header)
                                    <option value="{{$sto_header->id}}">
                                        {{ ucfirst($sto_header->dname) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="deptName">Division Name</label>
                            <div class="col-sm-9">
                                <input value="" class="form-control" type="text" name="deptName" placeholder="Enter Division Name" required="required" id="dept">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="dpcode">Department Code</label>
                            <div class="col-sm-9">
                                <input value="" class="form-control" type="text" name="dpcode" maxlength="03" placeholder="Department Code" id="add1">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="dpFA">Department FA</label>
                            <div class="col-sm-9">
                                <input value="" class="form-control" type="text" name="dpFA" placeholder="Department FA" id="add2">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div style="display: flex; gap: 10px;">
                                <input type="submit" class="btn btn-primary" value="ADD"></button>
                                <input type="reset" class="btn btn-secondary" value="CLEAR"></button>
                                @include('layouts.messagePopup')
                            </div>
                        </div>
                    </form>
                    <!--Table to view the data on the page-->
                    <table class="table table-dark ">
                        <th> ID</th>
                        <th> Department Name</th>
                        <th> Division Name</th>
                        <th> Department Code</th>
                        <th> Depatment FA</th>
                        @foreach($departments as $update_dept_data)
                        <tr>
                            <td> {{$update_dept_data->id}} </td>
                            <td> {{$update_dept_data->admindept}} </td>
                            <td> {{$update_dept_data->deptName}} </td>
                            <td> {{$update_dept_data->deptCode}} </td>
                            <td> {{$update_dept_data->deptFA}} </td>
                            <td>
                                @can('stores.dept.deletedata')<!--Delete the data by the permission-->
                                <a href="{{ url('/dept/deletedata/' . $update_dept_data->id) }}" class="btn btn-danger m-2"
                                    confirmation="Are you sure? Do you want to delete this ?"
                                    type="button">Delete</a>
                                @endcan
                                <a href="{{ url('/dept/updateview/' . $update_dept_data->id) }}" class="btn btn-warning">Update</a>
                            </td>
                        </tr>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection