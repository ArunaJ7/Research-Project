<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Fixed Assert Supplier Details')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Fixed Assert Supplier Details</h1>
        <div class="row">
                <div class="col-md-12">
               
                <form action="/Stores/public/fixassrtsuplr" method="POST"> 
                {{csrf_field()}} 
<br> </br>
                
                <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">Supplier</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="supplier" placeholder="Enter Supplier Name" required="required" id="supplier">

              </div>
              </div>
              
              
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">Date</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="date" name="date" placeholder="Enter Description" required="required" id="date">

              </div>
              </div>
             
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">GRN No.</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="serial" placeholder="Enter GRN No." required="required" id="serial">

              </div>
              </div>

              <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">Address Line 01</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="add1" placeholder="Enter Address Line 01" required="required" id="add1">

              </div>
              </div>

              <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">Address Line 02</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="add2" placeholder="Enter Address Line 02" required="required" id="add2">

              </div>
              </div>

              <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">Address Line 03</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="add3" placeholder="Enter Address Line 03" required="required" id="add3">

              </div>
              </div>

              <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">Telephone No.</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="phone" placeholder="Enter Telephone No." required="required" id="phone">

              </div>
              </div>

              <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">E-mail Address</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="email" placeholder="Enter E-mail Address" required="required" id="email">

        @error('email')
            <span class = "text-danger">{{$message}}</span>

            @enderror



              </div>
              </div>


              </br>
                <input type="submit" class="btn btn-primary" value="ADD">
                <input type="reset" class="btn btn-warning" value="CLEAR">
                </br> </br>     
                </form>

                <table class="table table-dark ">
                <th> ID</th>
                <th> Supplier Name</th>
                <th> Date</th>
                <th> GRN No</th>
                <th> Address 01</th>
                <th> Address 02</th>
                <th> Address 03</th>
                <th> Telephone</th>
                <th> E-mail Address</th>
                
                @foreach($fix_suplr as $fix_suplrs)

                <tr>
                <td> {{$fix_suplrs->id}} </td>
                <td> {{$fix_suplrs->frhSupplier}} </td>
                <td> {{$fix_suplrs->frhDate}} </td>
                <td> {{$fix_suplrs->frhMSerial}} </td>
                <td> {{$fix_suplrs->frhAdd1}} </td>
                <td> {{$fix_suplrs->frhAdd2}} </td>
                <td> {{$fix_suplrs->frhAdd3}} </td>
                <td> {{$fix_suplrs->frhPhone}} </td>
                <td> {{$fix_suplrs->frhEMail}} </td>
               
               
                <td width="17%>
                
                {{csrf_field()}}
                <a href="/Stores/public/delete_data/{{$fix_suplrs->id}}" class="btn btn-danger">Delete</a>
                <a href="/Stores/public/updatefixsuplr/{{$fix_suplrs->id}}" class="btn btn-warning">Update</a>
                
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
    margin-top: 100px;
    margin-bottom: 80px;
}

h1{
    text-align: center;
}

</style>
@endsection