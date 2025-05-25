<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','GRN Items')

@section('content')

<div class="container">
    <div class="row">
  
      <div class="container" id="faccontainer">
  
        <h1>GRN Consumable Items</h1>
        <br>
        <div class="row">
            <div class="col-md-12">
                <form action="/Stores/public/updategrncon" method="POST">
                {{csrf_field()}}

                <div class="form-group form-row">
                    <label class="col-sm-2" for="id">ID</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="sid" placeholder="Edit  ID" name="upid" value="{{$updatedata->id}}" Readonly>
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Supplier Name & ID</label>
                    <div class="col-sm-9">
                    <select class="form-control formselect required" placeholder="Select Name & ID" id="upsupName_ID" name="upsupName_ID">
                        <option value="0" disabled selected>Select name</option>
                            @foreach($supplier as $suppliers)
                            <option  value="{{ucfirst($suppliers->id)}}"  selected>
                                {{ ucfirst($suppliers->full_desc) }}</option>
                            @endforeach
                            @foreach($supplier as $suppliers2)
                            <option  value="{{$suppliers2->id}}">
                                {{ ucfirst($suppliers2->full_desc) }}</option>
                            @endforeach
                    </select>
                </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">GRN No</label>
                    <div class="col-sm-9">
                    <input value="{{ $updatedata->GRNno }}" class="form-control" type="text" name="upGRNno" placeholder="Enter GRN No" required="required" id="upGRNno">
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Voucher/PO</label>
                    <div class="col-sm-9">
                    <input value="{{ $updatedata->VoucherPO }}" class="form-control" type="text" name="upVoucherPO" placeholder="Enter VoucherPO" required="required" id="upVoucherPO">
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Receipt No</label>
                    <div class="col-sm-9">
                    <input value="{{ $updatedata->receiptNo }}" class="form-control" type="text" name="upreceiptNo" placeholder="Enter Receipt No" required="required" id="upreceiptNo">
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Serial No</label>
                    <div class="col-sm-9">
                    <input value="{{ $updatedata->serialNo }}" class="form-control" type="text" name="upserialNo" placeholder="Enter Serial No" required="required" id="upserialNo">
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Header</label>
                    <div class="col-sm-9">
                    <select class="form-control formselect required" placeholder="Select header" id="upheader" name="upheader">
                        <option value="0" disabled selected>Select header</option>
                        
                        @foreach($consheader as $consheaders)
                            <option  value="{{ucfirst($consheaders->id)}}"  selected>
                                {{ ucfirst($consheaders->ch_ConHdr) }}</option>
                            @endforeach
                        @foreach($consheader as $consheaders2)
                        <option  value="{{$consheaders2->id}}">
                            {{ ucfirst($consheaders2->ch_ConHdr) }}</option>
                        @endforeach
                    </select>
                </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Item Name</label>
                    <div class="col-sm-9">
                    <select class="form-control formselect required" placeholder="Enter Item" id="upitem" name="upitem">
                        <option value="0" disabled selected>Select Item</option>
                        @foreach($itamname as $itamnames)
                            <option  value="{{ucfirst($itamnames->id)}}"  selected>
                                {{ ucfirst($itamnames->st_ConIDesc) }}</option>
                            @endforeach
                        @foreach($itamname as $itamnames2)
                        <option  value="{{$itamnames2->id}}">
                            {{ ucfirst($itamnames2->st_ConIDesc) }}</option>
                        @endforeach
                    </select>
                </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Unit Price</label>
                    <div class="col-sm-9">
                    <input value="{{ $updatedata->unitPrice }}" class="form-control" type="text" name="upunitPrice" placeholder="Enter Unit Price" required="required" id="upunitPrice">
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Remarks</label>
                    <div class="col-sm-9">
                    <input value="{{ $updatedata->remarks }}" class="form-control" type="text" name="upremarks" placeholder="Enter Remarks" required="required" id="upremarks">
                    </div>
                </div>
                <br>
                <input type="submit" class="btn btn-primary" value="UPDATE">
                <input type="reset" class="btn btn-warning" value="CLEAR">
                </br></br> 
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
