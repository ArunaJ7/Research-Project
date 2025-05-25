<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Fixed Assets Header Details')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

      <h1> Fix Assets Header Details</h1>
      <div class="row">
        <div class="col-md-12">

          <form action="{{url('/updatefixassert')}}" method="POST">
            {{csrf_field()}}

            <br> </br>

            <div class="form-group form-row">
              <label for="rid" class="col-sm-3">ID</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="sid" placeholder="Edit  ID" name="sid" value="{{$singleuserdata->id}}" Readonly>
              </div>
            </div>


            <div class="form-group form-row">
              <label class="col-sm-3" for="input-header">Header Code</label>
              <div class="col-sm-9">

                <input value="{{$singleuserdata->fh_FxHdr}}" readonly class="form-control" type="text" name="header" placeholder="Enter Header Code" required="required" id="header">


              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-3" for="input-details">Description</label>
              <div class="col-sm-9">

                <input value="{{$singleuserdata->fh_FxDesc}}" class="form-control" type="text" name="details" placeholder="Enter Header Code" required="required" id="details">


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