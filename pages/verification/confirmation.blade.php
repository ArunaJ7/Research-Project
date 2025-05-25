<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Verification Confirmation - Consumables')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="GINcontainer">
            <br /><br /><br /><br /><br />
            <h1 style='text-align:center'> Confirm Verification & Lock Records</h1>
            <br /><br />
            <div class="row">
                <div class="col-md-12">
                    
                        <form method="post" action="{{ url('/verification/lock') }}" onsubmit="return validateForm(this)" name="confirmationForm">
                        {{csrf_field()}}
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="hdrSelect"> Header </label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" placeholder="Select Header" id="hdrSelect" name="hdrSelect" required>
                                    <option value="0" disabled selected>Select Header*</option>
                                    @foreach($conHeader as $conHeader)
                                    <option value="{{$conHeader->ch_ConHdr}}">
                                        {{ ucfirst($conHeader->ch_ConHdr.'-'.$conHeader->ch_ConDesc) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="itemSelect"> Item </label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" placeholder="Select Item" id="itemSelect" name="itemSelect" required>
                                    <option value="0" disabled selected>Select Item*</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="date"> Issue Date : </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="date" name="date" >
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="rmks"> Remarks </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="rmks" placeholder="Enter Remarks" id="rmks">
                            </div>
                        </div>
                        <div class="form-group">
                            @if(session()->has('errors'))
                            <label class="bg-danger p-3"> {{session()->get('errors') }} !</label>
                            @elseif(session()->has('success'))
                            <label class="bg-success p-3"> {{session()->get('success') }} ! </label>
                            @endif
                        </div>
                        <button type="submit" name="action" class="btn btn-info" value="confirm">Confirm</button>
                        <button type="submit" name="action" class="btn btn-warning" value="confirmAll"  confirmation="Are you sure? Do you want to change the verification date of all items?" >Confirm All</button>
                    </form>
                    <h5 style="text-align:center"> Current Verification Details</h5>
                    <table class="table table-dark">
                        <thead>
                            <td>Item Code</td>
                            <td>Description</td>
                            <td>Confiremed Date</td>
                            <td>Remarks</td>
                            <td>Actions</td>
                        </thead>
                        <tbody >
                            @foreach ( $chkdates as $chkdate)
                            <tr>
                                <td>{{ $chkdate->st_ConItem}}</td>
                                <td>{{ $chkdate->st_ConItemDesc}}</td>
                                <td>{{ $chkdate->st_ConChkDt}}</td>
                                <td>{{ $chkdate->remarks}}</td>
                                <td></td>
                            </tr>
                            
                            @endforeach                            
                            
                        </tbody>
                    </table>
                    {!! $chkdates->links() !!}
                    <br /><br /><br /><br />
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="hdrSelect"]').on('change', function() {
            var HeaderID = $(this).val();
            if (HeaderID) {
                $.ajax({
                    url: '{{ url("/ajax/conItem/") }}/' + HeaderID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        let $itemselect = $('select[name="itemSelect"]');
                        $itemselect.empty();
                        $.each(data, function(key, value) {
                            $itemselect.append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="itemSelect"]').empty();
            }
        });
       
    });

    /**@abstract Validate the form acording to the action
     * @param {Element}  confirmationForm form to submit
     * @return {Boolean} true/false for validation
     */
    function validateForm(confirmationForm) {
        let action = document.activeElement.value;
        if(confirmationForm["date"].value == "") {
                alert("Error! Date cannot be empty!");
                return false;
            }
        if (action == "confirm") {
            if(confirmationForm["hdrSelect"].value == "0" || confirmationForm["itemSelect"].value == "0") {
                alert("Error! Header and Item cannot be empty!");
                return false;
            }
        }
        return true;
        }
        </script>
@endsection