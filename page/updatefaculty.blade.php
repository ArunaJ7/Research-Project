<!DOCTYPE html>
@extends('layouts.mainlayout')
 


@section('content')
<html lang="en">
<head>
    
    <title>Document</title>
</head>
<body>
<div class="container">
  <div class="row">

    <div class="col-md-8">
    <br> <br> <br> <br> <br> <br>
    @include('layouts.nav')
                <form  method="post" action="/updatedata">
                    {{csrf_field()}}
                
                    <div class="form-group">
                          <label for="facultyid">Faculty ID</label>
                          <input type="text" class="form-control" id="facultyid" placeholder="Enter Faculty Name" name="facultyid" value="{{$singleuserdata->id}}" Readonly>
                  
                      </div>

                      <div class="form-group">
                          <label for="facultyname">Faculty Name</label>
                          <input type="text" class="form-control" id="facultyname" placeholder="Enter username" name="facultyname" value="{{$singleuserdata->name}}" required>
                      </div>

                      

                      

                      <button type="submit" class="btn btn-primary">Update</button>
                
                </form>
    
    
    </div>

   
  </div>
  </div>
    
</body>
</html>







































