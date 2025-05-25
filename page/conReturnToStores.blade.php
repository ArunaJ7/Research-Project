<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title', 'Return to Stores')

@section('content')

    <div class="container">
        <div class="row">
            <div class="container" id="faccontainer">

                <h1>Return to Stores - Consumable Items</h1>

                <div class="row">
                    <div class="col-md-12">

                        <form action="{{ url('/saveReturnToStores') }}" method="POST">
                            {{ csrf_field() }}
                            <br> </br>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="hdrSelect"> Header </label>
                                <div class="col-sm-9">
                                    <select class="form-control formselect required" placeholder="Select Header"
                                        id="hdrSelect" name="hdrSelect" required>
                                        <option value="0" disabled selected>Select Header*</option>
                                        @foreach ($conHeader as $conHeader)
                                            <option value="{{ $conHeader->ch_ConHdr }}">
                                                {{ ucfirst($conHeader->ch_ConDesc . ' - ' . $conHeader->ch_ConHdr) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="itemSelect"> Item </label>
                                <div class="col-sm-9">
                                    <select class="form-control formselect required" placeholder="Select Item"
                                        id="itemSelect" name="itemSelect" required>
                                        <option value="0" disabled selected>Select Item*</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="input-date">Date</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control date" type="date" name="date"
                                        placeholder="Enter Date" required="required" id="date">
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="input-date">GIN No</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control date" type="text" name="gin"
                                        placeholder="Select the record from received items table" id="gin" required readonly>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="input-date">Serial Number</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control date" type="text" name="serial"
                                        placeholder="Select the record from received items table" id="serial" required readonly>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="input-unitprice">Unit Price</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="text" name="unitprice"
                                        placeholder="Select the record from received items table" id="unitprice" required readonly>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="input-balance">Balance</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="text" name="balance"
                                        placeholder="Select the record from received items table" id="balance" required readonly>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="input-qty">Quantity Returned</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="number" name="qty"
                                        placeholder="Enter Returned Quantity" required="required" id="qty">
                                </div>
                            </div>

                            </br>

                            <input type="submit" class="btn btn-danger" value="RETURN">
                            <input type="reset" class="btn btn-warning" value="CLEAR">
                            </br> </br>
                        </form>

                        @include('layouts.messagePopup')

                        <div class = "table-responsive">
                            <h5 style="text-align:center"> Available Issued Consumable Items </h5>
                            <table class="table table-dark">
                                <thead>
                                    <td>GIN Number </td>
                                    <td>Serial Number </td>
                                    <td>Unit Price </td>
                                    <td>Available Qty </td>
                                </thead>
                                <tbody rel="binItems">

                                </tbody>
                            </table>

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
            $(document).ready(function() {



                // Event listener for dropdown change
                $('select[name="hdrSelect"]').on('change', function() {
                    var HeaderID = $(this).val();
                    clearInputFields();
                    if (HeaderID) {
                        $.ajax({
                            url: '{{ url('/ajax/conItem/') }}/' + HeaderID,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {

                                let $itemselect = $('select[name="itemSelect"]');
                                $itemselect.empty();
                                $itemselect.append(
                                    '<option value="0" disabled selected>Select Item</option>');
                                $.each(data, function(key, value) {
                                    $itemselect.append('<option value="' + key + '">' +
                                        value + ' - ' + key + '</option>');
                                });


                            }
                        });
                    } else {
                        $('select[name="itemSelect"]').empty();
                    }
                });

                //load table

                $('select[name="itemSelect"]').on('change', function() {
                    var itemID = $(this).val();
                    if (itemID) {
                        $.ajax({
                            url: '{{ url('/ajax/issuedbinItems/') }}/' +
                                itemID, // Adjust the URL
                            type: "GET",
                            dataType: "json",

                            success: function(data) {
                                // Load table with fetched data
                                loadTableWithData(data);
                                console.log(itemID);
                            }
                        });
                    }
                });

                // Function to load table with data
                function loadTableWithData(data) {
                    var tableBody = $('tbody[rel="binItems"]');
                    tableBody.empty();

                    // Populate table rows with fetched data
                    $.each(data, function(key, value) {

                        var row = '<tr>' +
                            '<td>' + value.binMSerial + '</td>' +
                            '<td>' + value.binSerial + '</td>' +
                            '<td>' + value.binUnitPrice + '</td>' +
                            '<td>' + value.binBalance + '</td>' +
                            '</tr>';

                        tableBody.append(row);
                    });
                    // Add click event to table rows
                    $('tbody[rel="binItems"] tr').on('click', function() {
                        var $tr = $(this);

                        $('input[name="gin"]').val($tr.find("td:eq(0)").text());
                        $('input[name="serial"]').val($tr.find("td:eq(1)").text());
                        $('input[name="unitprice"]').val($tr.find("td:eq(2)").text());
                        $('input[name="balance"]').val($tr.find("td:eq(3)").text());
                       

                    });
                }

            });

            function clearInputFields() {

                $('tbody[rel="binItems"]').empty();
                $("[name='gin']").val("");
                $("[name='serial']").val("");
                $("[name='balance']").val("");
                $("[name='unitprice']").val("");
                $("[name='qty']").val("");
                $("[name='itemSelect']").val("0");

            }
        </script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

        <script type="text/javascript">
            $("#itemSelect").select2({
                placeholder: "Select Consumable Item Name",
                allowClear: true
            });
        </script>

    @endsection
