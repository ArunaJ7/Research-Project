<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Designation')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Designation Details</h1>
        <div class="row">
                <div class="col-md-12">
               
                <form action="\savedesig" method="POST"> 
                {{csrf_field()}}
                <div class="form-group form-row">
                <label class="col-sm-3" for="input-title">Designation </label>
                <div class="col-sm-9" style="align:left">
                <input type="text" class="form-control" name="designation" placeholder="Enter the Designation Here"></br>
                </div>
              </div>
               
                <div class="form-group form-row">
                <label class="col-sm-3" for="input-title">Designation Type</label>
                <div class="col-sm-9" style="align:left">
                <input type="radio" id="academic" name="desigtype" value="1">
             <label for="academic">Academic</label><br>
            <input type="radio" id="nonacademic" name="desigtype" value="2">
            <label for="nonacademic">Non-Academic</label><br>
               
              </div>
              </div>
                
                </br></br>
                <input type="submit" class="btn btn-primary" value="SAVE">
                <input type="button" class="btn btn-warning" value="CLEAR">
                </br> </br>     
                </form>
                
           
                <table class="table table-dark" style="width:100%;">
                <th>ID</th>
                <th>DESIGNATION</th>
                <th>DESIGNATION TYPE</th>
                <th>IS ACTIVE</th>
                @foreach($designations as $designation)
                <tr>
                <td> {{$designation->id}} </td>
                <td>  {{$designation->designation}} </td>
                
                <td> <?php
                 if ($designation->desigtype==1)
                     echo 'Academic'; 
                     else if ($designation->desigtype==2)
                          echo 'non-Academic';?>
                          </td>
               
                <td>  {{$designation->IsActive}} </td>
                <td>
      
    </td>

    <td>
    {{csrf_field()}}
    <a href="/deletedesig/{{$designation->id}}" class="btn btn-danger">Delete</a>
    <a href="/updatedesig/{{$designation->id}}" class="btn btn-warning">Update</a>
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

h1{
    text-align: center;
}

</style>
@endsection