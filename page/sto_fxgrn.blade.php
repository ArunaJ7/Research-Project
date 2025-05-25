<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Goods Received Note(GRN) - Fixed Assests')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Goods Received Note(GRN) - Fixed Assests</h1>
        <div class="row">
                <div class="col-md-12">
               
                <form action="/Stores/public/sto_fix_grn" method="POST"> 
                {{csrf_field()}} 
                <br></br>

                <div class="form-group form-row">
              <label class="col-sm-3" for="input-applicant">Supplier</label>
                <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Header" id="supplier" name="supplier">
                            <option value="0" disabled selected>Select Header</option>
                            @foreach($stosup as $fix_grn)
                            <option  value="{{$fix_grn->id}}">
                                {{ ucfirst($fix_grn->frhSupplier) }}</option>
                            @endforeach
                        </select>
                        </div> 
                        </div> 


                <div class="form-group form-row">
                <label class="col-sm-3" for="input-">Date</label>
                <div class="col-sm-9">
        
                <input value="" class="form-control" type="date" name="bdate" placeholder="Enter Voucher/PO Number" required="required" id="bdate">

        
              </div>
              </div>


                <div class="form-group form-row">
                <label class="col-sm-3" for="input-">GRN No.</label>
                <div class="col-sm-9">
        
                <input value="" class="form-control" type="text" name="grn" placeholder="Enter GRN Number" required="required" id="grn">

        
              </div>
              </div>




                <div class="form-group form-row">
                <label class="col-sm-3" for="input-">Voucher/PO</label>
                <div class="col-sm-9">
        
                <input value="" class="form-control" type="text" name="vco" placeholder="Enter Voucher/PO Number" required="required" id="vco">

        
              </div>
              </div>

              <div class="form-group form-row">
                <label class="col-sm-3" for="input-">Receipt No</label>
                <div class="col-sm-9">
        
                <input value="" class="form-control" type="text" name="rct" placeholder="Enter Receipt No" required="required" id="rct">

        
              </div>
              </div>

              
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-">Sub No</label>
                <div class="col-sm-9">
        
                <input value="" class="form-control" type="text" name="subno" placeholder="Enter Sub No" required="required" id="subno">

        
              </div>
              </div>

             

                        <div class="form-group form-row">
              <label class="col-sm-3" for="input-applicant">Header</label>
                <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Header" id="head" name="head">
                            <option value="0" disabled selected>Select Header</option>
                            @foreach($sto_fxhdrs as $fix_grn)
                            <option  value="{{$fix_grn->id}}">
                                {{ ucfirst($fix_grn->full_desc) }}</option>
                            @endforeach
                        </select>
                        </div> 
                        </div> 

                        <div class="form-group form-row">
              <label class="col-sm-3" for="input-applicant">Item</label>
                <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Header" id="item" name="item">
                            <option value="0" disabled selected>Select Header</option>
                            @foreach($sto_fxhdr2s as $fix_grn2)
                            <option  value="{{$fix_grn2->id}}">
                                {{ ucfirst($fix_grn2->full_desc_2) }}</option>
                            @endforeach
                        </select>
                        </div> 
                        </div> 

                        <div class="form-group form-row">
                <label class="col-sm-3" for="input-">Quantity</label>
                <div class="col-sm-9">
        
                <input value="" class="form-control" type="text" name="qty" placeholder="Enter Quantity" required="required" id="qty">

        
              </div>
              </div>

              <div class="form-group form-row">
                <label class="col-sm-3" for="input-">Unit Price</label>
                <div class="col-sm-9">
        
                <input value="" class="form-control" type="text" name="unprice" placeholder="Enter Unit Price" required="required" id="unprice">

        
              </div>
              </div>

              <div class="form-group form-row">
                <label class="col-sm-3" for="input-">Remark</label>
                <div class="col-sm-9">
        
                <input value="" class="form-control" type="text" name="rmrk" placeholder="Enter Remark" required="required" id="rmrk">

        
              </div>
              </div>

                
              </br>
                <input type="submit" class="btn btn-primary" value="SAVE">
                <input type="reset" class="btn btn-warning" value="CLEAR">
                </br> </br>  

                </form>
                <table class="table table-dark">
                <th> ID</th>
                <th> Date</th>
                <th> GRN No.</th>
                <th> Supplier</th>
                <th> Voucher/PO</th>
                <th> Receipt No</th>
                <th> Sub No</th>
                <th> Header</th>
                <th> Item</th>
                <th> Quantity</th>
                <th> Unit Price</th>
                <th> Remarks</th>
                
                @foreach($sto_fixgrn as $sto_fixgrn3)
                <tr>
                <td> {{$sto_fixgrn3->id}} </td>
                <td> {{$sto_fixgrn3->binDate}} </td>
                <td> {{$sto_fixgrn3->binMSerial}} </td>
                <td> {{$sto_fixgrn3->frhSupplier}} </td>
                <td> {{$sto_fixgrn3->binVch_PO}} </td>
                <td> {{$sto_fixgrn3->binRct}} </td>
                <td> {{$sto_fixgrn3->binSerial}} </td>
                <td> {{$sto_fixgrn3->fh_FxHdr}} </td>
                <td> {{$sto_fixgrn3->fh_FxHdr2}} </td>
                <td> {{$sto_fixgrn3->binQty}} </td>
                <td> {{$sto_fixgrn3->binUnitPrice}} </td>
                <td> {{$sto_fixgrn3->binRmks}} </td>
             
               

                <td width="17%>
                {{csrf_field()}}
     
                <a href="/Stores/public/deletesto_fixgrn/{{$sto_fixgrn3->id}}" class="btn btn-danger">Delete</a>
                <a href="/Stores/public/updatesto_fixgrn/{{$sto_fixgrn3->id}}" class="btn btn-warning">Update</a>
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
    /* margin-top: 100px;
    margin-bottom: 80px; */
}

h1{
    text-align: center;
}

</style>
@endsection

              