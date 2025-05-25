<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Supplier Details')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Supplier Details</h1>
        <div class="row">
                <div class="col-md-12">
               
                <form action="{{ url('/suplr_details') }}" method="POST"> 
                {{csrf_field()}} 
<br> </br>
                
                <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">Supplier Name</label>
                <div class="col-sm-9">
        		<input value="" class="form-control" type="text" name="supplier" placeholder="Enter Supplier Name" required="required" id="supplier">
              	</div>
              </div>
              
              

              <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">Address Line 01</label>
                <div class="col-sm-9">
        		<input value="" class="form-control" type="text" name="add1" placeholder="Enter Address Line 01" id="add1">
              	</div>
              </div>

              <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">Address Line 02</label>
                <div class="col-sm-9">
        		<input value="" class="form-control" type="text" name="add2" placeholder="Enter Address Line 02" id="add2">
              	</div>
              </div>

              <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">Address Line 03</label>
                <div class="col-sm-9">
        		<input value="" class="form-control" type="text" name="add3" placeholder="Enter Address Line 03" id="add3">
              	</div>
              </div>

              <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">Telephone No.</label>
                <div class="col-sm-9">
        		<input value="" class="form-control" type="text" name="phone" placeholder="Enter Telephone No." id="phone">
              	</div>
              </div>

              <div class="form-group form-row">
                <label class="col-sm-3" for="input-sto_fxrcthdr">E-mail Address</label>
                <div class="col-sm-9">
        		<input value="" class="form-control" type="text" name="email" placeholder="Enter E-mail Address" id="email">
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
                <th> Address 01</th>
                <th> Address 02</th>
                <th> Address 03</th>
                <th> Telephone</th>
                <th> E-mail Address</th>
                                
                @foreach($suplr as $fix_suplrs)

                <tr>
                <td> {{$fix_suplrs->id}} </td>
                <td> {{$fix_suplrs->Supplier}} </td>
                <td> {{$fix_suplrs->Add1}} </td>
                <td> {{$fix_suplrs->Add2}} </td>
                <td> {{$fix_suplrs->Add3}} </td>
                <td> {{$fix_suplrs->Phone}} </td>
                <td> {{$fix_suplrs->EMail}} </td>
                <td>
                	<!--<a href="/Stores/public/delete_data/{{$fix_suplrs->id}}" class="btn btn-danger" disabled>Delete</a>-->
                	<a href="{{ url('/updatesuplr/'.$fix_suplrs->id)}}" class="btn btn-warning">Update</a>
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