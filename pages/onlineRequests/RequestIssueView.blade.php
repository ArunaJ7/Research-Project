<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Request - Good Issue Note - Consumables')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="GINcontainer">
            <br /><br /><br /><br /><br />
            <h1 style='text-align:center'> Good Issue Item Details</h1>
            <br /><br />
            <div class="row">
                <div class="col-md-12">
                    <form >
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="dept-text"> Department Name : </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="dept-text" value="{{ isset($conIssHdr->dname)? $conIssHdr->dname : $conIssHdr->cihDept }}" readonly>
                                <input class="form-control" type="hidden" name="dept" value="{{ $conIssHdr->cihDept }}">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="emp-text"> Employee Name : </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="emp-text" value="{{ $req->employee !=null ? ($req->employee->empTitle.' '.$req->employee->empInitials.' '.$req->employee->empSurname) :'--' }}" readonly>

                                <input class="form-control" type="hidden" name="emp" value="{{ $conIssHdr->cihUPFNo }}">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="project-text"> Project Name : </label>
                            <div class="col-sm-9">
                            <input class="form-control" type="text" name="emp-text" value="{{ $req->project !=null ? $req->project->projDesc :'--' }}" readonly>

                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="issueNo"> Issue Number : </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="issueNo" value="{{$conIssHdr->cihMSerial}}" readonly>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="date"> Issue Date : </label>
                            <div class="col-sm-9">
                                <input readonly class="form-control" type="date" name="date" value="{{\Carbon\Carbon::parse($conIssHdr->cihDate)->toDateString()}}">
                            </div>
                        </div>

                        @if( $issuedItems->isNotEmpty() && $issuedItems->count()>0 )
                        <h5 style="text-align:center"> Issued Items (GRN Items) for Issue No:{{$conIssHdr->cihMSerial}}</h5>
                        <table class="table table-dark">
                            <thead>
                                <td>Bin Serial</td>
                                <td>Item</td>
                                <td>Issued Date</td>
                                <td>Requested Qty</td>
                                <td>Issued Qty</td>
                                <td>Actions</td>
                            </thead>
                            <tbody>
                                @foreach ( $issuedItems as $item)
                                <tr>
                                    <td>{{$item->binSerial}}</td>
                                    <td>{{$item->st_ConIDesc}}</td>
                                    <td>{{$item->binDate}}</td>
                                    <td>{{$item->binQty}}</td>
                                    <td>{{$item->binBalance}}</td>
                                    <td>
                                        <a confirmation="Are you sure? Do you want to delete this item?" type="button" href="{{ url('/GINItem/delete/'.$item->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif

                    </form>
                        <br />
                        <hr />
                        <br />
                        <h5 style="text-align:center"> Issue New Items for Issue No:{{$conIssHdr->cihMSerial}}</h5>
                        <form method="post" action="{{ url('/online/req/issue') }}">
                        {{csrf_field()}}
                            <input type="hidden" name="issueNo"  value="{{$conIssHdr->cihMSerial}}"/>
                            <input type="hidden" name="issueDate" value="{{$conIssHdr->cihDate}}" />
                        <table class="table table-dark">
                            <thead>
                                <td>Item</td>
                                <td>Requested Qty</td>
                                <td>Issued Qty</td>
                                <td>Store Available Qty</td>
                                <td>BinSerial</td>
                                <td>Issuing Qty</td>
                            </thead>
                            <tbody>
                                @foreach ( $req->requestItems as $item)
                                <tr>
                                    <td><input type="hidden" name="itemCode[]" value="{{$item->itemCode->st_ConItem}}"  /> {{$item->itemCode->st_ConItem.' - '.$item->itemCode->st_ConIDesc}}</td>
                                    <td>{{$item->req_quantity}}</td>
                                    <td>{{array_key_exists($item->itemCode->st_ConItem, $issuedItemsSum)? $issuedItemsSum[$item->itemCode->st_ConItem]["totalIssued"] : ''}}</td>
                                    <td>{{$item->itemCode->st_ConBalance}}</td>
                                    <td><input type="text" name="binSerial[]" value="{{($issuedItems->count() + 1 + $loop->index)}}"  /> </td>
                                    
                                    <td><input type="number" name="issueQty[]" max="{{array_key_exists($item->itemCode->st_ConItem, $issuedItemsSum)? min($item->itemCode->st_ConBalance, ($item->req_quantity - $issuedItemsSum[$item->itemCode->st_ConItem]['totalIssued'])) :  min($item->itemCode->st_ConBalance, $item->req_quantity ) }}"/></td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input type="submit" class="btn btn-info" value="Issue Items">
                        </form>
                        <div class="form-group">
                            @if(session()->has('errors'))
                            <label class="bg-danger p-3"> {{session()->get('errors') }} !</label>
                            @elseif(session()->has('success'))
                            <label class="bg-success p-3"> {{session()->get('success') }} ! </label>
                            @endif
                        </div>
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
        $('select[name="itemSelect"]').on('change', function() {
            var itemID = $(this).val();
            $('tbody[rel="binItems"]').empty();

            if (itemID) {
                $.ajax({
                    url: '{{ url("/ajax/binItems/") }}/' + itemID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        let $itemselect = $('tbody[rel="binItems"]');
                        let totalbalance = 0;
                        $itemselect.empty();
                        $.each(data, function(key, value) {
                            $itemselect.append('<tr><td>' + value.binSerial +
                                '</td><td>' + value.binDate +
                                '</td><td>' + value.binQty +
                                '</td><td>' + value.binBalance + '</td></tr>');
                            totalbalance += value.binBalance;
                        });
                        $("[name='balance']").val(totalbalance);
                    }
                });
            }
        });
    });
</script>
@endsection