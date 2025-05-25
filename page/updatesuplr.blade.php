<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Update Supplier Details')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Update Supplier Details</h1>
        <div class="row">
                <div class="col-md-12">
               
                <form action="{{ url('/updatesuplrdetails') }}" method="POST"> 
                {{csrf_field()}} 
                <br> </br>

                <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Supplier Details ID</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="id" placeholder=" Fixed assests Supplier details ID" name="id" value="{{$singleuserdata->id}}" Readonly>
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Supplier Name </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="supplier" placeholder=" Fixed assests Supplier details ID" name="supplier" value="{{$singleuserdata->Supplier}}" >
                          </div>
                      </div>

                      

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Address Line 01 </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="add1" placeholder=" Fixed assests Supplier details ID" name="add1" value="{{$singleuserdata->Add1}}" >
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Address Line 02 </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="add2" placeholder=" Fixed assests Supplier details ID" name="add2" value="{{$singleuserdata->Add2}}" >
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Address Line 03 </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="add3" placeholder=" Fixed assests Supplier details ID" name="add3" value="{{$singleuserdata->Add3}}" >
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Telephone No. </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="phone" placeholder=" Fixed assests Supplier details ID" name="phone" value="{{$singleuserdata->Phone}}" >
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">E-mail Address </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="email" placeholder=" Fixed assests Supplier details ID" name="email" value="{{$singleuserdata->EMail}}" >

                          </div>
                      </div>

                      </br>
              <button type="submit" class="btn btn-primary">Update</button>
                </br> </br>     
                </form>
              
                
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

                     