<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','GRN Consumable Items')

@section('content')

<div class="container">
    <div class="row">
  
      <div class="container" id="faccontainer">
  
        <h1>GRN Consumable Items</h1>
        <br>
        <div class="row">
            <div class="col-md-12">
                <form action="/Stores/public/savegrncon" method="POST">
                {{csrf_field()}}

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Supplier Name & ID</label>
                    <div class="col-sm-9">
                    <select class="form-control formselect required" placeholder="Select Name & ID" id="supName_ID" name="supName_ID">
                        <option value="0" disabled selected>Select name</option>
                        @foreach($supplier as $suppliers)
                        <option  value="{{$suppliers->id}}">
                            {{ ucfirst($suppliers->full_desc) }}</option>
                        @endforeach
                    </select>
                </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">GRN No</label>
                    <div class="col-sm-9">
                    <input value="" class="form-control" type="text" name="GRNno" placeholder="Enter GRN No" required="required" id="GRNno">
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Voucher/PO</label>
                    <div class="col-sm-9">
                    <input value="" class="form-control" type="text" name="VoucherPO" placeholder="Enter VoucherPO" required="required" id="VoucherPO">
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Receipt No</label>
                    <div class="col-sm-9">
                    <input value="" class="form-control" type="text" name="receiptNo" placeholder="Enter Receipt No" required="required" id="receiptNo">
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Serial No</label>
                    <div class="col-sm-9">
                    <input value="" class="form-control" type="text" name="serialNo" placeholder="Enter Serial No" required="required" id="serialNo">
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Header</label>
                    <div class="col-sm-9">
                    <select class="form-control formselect required" placeholder="Select header" id="header" name="header">
                        <option value="0" disabled selected>Select header</option>
                        @foreach($consheader as $consheaders)
                        <option  value="{{$consheaders->id}}">
                            {{ ucfirst($consheaders->ch_ConHdr) }}</option>
                        @endforeach
                    </select>
                </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Item Name</label>
                    <div class="col-sm-9">
                    <select class="form-control formselect required" placeholder="Enter Item" id="item" name="item">
                        <option value="0" disabled selected>Select Item</option>
                        @foreach($itamname as $itamnames)
                        <option  value="{{$itamnames->id}}">
                            {{ ucfirst($itamnames->st_ConIDesc) }}</option>
                        @endforeach
                    </select>
                </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Unit Price</label>
                    <div class="col-sm-9">
                    <input value="" class="form-control" type="text" name="unitPrice" placeholder="Enter Unit Price" required="required" id="unitPrice">
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2" for="supplier">Remarks</label>
                    <div class="col-sm-9">
                    <input value="" class="form-control" type="text" name="remarks" placeholder="Enter Remarks" required="required" id="remarks">
                    </div>
                </div>
                <br>
                <input type="submit" class="btn btn-primary" value="SAVE">
                <input type="reset" class="btn btn-warning" value="CLEAR">
                </br></br> 
                </form>
                <br>
                <br>
                <table class="table table-dark">
                    <th>ID</th>
                    <th>SupName&ID</th>
                    <th>GRN_No</th>
                    <th>Voucher_No</th>
                    <th>ReceiptNo</th>
                    <th>SerialNo</th>
                    <th>Header</th>
                    <th>Item Name</th>
                    <th>UnitPrice</th>
                    <th>Remark</th>
                    <th></th>

                    @foreach ($data as $data_n)
                    <tr>
                    <td>{{$data_n->id}}</td>
                    <td>{{$data_n->supName_ID}}</td>
                    <td>{{$data_n->GRNno}}</td>
                    <td>{{$data_n->VoucherPO}}</td>
                    <td>{{$data_n->receiptNo}}</td>
                    <td>{{$data_n->serialNo}}</td>
                    <td>{{$data_n->header}}</td>
                    <td>{{$data_n->item}}</td>
                    <td>{{$data_n->unitPrice}}</td>
                    <td>{{$data_n->remarks}}</td>
                    <td width="17%>
                    {{csrf_field()}}
                    <a href="/Stores/public/deletegrncon/{{$data_n->id}}" class="btn btn-danger">Delete</a>
                    <a href="/Stores/public/updategrncon/{{$data_n->id}}" class="btn btn-warning">Update</a>
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