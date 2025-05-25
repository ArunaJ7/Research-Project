<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','GRN Items')

@section('content')

<div class="container">
    <div class="row">

      <div class="container" id="faccontainer">

        <h1>Update Good Received Note(GRN) - Consumable Items</h1>
        <br>
        <div class="row">
            <div class="col-md-12">

                <form action="/Stores/public/updateConGRN" method="POST">
                {{csrf_field()}}

                    <input type="hidden" class="form-control" id="upid" placeholder="Edit  ID" name="upid" value="{{ $conGrnDetails->id }}">

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">Supplier Name</label>
                        <div class="col-sm-9">
                        <select class="form-control formselect required" placeholder="Select Name & ID" id="upsupName" name="upsupName">
                            <option value="0" disabled selected>Select name</option>
                            @foreach($supplierData as $supplierData)
                                <option  value="{{ucfirst($supplierData->id)}}"  selected>
                                    {{ ucfirst($supplierData->SupplierData) }}
                                </option>
                            @endforeach
                            @foreach($supplier as $supplier)
                                <option  value="{{$supplier->id}}">
                                    {{ ucfirst($supplier->Supplier) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">Date</label>
                        <div class="col-sm-9">
                            <input value="{{ $conGrnDetails->binDate }}" class="form-control" type="date" name="upDate" placeholder="Enter GRN No" required="required" id="upDate">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">GRN No</label>
                        <div class="col-sm-9">
                            <input value="{{ $conGrnDetails->binMSerial }}" class="form-control" type="text" name="upGRNno" placeholder="Enter GRN No" required="required" id="upGRNno">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">Voucher/PO</label>
                        <div class="col-sm-9">
                            <input value="{{ $conGrnDetails->binVch_PO }}" class="form-control" type="text" name="upVoucherPO" placeholder="Enter VoucherPO" id="upVoucherPO">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">Receipt No</label>
                        <div class="col-sm-9">
                            <input value="{{ $conGrnDetails->binRct }}" class="form-control" type="text" name="upreceiptNo" placeholder="Enter Receipt No" required="required" id="upreceiptNo">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">Serial No</label>
                        <div class="col-sm-9">
                            <input value="{{ $conGrnDetails->binSerial }}" class="form-control" type="text" name="upserialNo" placeholder="Enter Serial No" required="required" id="upserialNo">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">Header</label>
                        <div class="col-sm-9">
                            <select class="form-control formselect required" placeholder="Select header" id="upheader" name="upheader" readonly>
                                <option value="0" disabled selected>Select header</option>
                                @foreach($conHeader as $conHeader)
                                    <option  value="{{ucfirst($conHeader->ch_ConHdr)}}" {{ ($conHeader->ch_ConHdr==$ItemData->st_ConHdr) ? 'selected' : ''}}>
                                        {{ ucfirst($conHeader->ch_ConDesc) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">Item Name</label>
                        <div class="col-sm-9">
                            <select class="form-control formselect required" placeholder="Enter Item" id="upitem" name="upitem">
                                <option value="0" disabled selected>Select Item</option>

                                    <option  value="{{ucfirst($ItemData->st_ConItem)}}"  selected>
                                        {{ ucfirst($ItemData->full_desc) }}
                                    </option>

                                @foreach($itemName as $itemName)
                                    <option  value="{{$itemName->st_ConItem}}">
                                        {{ ucfirst($itemName->full_desc) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">Quantity</label>
                        <div class="col-sm-9">
                            <input value="{{ $conGrnDetails->binQty }}" class="form-control" type="text" name="upQty" placeholder="Enter Quantity" required="required" id="upQty">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">Unit Price</label>
                        <div class="col-sm-9">
                            <input value="{{ $conGrnDetails->binUnitPrice }}" class="form-control" type="text" name="upunitPrice" placeholder="Enter Unit Price" required="required" id="upunitPrice">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">Remarks</label>
                        <div class="col-sm-9">
                            <input value="{{ $conGrnDetails->binRmks }}" class="form-control" type="text" name="upremarks" placeholder="Enter Remarks" required="required" id="upremarks">
                        </div>
                    </div>

                    <br>
                    <input type="submit" class="btn btn-primary" value="UPDATE">
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
    }

    h1{
        text-align: center;
    }
</style>

@endsection
