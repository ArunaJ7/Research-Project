<!DOCTYPE html>
@extends('layouts.mainlayout')
 


@section('content')
<html lang="en">
<head>
    
    <title>Supplier</title>
</head>
<body>
<div class="container">
  <div class="row">

    <div class="col-md-8">
    <br> <br> <br> <br> <br> <br>
    @include('layouts.nav')
                <form  method="post" action="/updateSup">
                    {{csrf_field()}}
                
                    <div class="form-group">
        
                          <input type="hidden" class="form-control" id="id"  name="id" value="{{$singleuserdata->id}}" readonly>
                  
                      </div>

                      <div class="form-group">
                          <label for="date">Date</label>
                          <input type="date" class="form-control" id="date" placeholder="Date: " name="date" value="{{$singleuserdata->crhDate}}" required>
                  
                      </div>

                    <div class="form-group">
                          <label for="supplierId">Supplier ID</label>
                          <input type="text" class="form-control" id="supplierid" placeholder="Enter Supplier ID: " name="supplierid" value="{{$singleuserdata->crhMSerial}}" required>
                  
                      </div>

                      <div class="form-group">
                          <label for="supplierName">Supplier Name</label>
                          <input type="text" class="form-control" id="supplierName" placeholder="Enter Supplier Name" name="supplierName" value="{{$singleuserdata->crhSupplier}}" required>
                      </div>

                      <div class="form-group ">
                          <label for="address">Supplier Address</label>
                          <input type="text" class="form-control" id="address1" placeholder="Edit Address1" name="address1" value="{{$singleuserdata->crhAdd1}}" required>
                          <input type="text" class="form-control" id="address2" placeholder="Edit Address2" name="address2" value="{{$singleuserdata->crhAdd2}}" required>
                          <input type="text" class="form-control" id="address3" placeholder="Edit Address3" name="address3" value="{{$singleuserdata->crhAdd3}}" required>
                      </div>

                      

                      <button type="submit" class="btn btn-primary">Update</button>
                
                </form>
    
    
    </div>

   
  </div>
  </div>
    
</body>
</html>
