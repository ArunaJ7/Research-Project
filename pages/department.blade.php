<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Department')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

<h1> Department Details</h1>
        <div class="row">
                <div class="col-md-12">
              
                <form method="post" action="\savedep">
                {{csrf_field()}}
                <div class="form-group">
                <label for="exampleInputEmail1">Faculty Name</label>
                <select class="form-control formselect required" placeholder="Select Faculty" id="facultySelect" name="facultySelect">
                            <option value="0" disabled selected>Select Faculty*</option>
                            @foreach($task as $tasks)
                            <option  value="{{$tasks->id}}">
                                {{ ucfirst($tasks->name) }}</option>
                            @endforeach
                        </select>
                        </div> 
                        <div class="form-group">
                <label for="exampleFormControlInput1">Enter Department Name</label>
                <input type="text" class="form-control" id="depname" name="depname" placeholder="Department name">
            </div>
                
                </br>
                <input type="submit" class="btn btn-primary" value="SAVE">
                <input type="button" class="btn btn-warning" value="CLEAR">
                </br> </br>     
                </form>
               
                <table class="table table-dark">
                <th>ID</th>
                <th>FACULTY NAME</th>
                <th>DEPARTMENT NAME</th>
                <th>IsActive</th>
                @foreach($deptdata as $deptdata)
                <tr>
                <td> {{$deptdata->id}} </td>
                <td>  {{$deptdata->name}} </td>
                <td>  {{$deptdata->dname}} </td>
                <td>  {{$deptdata->IsActive}} </td>
                <td>
     
    <a href="/deletedept/{{$deptdata->id}}" class="btn btn-danger">Delete</a>
    <a href="/updatedept/{{$deptdata->id}}" class="btn btn-warning">Update</a>
    </td>
                </tr>
                @endforeach
                </div>
        </div>


        

    </div>

</div>

</div>
@endsection
