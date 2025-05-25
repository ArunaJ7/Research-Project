<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Project Details')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

      <h1> Project Details </h1>
      <div class="row">
        <div class="col-md-12">

          <form action="{{url('/updateProjects')}}" method="POST">
            {{csrf_field()}}

            <br> </br>
            
          <input type="hidden" name="id" value="{{$updatedatarow->id}}">
            

            <div class="form-group form-row">
              <label class="col-sm-3" for="input-header">Project Code</label>
              <div class="col-sm-9">

                <input type="text"  value="{{$updatedatarow->projCode}}"  class="form-control" name="proj_code" placeholder="Enter Updated Project Code" required="required" id="proj_code">


              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-3" for="input-details">Project Description</label>
              <div class="col-sm-9">

                <input value="{{$updatedatarow->projDesc}}" class="form-control" type="text" name="proj_desc" placeholder="Enter Updated Project Description" required="required" id="proj_desc">


              </div>
            </div>


            <button type="submit" class="btn btn-primary">UPDATE</button>
            </br> </br>
          </form>


        </div>


      </div>
    </div>

  </div>
</div>

</body>

</html>