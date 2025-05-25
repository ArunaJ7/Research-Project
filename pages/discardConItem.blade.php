<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title', 'Discard Consumable Items')

@section('content')
    <div class="container">
        <div class="row">
            <div class="container" id="faccontainer">

                <h1>Discard Consumable Items</h1>

                <div class="row">
                    <div class="col-md-12">

                        <form action="\save_discard_items" method="POST">
                            {{ csrf_field() }}
                            <br> </br>

                            <!-- Header-->
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="input-code">Header</label>
                                <div class="col-sm-9">
                                    <select class="form-control formselect required" placeholder="Select header"
                                        id="header" name="header">
                                        <option value="0" disabled selected>Select header</option>
                                        @foreach ($conHeader as $sto_header)
                                            <option value="{{ $sto_header->ch_ConHdr }}">
                                                {{ ucfirst($sto_header->ch_ConDesc . ' - ' . $sto_header->ch_ConHdr) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Items-->
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="input-item">Item</label>
                                <div class="col-sm-9">
                                    <select class="form-control formselect required" placeholder="Select Item"
                                        id="item" name="item">
                                        <option value="0" disabled selected>Select Item</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-3" for="input-date">GRN No</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control date" type="text" name="grn"
                                        placeholder="Enter GRN No" required="required" id="grn" readonly>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-3" for="input-date">Date</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control date" type="date" name="date"
                                        placeholder="Enter Item number" required="required" id="date">
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-3" for="input-unitprice">Unit Price</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="text" name="unitprice"
                                        placeholder="Enter Unit Price" required="required" id="unitprice" readonly>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-3" for="input-balance">Balance</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="text" name="balance"
                                        placeholder="Enter Balance" required="required" id="balance" readonly>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-3" for="input-qty">Discard Quantity</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="text" name="qty"
                                        placeholder="Enter Discard Quantity" required="required" id="qty">
                                </div>
                            </div>
                            <input value="" class="form-control" type="hidden" name="type" required="required"
                                id="type">
                            </br>
                            <input type="submit" class="btn btn-danger" value="DISCARD">
                            <input type="reset" class="btn btn-warning" value="CLEAR">
                            </br> </br>
                        </form>

                        <div class="table-responsive">
                            <table id="customTable" class="table table-dark">
                                <thead>
                                    <th> Header </th>
                                    <th> Item </th>
                                    <th> GRN No / GIN No</th>
                                    <th> Balance</th>
                                    <th> Unit Price</th>
                                    <th> Type</th>
                                </thead>
                                <tbody rel="discardConItem"></tbody>
                            </table>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div>
        @include("layouts.messagePopup")
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
        $(document).ready(function() {
            // handles the header selection
            $('select[name="header"]').on('change', function() {
                var HeaderID = $(this).val();
                clearInputs(); // clearing the inputs
                $('tbody[rel="discardConItem"]').empty(); // clearing the table
                if (HeaderID) {
                    $.ajax({
                        url: '{{ url('/ajax/conItem/') }}/' + HeaderID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            let $itemselect = $('select[name="item"]');
                            $itemselect.empty();
                            $itemselect.append(
                                '<option value="0" disabled selected>Select Item*</option>');
                            $.each(data, function(key, value) {
                                $itemselect.append('<option value="' + key + '">' +
                                    value + ' - ' + key + '</option>');
                            });

                        }
                    });
                } else {
                    $('select[name="item"]').empty();
                }
            });
            // handles the item selection
            $('select[name="item"]').on('change', function() {
                var itemID = $(this).val();
                $('tbody[rel="discardConItem"]').empty();
                clearInputs();
                if (itemID) {
                    $.ajax({
                        url: '{{ url('/ajax/binItems/') }}/' + itemID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            let $itemselect = $('tbody[rel="discardConItem"]');
                            $itemselect.empty();

                            $.each(data, function(key, value) {
                                // appending the items table
                                $itemselect.append('<tr><td rel="st_ConHdr">' + value
                                    .st_ConHdr +
                                    '</td><td rel="binSerial">' + value
                                    .binItemCode +
                                    '</td><td rel="binMSerial">' + value
                                    .binMSerial +
                                    '</td><td rel="binBalance">' + value
                                    .binBalance +
                                    '</td><td rel="binUnitPrice">' + value
                                    .binUnitPrice +
                                    '</td><td rel="binType">' + value.binType +
                                    '</td></tr>');
                            });
                            // binding row click of table
                            $itemselect.find("tr").on('click', function() {
                                let $tr = $(this);
                                $('input[name="grn"]').val($tr.find("[rel=binMSerial]")[
                                    0].innerHTML);
                                $('input[name="unitprice"]').val($tr.find(
                                    "[rel=binUnitPrice]")[0].innerHTML);
                                $('input[name="balance"]').val($tr.find(
                                    "[rel=binBalance]")[0].innerHTML);
                                $('input[name="type"]').val($tr.find(
                                    "[rel=binType]")[0].innerHTML);
                            });

                        }
                    });
                }
            });
        });

        /**@abstract clear the input boxes related to returning item
         * 
         */
        function clearInputs() {
            $('input[name="grn"]').val('');
            $('input[name="unitprice"]').val('');
            $('input[name="balance"]').val('');
        }

        /**@abstract validating form befor submitting */
        function validateForm() {
            let currentBalance = $('input[name="balance"]').val();
            let returnQty = $('input[name="qty"]').val();
            if (+currentBalance < +returnQty) {
                alert("Returning quantity should not be greater than the respective received item's balance!");
                return false;
            }
        }
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">
        $("#itemSelect").select2({
            placeholder: "--Select Consumable Item Name--",
            allowClear: true
        });
    </script>
@endsection
