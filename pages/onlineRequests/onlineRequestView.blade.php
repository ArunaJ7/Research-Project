<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Verification Confirmation - Consumables')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="GINcontainer">
            <br /><br /><br /><br /><br />
            <h1 class="text-center"> Online Order Requests</h1>
            <br /><br />
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-dark">
                        <thead>
                            <td>Request No</td>
                            <td>Department</td>
                            <td>Employee</td>
                            <td>Request Date</td>
                        </thead>
                        <tbody>
                            @foreach ( $requests as $request)
                            <tr>
                                <td>{{ $request->req_no}}</td>
                                <td>{{ $request->deptName}}</td>
                                <td>{{ $request->empTitle.' '.$request->empInitials.' '.$request->empSurname}}</td>
                                <td>{{ $request->req_date}}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="p-0 pr-3 pl-3">
                                    <p class="mb-0">
                                        <button class="btn btn-primary  p-1" type="button" data-toggle="collapse" data-target="#coll_{!! preg_replace('({|/|})', '', $request->req_no) !!}" aria-expanded="false" aria-controls="coll_{!! preg_replace('({|/|})', '', $request->req_no) !!}"> + click to view items</button>
                                    </p>
                                    <div class="collapse multi-collapse" id="coll_{!! preg_replace('({|/|})', '', $request->req_no) !!}" rel="collapseCont" data-req-id="{{$request->id}}" data-req-no="{{$request->req_no}}" data-target-rel="items_{!! preg_replace('({|/|})', '', $request->req_no) !!}" data-target-gin-rel="gin_{!! preg_replace('({|/|})', '', $request->req_no) !!}">
                                        <h5 class="text-left mt-3"> Served GINs</h5>
                                        <div class="border-bottom border-secondary p-3" rel="gin_{!! preg_replace('({|/|})', '', $request->req_no) !!}"></div>
                                        <form class="m-3" method="get" action="{{ url('/online/req/issue/'.$request->id)}}">
                                            <input name="gin" class="mr-3" /><button class="btn btn-info" type="submit">New GIN</button>
                                        </form>
                                        <h5 class="text-left"> Requested Items</h5>
                                        <table class="table table-light">
                                            <thead>
                                                <td>Item Header</td>
                                                <td>Item Description</td>
                                                <td>Requested Qty</td>
                                                <td>Available Qty</td>
                                                <td>Issued Qty</td>
                                                <td>Issue Date</td>
                                            </thead>
                                            <tbody rel="items_{!! preg_replace('({|/|})', '', $request->req_no) !!}">
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>

                </div>
                <br /><br /><br /><br />
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $('button[data-toggle="collapse"]').on('click', function() {
        let targetRel = $($(this).attr('data-target'));
        onTargetShown(targetRel);
    });
    //  $('[rel="collapseCont"]').on('show.bs.collapse', function() {
    function onTargetShown($targetRel) {
        let targetRel = $targetRel.attr('data-target-rel');
        let targetGINRel = $targetRel.attr('data-target-gin-rel');
        let regNo = $targetRel.attr('data-req-no');
        let reqId = $targetRel.attr('data-req-id');
        if ($('[rel="' + targetRel + '"] tr').length == 0) {
            $.ajax({
                url: '{{ url("/ajax/online_req/items") }}?id=' + encodeURI(regNo),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data != null && data.length > 0) {
                        let targetTable = $('[rel="' + targetRel + '"]');
                        $.each(data, function(key, value) {
                            let issuedQtyHtml = value.issue_qty || 0;
                            let issuedDateHtml = value.issue_date || '--';
                            targetTable.append('<tr><td>' + ((value.header_code && value.header_code.ch_ConHdr) || '') + '</td><td>' +
                                ((value.item_code && value.item_code.st_ConIDesc) || '') + '</td><td>' + value.req_quantity + '</td><td>' + (
                                    value.item_code.st_ConBalance || 0) + '</td><td>' + issuedQtyHtml + '</td><td>' + issuedDateHtml + '</td></tr>');
                        });

                    }
                }
            });

            $.ajax({
                url: '{{ url("/ajax/online_req/gin") }}?id=' + encodeURI(regNo),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data != null && data.length > 0) {
                        let targetDiv = $('[rel="' + targetGINRel + '"]');
                        let urlbase = "{{ url('/online/req/issue') }}";
                        $.each(data, function(key, value) {
                            let url = urlbase + '/' + reqId + '/' + value.cihMSerial;
                            targetDiv.append('<a href="' + url + '" class="btn btn-info" >' + value.cihMSerial + '</a> ');
                        });

                    }
                }
            });
        }
    }
    //  });


    /**@abstract Validate the form acording to the action
     * @param {Element}  confirmationForm form to submit
     * @return {Boolean} true/false for validation
     */
    function validateForm(confirmationForm) {
        let action = document.activeElement.value;
        if (confirmationForm["date"].value == "") {
            alert("Error! Date cannot be empty!");
            return false;
        }
        if (action == "confirm") {
            if (confirmationForm["hdrSelect"].value == "0" || confirmationForm["itemSelect"].value == "0") {
                alert("Error! Header and Item cannot be empty!");
                return false;
            }
        }
        return true;
    }
</script>
@endsection