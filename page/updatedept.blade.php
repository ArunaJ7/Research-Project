@extends('layouts.mainlayout')

  
@section('title','Update Department')
@section('content')


<div class="container" id="container_department">
  
  <div class="row" style="align:center">
              
    <div class="col-md-12">
    
    
                <form  method="post" action="/updatedeptdata">
                    {{csrf_field()}}
                
                    <div class="form-group">
                          <label for="deptid">Department ID</label>
                          <input type="text" class="form-control" id="deptid" placeholder="Enter Faculty Name" name="deptid" value="{{$singleuserdata->id}}" Readonly>
                  
                      </div>
                      <div class="form-group">
                          <label for="deptid">Department ID</label>
                      <select class="form-control formselect required" placeholder="Select Faculty" id="facultySelect" name="facultySelect">
                      @foreach($fname as $fnames)
                      <option value="'{{ucfirst($fnames->id)}}'"  selected> {{ucfirst($fnames->name)}}</option>
                      @endforeach
                      
                            @foreach($task as $tasks)
                            <option  value="{{$tasks->id}}">
                                {{ ucfirst($tasks->name) }}</option>
                            @endforeach
                           
                        </select>
                      </div>
                      <div class="form-group">
                          <label for="deptname">Department Name</label>
                          <input type="text" class="form-control" id="deptname" placeholder="Enter username" name="deptname" value="{{$singleuserdata->dname}}" required>
                      </div>

                      <button type="submit" class="btn btn-primary">Update</button>
                
                </form>
    
    
    </div>

    

  </div>
  </div>

@endsection