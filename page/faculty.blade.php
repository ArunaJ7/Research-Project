<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Faculty')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Faculty Details</h1>
        <div class="row">
                <div class="col-md-12">
               
                <form action="\savefaculty" method="POST"> 
                {{csrf_field()}}
                <input type="text" class="form-control" name="facultyname" placeholder="Enter the Faculty Name Here">
                
                </br>
                <input type="submit" class="btn btn-primary" value="SAVE">
                <input type="button" class="btn btn-warning" value="CLEAR">
                </br> </br>     
                </form>
                
           
                <table class="table table-dark" style="width:100%;">
                <th>ID</th>
                <th>FACULTY NAME</th>
                <th>IS ACTIVE</th>
                @foreach($faculties as $faculty)
                <tr>
                <td> {{$faculty->id}} </td>
                <td>  {{$faculty->name}} </td>
                <td>  {{$faculty->IsActive}} </td>
                <td>
      
    </td>

    <td>
    {{csrf_field()}}
    <a href="/deletefaculty/{{$faculty->id}}" class="btn btn-danger">Delete</a>
    <a href="/updatefaculty/{{$faculty->id}}" class="btn btn-warning">Update</a>
    </td>
   
                </tr>
                @endforeach
                </div>
        </div>




    </div>

  </div>

</div>
@endsection