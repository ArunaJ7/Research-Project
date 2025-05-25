<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title', 'Verification ')

@section('content')
    <div class="container">
        <div class="row">
            <div class="container" id="faccontainer">

                <h1>Verification </h1>
                <div class="row">
                    <div class="col-md-12">

                        <form action="{{url('/verify')}}" method="POST">
                            {{ csrf_field() }}

                            <br />

                            <!-- Header -->
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="header">Header Discription</label>
                                <div class="col-sm-9">
                                    <select class="form-control" placeholder="Select Header" id="ph_header" name="ph_header"
                                        required="required">
                                        <option value="">--Select Consumable Header Desctiption--</option>
                                        <option value="*">All Items</option>
                                        @foreach ($data_conhd as $key => $value)
                                            <option value="{{ $key }}">
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Item -->
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="item">Item Description</label>
                                <div class="col-sm-9">
                                    <select class="form-control" placeholder="Select Item" id="ph_item" name="ph_item">
                                        <option value="all" selected>--Select Consumable Item Desctiption--</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Date --}}
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="date">Date</label>
                                <div class="col-sm-9">
                                    <input value="" type="date" class="form-control date" id="date" name="date" required >
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-3" for="item">Remarks</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="remarksremarks" name="remarks" >
                                </div>
                            </div>
                            </br>
                            <input type="submit" id="btnsubmit" class="btn btn-primary" value="SAVE" confirmation="">
                            <input type="reset" class="btn btn-warning" value="CLEAR">
                            </br></br>

                        </form>
                        @include('layouts.messagePopup')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="vTable"  class="table table-dark">
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Name</th>
                                <th>Last Verification Date</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        </table>
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

        h1 {
            text-align: center;
        }
    </style>



    <script type="text/javascript">

        jQuery(document).ready(function() {
            document.getElementById("btnsubmit").removeAttribute('confirmation');
            jQuery('select[name="ph_header"]').on('change', function() {
                var HeaderID = jQuery(this).val();
                if (HeaderID) {
                    if(HeaderID == '*'){
                        let $itemselect = $('select[name="ph_item"]');
                        $itemselect.empty();
                        $itemselect.append(
                            '<option value="all_items" selected>All Items</option>');
                        document.getElementById("btnsubmit").setAttribute("confirmation",
                        "Are you sure to select all items?");
                    }else{
                    jQuery.ajax({
                        url: "{{url('/verification/viewConItemData/')}}" + HeaderID,
                        type: "GET",
                        dataType: "json",

                        success: function(data) {
                            let $itemselect = $('select[name="ph_item"]');
                            $itemselect.empty();
                            $itemselect.append(
                                '<option value="all" selected>Select Item*</option>'
                                );
                                $.each(data, function(key, value) {
                                $('select[name="ph_item"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                            document.getElementById("btnsubmit").removeAttribute('confirmation');
                        }
                    });
                  }
                } else {
                    $('select[name="ph_item"]').empty();
                }
            });

            
            $('#vTable').DataTable( {
                ajax: { url:'{{url("/verification/data")}}',
                dataSrc: ''},
                columns: [ {data:'st_ConItem'}, {data:'conitem.st_ConIDesc'}, {data:'st_ConChkDt'}, {data:'remarks'} ] 
            } );
        });
    </script>






@endsection
