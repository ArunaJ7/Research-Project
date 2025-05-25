<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title',' Update Goods Received Note(GRN) - Fixed Assests')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Update Goods Received Note(GRN) - Fixed Assests</h1>
        <div class="row">
                <div class="col-md-12">
               
                <form action="/Stores/public/update_Fixed_Assests" method="POST"> 
                {{csrf_field()}} 
                <br> </br>

                <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Fixed Assests GRN ID</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="id" placeholder=" Fixed assests category details ID" name="id" value="{{$sto_fixgrn->id}}" Readonly>
                          </div>
                      </div>

                <div class="form-group form-row">
            <label class="col-sm-3" for="header">Supplier</label>
            <div class="col-sm-9">
            <select class="form-control formselect required" placeholder="Select System Name" id="supplier" name="supplier" required="required">
                @foreach($sto_fixgrnup5 as $syst)
                    <option value="{{ucfirst($syst->id)}}" selected>
                    {{ucfirst($syst->frhSupplier)}}</option>
                @endforeach
                @foreach($stosup as $systms)
                    <option  value="{{$systms->id}}">
                    {{ ucfirst($systms->frhSupplier) }}</option>
                @endforeach
            </select>
            </div>
            </div> 

            <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Date</label>
                          <div class="col-sm-9">
                          <input type="date" class="form-control" id="bdate" placeholder=" Fixed assests category details ID" name="bdate" value="{{$sto_fixgrn->binDate}}" >
                          </div>
                      </div>

             <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">GRN No.</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="grn" placeholder=" Fixed assests category details ID" name="grn" value="{{$sto_fixgrn->binMSerial}}" >
                          </div>
                      </div>


            <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Voucher/PO</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="vco" placeholder=" Fixed assests category details ID" name="vco" value="{{$sto_fixgrn->binVch_PO}}" >
                          </div>
                      </div>

            <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Receipt No</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="rct" placeholder=" Fixed assests category details ID" name="rct" value="{{$sto_fixgrn->binRct}}" >
                          </div>
                      </div>


            <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Sub No</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="subno" placeholder=" Fixed assests category details ID" name="subno" value="{{$sto_fixgrn->binSerial}}" >
                          </div>
                      </div>

            <div class="form-group form-row">
            <label class="col-sm-3" for="header">Header</label>
            <div class="col-sm-9">
            <select class="form-control formselect required" placeholder="Select System Name" id="head" name="head" required="required">
                @foreach($sto_fixgrnup55 as $syst)
                    <option value="{{ucfirst($syst->id)}}" selected>
                    {{ucfirst($syst->full_desc)}}</option>
                @endforeach
                @foreach($sto_fxhdrs as $systms)
                    <option  value="{{$systms->id}}">
                    {{ ucfirst($systms->full_desc) }}</option>
                @endforeach
            </select>
            </div>
            </div> 


            <div class="form-group form-row">
            <label class="col-sm-3" for="header">Item</label>
            <div class="col-sm-9">
            <select class="form-control formselect required" placeholder="Select System Name" id="item" name="item" required="required">
                @foreach($sto_fixgrnup4 as $syst)
                    <option value="{{ucfirst($syst->id)}}" selected>
                    {{ucfirst($syst->full_desc_2)}}</option>
                @endforeach
                @foreach($sto_fxhdr2s as $systms)
                    <option  value="{{$systms->id}}">
                    {{ ucfirst($systms->full_desc_2) }}</option>
                @endforeach
            </select>
            </div>
            </div> 

            <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Quantity</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="qty" placeholder=" Fixed assests category details ID" name="qty" value="{{$sto_fixgrn->binQty}}" >
                          </div>
                      </div>

            <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Unit Price</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="unprice" placeholder=" Fixed assests category details ID" name="unprice" value="{{$sto_fixgrn->binUnitPrice}}" >
                          </div>
                      </div>

            <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Remark</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="rmrk" placeholder=" Fixed assests category details ID" name="rmrk" value="{{$sto_fixgrn->binRmks}}" >
                          </div>
                      </div>




            <br> </br>

<button type="submit" class="btn btn-primary">Update</button >

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
