<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','GRN Fixed Assets')

@section('content')

<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">

            <h1>Good Received Note(GRN) - Fixed Asset Items</h1>

            <br />

            <div class="row">
                <div class="col-md-12">
                    <form action="/Stores/public/saveFxAstGrn" method="POST">
                        {{csrf_field()}}

                        <div class="form-group form-row">
                            <label class="col-sm-2" for="supplier">Supplier Name</label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" placeholder="Select Supplier" id="supplier" name="supplier">
                                    <option value="0" disabled selected>Select Supplier</option>
                                    @foreach($supplier as $supplier)
                                    <option value="{{$supplier->id}}">
                                        {{ ucfirst($supplier->Supplier) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-2" for="supplier">GRN No</label>
                            <div class="col-sm-6">
                                <input value="" class="form-control" type="text" name="GRNno" placeholder="Enter GRN No" required="required" id="GRNno">
                            </div>
                            <div class="col-sm-3">
                                <input type="submit" class="btn btn-light" value="VIEW" name="view">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-2" for="supplier">Date</label>
                            <div class="col-sm-9">
                                <input value="" class="form-control" type="date" name="date" placeholder="Enter Date" required="required" id="date">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-2" for="supplier">Voucher/PO</label>
                            <div class="col-sm-9">
                                <input value="" class="form-control" type="text" name="VoucherPO" placeholder="Enter VoucherPO" id="VoucherPO">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-2" for="supplier">Receipt No</label>
                            <div class="col-sm-9">
                                <input value="" class="form-control" type="text" name="receiptNo" placeholder="Enter Receipt No" id="receiptNo">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-2" for="supplier">Sub No</label>
                            <div class="col-sm-9">
                                <input value="" class="form-control" type="text" name="subNo" placeholder="Enter Sub No" id="subNo">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-2" for="header">Header *</label>
                            <div class="col-sm-9">
                                <select class="form-control" placeholder="Select Header" id="header" name="header" required="required">
                                    <option selected="false"> --Select Fixed Asset Header Desctiption-- </option>
                                    @foreach($header as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ $value }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="form-group form-row">
                            <label class="col-sm-2" for="item">Item Description</label>
                            <div class="col-sm-9">
                                <select class="form-control" placeholder="Select Fixed Asset Item" id="item" name="item" required="required">
                                    <option value="">--Select Fixed Asset Desctiption--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-2" for="supplier"> Quantity </label>
                            <div class="col-sm-9">
                                <input value="" class="form-control" type="text" name="qty" placeholder="Enter Qty" required="required" id="qty">
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
                                <input value="" class="form-control" type="text" name="remarks" placeholder="Enter Remarks" id="remarks">
                            </div>
                        </div>

                        <br />

                        <input type="submit" class="btn btn-primary" value="SAVE">
                        <input type="reset" class="btn btn-warning" value="CLEAR">

                        <br /><br />

                    </form>

                    <table class="table table-dark">
                        <th> Date</th>
                        <th> GRN No.</th>
                        <th> Supplier</th>
                        <th> Voucher/PO</th>
                        <th> Receipt No</th>
                        <th> Sub No</th>
                        <th> Item</th>
                        <th> Quantity</th>
                        <th> Unit Price</th>

                        @foreach($fxGrn as $fxGrn)
                        <tr>
                            <td> {{$fxGrn->binDate}} </td>
                            <td> {{$fxGrn->binMSerial}} </td>
                            <td> {{$fxGrn->Supplier}} </td>
                            <td> {{$fxGrn->binVch_PO}} </td>
                            <td> {{$fxGrn->binRct}} </td>
                            <td> {{$fxGrn->binSerial}} </td>
                            <td> {{$fxGrn->fh_Desc}} </td>
                            <td> {{$fxGrn->binQty}} </td>
                            <td> {{$fxGrn->binUnitPrice}} </td>
                            <td width="17%">
                                {{csrf_field()}}
                                <!-- <a href="/Stores/public/delete_fxgrn/{id}" class="btn btn-danger">Delete</a> -->
                                <a href="/Stores/public/update_fxgrn/{id}" class="btn btn-warning">Update</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <br><br>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #faccontainer {
        text-align: left;
    }

    h1 {
        text-align: center;
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('select[name="header"]').on('change', function() {
            var HeaderID = jQuery(this).val();
            if (HeaderID) {
                jQuery.ajax({
                    url: 'fxAssertGRN/view_fxAstItem_data/' + HeaderID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="item"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="item"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="item"]').empty();
            }
        });
    });
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
    $("#supplier").select2({
        placeholder: "Select Supplier Name",
        allowClear: true
    });
</script>

<script type="text/javascript">
    $("#item").select2({
        placeholder: "Select Consumable Item Name",
        allowClear: true
    });
</script>


@endsection