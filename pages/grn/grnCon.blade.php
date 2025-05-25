<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title', 'Good Received Note - Consumables')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            <br /><br /><br /><br /><br />
            <h1 style='text-align:center'> Good Received Note Details</h1>
            <br /><br />


            {{-- Grin edit --}}

            <!--rejection note-->
            @if ($grn->comment !== null)
            <div class="alert alert-{{ $grn->status === -1 ? 'danger' : 'warning' }}" role="alert">
                <h5 class="font-weight-bold">
                    @php
                    switch ($grn->status) {
                    case 0:
                    echo 'Pending Review';
                    break;
                    case -1:
                    echo 'This GRN was rejected';
                    break;
                    case -2:
                    echo 'This GRN was opened to edit again';
                    break;
                    default:
                    echo '';
                    break;
                    }
                    @endphp
                </h5>


                <h6>Note :</h6>
                <p id="commentTxt" class="text-break">{!! nl2br(e($grn->comment)) !!}</p>

                @if ($grn->status <= -1)
                    @role('StoresDataEntry')
                    <a href="{{ url('/resolveGRN/' . $grn->GRN_No) }}" class="btn btn-danger"
                    confirmation="Are you sure? Do you want to resolve this GRN ?" type="button">Resolve</a>
                    @endrole
                    @endif
            </div>
            @endif

            <!--Comment Modal -->

            <div class="modal fade" id="commentMdl" tabindex="-1" aria-labelledby="commentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ $grn->status === 1 ? url('/openToEditGRN') : url('/rejectGRN') }}"
                            method="post">
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="commentModalLabel">Comment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="grnID" value="{{ $grn->GRN_No }}">
                                <textarea class="form-control" id="commentTxt" name="commentTxt" maxlength="200" rows="3">{{ $grn->comment ?? '' }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit"
                                    class="btn btn-danger">{{ $grn->status === 1 ? 'Open To Edit' : 'Reject' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ url('/editConGRNHdr') }}">
                        {{ csrf_field() }}

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="grnNo"> GRN Number : </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="grnNo" value="{{ $grn->GRN_No }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="date"> GRN Date : </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="date" name="date"
                                    value="{{ \Carbon\Carbon::parse($grn->date)->toDateString() }}">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="supplier">Supplier Name *</label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" placeholder="Select Supplier"
                                    id="supplier" name="supplier">
                                    <option value="0" disabled selected>Select Supplier</option>
                                    @foreach ($supplier as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ $grn->SupplierId == $supplier->id ? 'selected' : '' }}>
                                        {{ ucfirst($supplier->Supplier) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <!--check grn status ( -1 = rejected, 0 = not approved (default), 1 = approved )-->

                            @if ($grn->status <= 0)
                                @if ($grn->status > -100 )
                                    @can('stores.grn.edit')
                                    <input type="submit" name="editNote" class="btn btn-warning " value="Edit">
                                    @endcan <!-- Add delete button -->

                                    @can('stores.grn.approve')
                                    <a href="{{ url('/approveGRN/' . $grn->GRN_No) }}" class="btn btn-success m-2"
                                        confirmation="Are you sure? Do you want to approve this GRN ?"
                                        type="button">Approve</a>

                                    <button id="btnReject" type="button" class="btn btn-danger m-2" data-toggle="modal"
                                        data-target="#commentMdl">
                                        Reject
                                    </button>
                                    @endcan
                                    @can('stores.grn.delete')
                                    <a href="{{ url('/deleteGRN/' . $grn->GRN_No) }}" class="btn btn-danger m-2"
                                        confirmation="Are you sure? Do you want to delete this GRN ?"
                                        type="button">Delete</a>
                                    @endcan
                                @endif
                                @else
                                @can('stores.grn.openToEdit')
                                <button id="btnOpenToEdit" type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#commentMdl">
                                    Open To Edit
                                </button>
                                @endcan

                                @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    @if ($receiveddItems->isNotEmpty() && $receiveddItems->count() > 0)
                    @php
                    $totalPrice = 0;
                    @endphp
                    <h5 style="text-align:center"> Added Items (GRN Items) for GRN No:{{ $grn->GRN_No }}</h5>
                    <table class="table table-dark">
                        <thead>
                            <td>Bin Serial</td>
                            <td>Voucher No</td>
                            <td>Receipt No</td>
                            <td>Item</td>
                            <td>Unit Price</td>
                            <td>Qty</td>
                            <td>Actions</td>
                        </thead>
                        <tbody>
                            @foreach ($receiveddItems as $item)
                            @php $totalPrice += ($item->binUnitPrice * $item->binQty) @endphp
                            <tr>
                                <td>{{ $item->binSerial }}</td>
                                <td>{{ $item->binVch_PO }}</td>
                                <td>{{ $item->binRct }}</td>
                                <td>{{ $item->st_ConIDesc }}</td>
                                <td>{{number_format(($item->binUnitPrice),2,'.',',')}}</td>
                                <td>{{$item->binQty}}</td>

                                <!--check grn status ( -1 = rejected, 0 = not approved (default), 1 = approved )-->
                                @if ($grn->status <= 0)
                                    @can('stores.grn.deleteItem')
                                    <td>
                                    <a confirmation="Are you sure? Do you want to delete this item?"
                                        type="button"
                                        href="{{ url('/GRNItem/delete/' . $item->id) }}"
                                        class="btn btn-danger">Delete</a>
                                    </td>
                                    @endcan
                                    @endif

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <tr>
                        <h5 class="text-success text-center"> Total Price: {{number_format(($totalPrice),2,'.',',')}}</h5>
                    </tr>

                    @endif

                    <!--check grn status ( -1 = rejected, 0 = not approved (default), 1 = approved )-->
                    @if ($grn->status <= 0)
                        @can('stores.grn.addItem')
                        <br />
                    <hr />
                    <br />
                    <h5 style="text-align:center"> Add New Item for GRN No:{{ $grn->GRN_No }}</h5>
                    <form method="post" action="{{ url('/GRNItem/add') }}">
                        {{ csrf_field() }}
                        <input class="form-control" type="hidden" name="grnNo" value="{{ $grn->GRN_No }}"
                            readonly>
                        <input class="form-control" type="hidden" name="date" value="{{ $grn->date }}">
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="voucher"> Voucher/Po</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="voucher"
                                    placeholder="Enter Voucher Number"
                                    value="{{ $receiveddItems->isNotEmpty() && $receiveddItems->count() > 0 ? $receiveddItems[0]->binVch_PO : '' }}">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="rctNo"> Receipt No. </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="rctNo"
                                    placeholder="Enter Receipt Number" required
                                    value="{{ $receiveddItems->isNotEmpty() && $receiveddItems->count() > 0 ? $receiveddItems[0]->binRct : '' }}">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="serial"> Serial No. </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="serial"
                                    placeholder="Enter Serial Number" required>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="hdrSelect"> Header </label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" placeholder="Select Header"
                                    id="hdrSelect" name="hdrSelect" required>
                                    <option value="0" disabled selected>Select Header*</option>
                                    @foreach ($conHeader as $conHeader)
                                    <option value="{{ $conHeader->ch_ConHdr }}">
                                        {{ ucfirst($conHeader->ch_ConDesc . '-' . $conHeader->ch_ConHdr) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="itemSelect"> Item </label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" placeholder="Select Item"
                                    id="itemSelect" name="itemSelect" required>
                                    <option value="0" disabled selected>Select Item*</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="uprice"> Unit Price </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="unit_price"
                                    placeholder="Enter Unit Price" required>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="qty"> Quantity </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" step="any" name="quantity"
                                    placeholder="Enter Quantity" id="qty" required>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="rmks"> Remarks </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="rmks"
                                    placeholder="Enter Remarks" id="rmks">
                            </div>
                        </div>


                        <input type="submit" class="btn btn-info" value="Add">
                    </form>
                    @endcan
                    @endif
                    @include('layouts.messagePopup')
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
                        url: '{{ url('/ajax/conItem/') }}/' + HeaderID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            let $itemselect = $('select[name="itemSelect"]');
                            $itemselect.empty();
                            $itemselect.append(
                                '<option value="0" disabled selected>Select Item</option>');
                            clearInputFields();
                            $.each(data, function(key, value) {
                                $itemselect.append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                        }
                    });

                } else {
                    $('select[name="itemSelect"]').empty();
                        }
            });
            function clearInputFields() {
                $('[name="unit_price"]').val("");
                $('[name="quantity"]').val("");
                $('[name="rmks"]').val("");
            }

        });

    </script>

@endsection
