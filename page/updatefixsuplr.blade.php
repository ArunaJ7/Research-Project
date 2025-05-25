<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Update Fixed Assert Supplier Details')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Update Fixed Assert Supplier Details</h1>
        <div class="row">
                <div class="col-md-12">
               
                <form action="/Stores/public/updatefixsuplrdetails" method="POST"> 
                {{csrf_field()}} 
                <br> </br>

                <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Fixed Assests Supplier Details ID</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="id" placeholder=" Fixed assests Supplier details ID" name="id" value="{{$singleuserdata->id}}" Readonly>
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Supplier </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="supplier" placeholder=" Fixed assests Supplier details ID" name="supplier" value="{{$singleuserdata->frhSupplier}}" >
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">date </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="date" placeholder=" Fixed assests Supplier details ID" name="date" value="{{$singleuserdata->frhDate}}" >
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">GRN No. </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="serial" placeholder=" Fixed assests Supplier details ID" name="serial" value="{{$singleuserdata->frhMSerial}}" >
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Address Line 01 </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="add1" placeholder=" Fixed assests Supplier details ID" name="add1" value="{{$singleuserdata->frhAdd1}}" >
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Address Line 02 </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="add2" placeholder=" Fixed assests Supplier details ID" name="add2" value="{{$singleuserdata->frhAdd2}}" >
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Address Line 03 </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="add3" placeholder=" Fixed assests Supplier details ID" name="add3" value="{{$singleuserdata->frhAdd3}}" >
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Telephone No. </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="phone" placeholder=" Fixed assests Supplier details ID" name="phone" value="{{$singleuserdata->frhPhone}}" >
                          </div>
                      </div>

                      <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">E-mail Address </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="email" placeholder=" Fixed assests Supplier details ID" name="email" value="{{$singleuserdata->frhEMail}}" >

                        @error('email')
                                <span class = "text-danger">{{$message}}</span>

                        @enderror


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

                     