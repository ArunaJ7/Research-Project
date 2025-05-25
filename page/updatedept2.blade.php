<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >
    <title>Document</title>
</head>
<body>

<div class="container">
  
  <div class="row" style="align:center">
              
    <div class="col-md-12">
    
    
                <form  method="post" action="/updatedept">
                    {{csrf_field()}}
                
                    <div class="form-group">
                          <label for="deptid">Department ID</label>
                          <input type="text" class="form-control" id="deptid" placeholder="Enter Faculty Name" name="deptid" value="{{$singleuserdata->id}}" Readonly>
                  
                      </div>
                      <select class="form-control formselect required" placeholder="Select Faculty" id="facultySelect" name="facultySelect">
                      @foreach($fname as $fnames)
                      <option value="'{{ucfirst($fnames->id)}}'"  selected> {{ucfirst($fnames->name)}}</option>
                      @endforeach
                      
                            @foreach($task as $tasks)
                            <option  value="{{$tasks->id}}">
                                {{ ucfirst($tasks->name) }}</option>
                            @endforeach
                           
                        </select>

                      <div class="form-group">
                          <label for="deptname">Department Name</label>
                          <input type="text" class="form-control" id="deptname" placeholder="Enter username" name="deptname" value="{{$singleuserdata->dname}}" required>
                      </div>

                      

                      

                      <button type="submit" class="btn btn-primary">Update</button>
                
                </form>
    
    
    </div>

    

  </div>
  </div>

</body>
</html>
@endsection