<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Supplier')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="supplierDetails">
<br><br><br><br>
<h1> Supplier Details</h1>
        <div class="row">
                <div class="col-md-12">
              
                <form method="post" action="{{url('/savesupplier')}}">
                {{csrf_field()}}


                <div class="form-group">
                    <label for="adte">Select Date</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                </div>

                <div class="form-group">
                    <label for="supplierID">Enter Supplier ID</label>
                    <input type="text" class="form-control" id="supID" name="supID" placeholder="Supplier ID">
                </div>

                <div class="form-group">
                    <label for="supplierName">Enter Supplier Name</label>
                    <input type="text" class="form-control" id="supName" name="supName" placeholder="Supplier Name">
                </div>

                <div class="form-group form-row">
                    <label for="address">Supplier Address</label>
                        
                        <input value="" class="form-control" type="text" name="address1" placeholder="Enter the Address1" required="required" id="address1">
                        <input value="" class="form-control" type="text" name="address2" placeholder="Enter the Address2" required="required" id="address2">
                        <input value="" class="form-control" type="text" name="address3" placeholder="Enter the Address3" required="required" id="address3">
                        
                </div>
                
               </br>
                <input type="submit" class="btn btn-primary" value="SAVE">
                <input type="button" class="btn btn-warning" value="CLEAR">
                </br> </br>   
                </form>
                <table class="table table-dark">
                <th>DATE</th>
                <th>SUPPLIER ID</th>
                <th>SUPPLIER NAME</th>
                <th>ADDRESS 1</th>
                <th>ADDRESS 2</th>
                <th>ADDRESS 3</th>
                @foreach($Suppliers as $Supplier)
                <tr>
                <td> {{$Supplier->crhDate}} </td>
                <td> {{$Supplier->crhMSerial}} </td>
                <td>  {{$Supplier->crhSupplier}} </td>
                <td>  {{$Supplier->crhAdd1}} </td>
                <td>  {{$Supplier->crhAdd2}} </td>
                <td>  {{$Supplier->crhAdd3}} </td>
                <td>
     
    <a href="{{url('/deletesupplier/'.$Supplier->id)}}" class="btn btn-danger">Delete</a>
    <a href="{{url('/updatesupplier/'.$Supplier->id)}}" class="btn btn-warning">Update</a>
    </td>
                </tr>
               
                @endforeach
                </br></br></br></br>
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
