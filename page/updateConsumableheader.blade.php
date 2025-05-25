<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Consumable header details')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

<h1> Consumable header details</h1>
        <div class="row">
                <div class="col-md-12">
              
                <form method="post" action="{{ url('/updateconheader') }}">
                {{csrf_field()}}
               
                      <br> </br>

                      <div class="form-group form-row">
                          <label class="col-sm-3" for="input-id">User ID</label>
                          <div class="col-sm-9">
                              <input value="{{$singleuserdata->id}}" class="form-control" type="text" name="id" placeholder="Enter User Id" required="required" id="id" Readonly >
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label class="col-sm-3" for="input-id">Header code</label>
                          <div class="col-sm-9">
                               <input value="{{$singleuserdata->ch_ConHdr}}" class="form-control" type="text" name="header_code" placeholder="Enter Header Code" required="required" id="header_code">
                          </div>
                      </div>
                
                      <div class="form-group form-row">
                          <label class="col-sm-3" for="input-id">Description</label>
                          <div class="col-sm-9">
                              <input value="{{$singleuserdata->ch_ConDesc}}" class="form-control" type="text" name="discription" placeholder="Enter Discription" required="required" id="discription">
                          </div>
                      </div>

                      </br>
                      <input type="submit" class="btn btn-primary" value="UPDATE">
                      <input type="button" class="btn btn-warning" value="CLEAR">
                      </br> </br>     
                </form>
           
                </div>
        </div> 

    </div>
</div>
</div>

@endsection
