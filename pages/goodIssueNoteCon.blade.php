<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title', 'Good Issue Note - Consumables')

@section('content')
    <div class="container">
        <div class="row">
            <div class="container" id="GINcontainer">
                <br /><br /><br /><br /><br />
                <h1 style='text-align:center'> Good Issue Item Details</h1>
                <br /><br />
                <!--rejection note-->
                @if ($conIssHdr->comment !== null)
                    <div class="alert alert-{{ $conIssHdr->status === -1 ? 'danger' : 'warning' }}" role="alert">
                        <h5 class="font-weight-bold">
                            @php
                                switch ($conIssHdr->status) {
                                    case 0:
                                        echo 'Pending Review';
                                        break;
                                    case -1:
                                        echo 'This GIN was rejected';
                                        break;
                                    case -2:
                                        echo 'This GIN was opened to edit again';
                                        break;
                                    default:
                                        echo '';
                                        break;
                                }
                            @endphp
                        </h5>

                        <h6>Note :</h6>
                        <p class="text-break">{!! nl2br(e($conIssHdr->comment)) !!}</p>

                        @if ($conIssHdr->status <= -1)
                            @role('StoresDataEntry')
                                <a href="{{ url('/resolveGIN/' . $conIssHdr->cihMSerial) }}" class="btn btn-danger"
                                    confirmation="Are you sure? Do you want to resolve this GIN ?" type="button">Resolve</a>
                            @endrole
                        @endif
                    </div>
                @endif

                <!--Comment Modal -->

                <div class="modal fade" id="commentMdl" tabindex="-1" aria-labelledby="commentModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ $conIssHdr->status === 1 ? url('/openToEditGIN') : url('/rejectGIN') }}"
                                method="post">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="commentModalLabel">Comment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="ginID" value="{{ $conIssHdr->cihMSerial }}">
                                    <textarea class="form-control" id="commentTxt" name="commentTxt" maxlength="200" rows="3">{{ $conIssHdr->comment ?? '' }}</textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit"
                                        class="btn btn-danger">{{ $conIssHdr->status === 1 ? 'Open To Edit' : 'Reject' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">



                        <form method="post" action="{{ url('/editGINHdr') }}">
                            {{ csrf_field() }}

                            <div class="form-group form-row">
                                <label class="col-sm-3" for="dept-text"> Department Name : </label>
                                <div class="col-sm-9">

                                    <select class="form-control" name="dept-select" id="dept-select" >
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->deptCode }}"
                                                {{ (isset($conIssHdr->cihDept) && $conIssHdr->cihDept == $dept->deptCode) ? 'selected' : '' }}>
                                                {{ $dept->deptName }}
                                            </option>
                                        @endforeach
                                    </select>

                                <!-- Hidden field to store the selected department value -->
                                <input class="form-control" type="hidden" name="dept" value="{{ $conIssHdr->cihDept }}">
                            </div>
                            </div>
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="emp-text"> Employee Name : </label>
                                <div class="col-sm-9">

                                    <select class="form-control" name="emp-select" id="emp-select" >
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->empepf }}" {{ (isset($conIssHdr->cihUPFNo) && $conIssHdr->cihUPFNo == $employee->empepf) ? 'selected' : '' }}>
                                                {{ $employee->empTitle . ' ' . $employee->empInitials . ' ' . $employee->empSurname }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <input class="form-control" type="hidden" name="emp" value="{{ $conIssHdr->cihUPFNo }}">
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="project-text"> Project Name : </label>
                                <div class="col-sm-9">
                                    <select class="form-control formselect required" placeholder="Select Project"
                                        id="projSelect" name="project"
                                        @if ($conIssHdr->status > 0) disabled
                                            @else @cannot('stores.gin.edit') disabled @endcannot @endif>
                                        <option value="0" disabled>Select Project*</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->projCode }}"
                                                {{ $conIssHdr->projCode == $project->projCode ? 'selected' : '' }}>
                                                {{ ucfirst($project->projname) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="issueNo"> Issue Number : </label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="number" name="issueNo"
                                        value="{{ $conIssHdr->cihMSerial }}" readonly>
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="date"> Issue Date : </label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="date" name="date"
                                        value="{{ \Carbon\Carbon::parse($conIssHdr->cihDate)->toDateString() }}"
                                        @if ($conIssHdr->status > 0) disabled
                                           @else @cannot('stores.gin.edit') disabled @endcannot @endif>
                                </div>
                            </div>



                            <!--check gin status ( -1 = rejected, 0 = not approved (default), 1 = approved )-->
                            @if ($conIssHdr->status <= 0)
                                @can('stores.gin.edit')
                                    <input type="submit" name="editNote" class="btn btn-warning" value="Edit">
                                @endcan
                                @can('stores.gin.approve')
                                    <a href="{{ url('/approveGIN/' . $conIssHdr->cihMSerial) }}" class="btn btn-success"
                                        confirmation="Are you sure? Do you want to approve this GIN ?"
                                        type="button">Approve</a>

                                    <button id="btnReject" type="button" class="btn btn-danger ml-2" data-toggle="modal"
                                        data-target="#commentMdl">
                                        Reject
                                    </button>
                                    <a href="{{ url('/deleteGinHeader/' . $conIssHdr->cihMSerial) }}"
                                        confirmation="Are you sure? Do you want to Delete this GIN"
                                        class="btn btn-danger ml-2">Delete</a>
                                @endcan
                            @else
                                @can('stores.gin.openToEdit')
                                    <button id="btnOpenToEdit" type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#commentMdl">
                                        Open To Edit
                                    </button>
                                @endcan
                            @endif
                        </form>

                        @if ($issuedItems->isNotEmpty() && $issuedItems->count() > 0)
                            <h5 style="text-align:center"> Issued Items (GRN Items) for Issue
                                No:{{ $conIssHdr->cihMSerial }}</h5>
                            <table class="table table-dark">
                                <thead>
                                    <td>Bin Serial</td>
                                    <td>Item</td>
                                    <td>Issued Date</td>
                                    <td class="text-right">Issued Qty</td>
                                    <td class="text-right">Unit Price</td>
                                    <td class="text-right">Value</td>
                                    <!--check gin status ( -1 = rejected, 0 = not approved (default), 1 = approved )-->
                                    @if ($conIssHdr->status <= 0)
                                        @can('stores.gin.deleteItem')
                                            <td>Actions</td>
                                        @endcan
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach ($issuedItems as $item)
                                        <tr>
                                            <td>{{ $item->binSerial }}</td>
                                            <td>{{ $item->st_ConIDesc }}</td>
                                            <td>{{ $item->binDate }}</td>
                                            <td class="text-right">{{ $item->binQty }}</td>
                                            <td class="text-right">
                                                {{ number_format($item->binUnitPrice, 2, '.', ',') }}
                                            </td>
                                            <td class="text-right">
                                                {{ number_format($item->binQty * $item->binUnitPrice, 2, '.', ',') }}
                                            </td>
                                            @if ($conIssHdr->status <= 0)
                                                @can('stores.gin.deleteItem')
                                                    <td>
                                                        <a confirmation="Are you sure? Do you want to delete this item?"
                                                            type="button" href="{{ url('/GINItem/delete/' . $item->id) }}"
                                                            class="btn btn-danger">Delete</a>
                                                    </td>
                                                @endcan
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        @if ($conIssHdr->status <= 0)
                            @can('stores.gin.addItem')
                                <br />
                                <hr />
                                <br />
                                <h5 style="text-align:center"> Issue New Item for Issue
                                    No:{{ $conIssHdr->cihMSerial }}</h5>
                                <form method="post" action="{{ url('/saveGINData') }}">
                                    {{ csrf_field() }}
                                    <input class="form-control" type="hidden" name="issueNo"
                                        value="{{ $conIssHdr->cihMSerial }}" readonly>
                                    <input class="form-control" type="hidden" name="date"
                                        value="{{ $conIssHdr->cihDate }}">
                                    <div class="form-group form-row">
                                        <label class="col-sm-3" for="serial"> Serial No. </label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="serial"
                                                placeholder="Enter Serial Number" id="serial" required>
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
                                        <label class="col-sm-3" for="balance"> Current Balance </label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="balance" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <label class="col-sm-3" for="qty"> Quantity </label>
                                        <div class="col-sm-9">

                                            <input class="form-control" type="number" step="any" name="qty"
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
                                    <input type="submit" class="btn btn-info" value="Issue Item">
                                </form>
                                <h5 style="text-align:center"> Available Items In Store (GRN Items)</h5>
                                <table class="table table-dark">
                                    <thead>
                                        <td>Bin Serial</td>
                                        <td>Received Date</td>
                                        <td>Type</td>
                                        <td>Available Qty</td>
                                    </thead>
                                    <tbody rel="binItems">

                                    </tbody>
                                </table>
                            @endcan
                        @endif
                        @include('layouts.messagePopup')
                        <br /><br /><br /><br />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="hdrSelect"]').on('change', function() {
                clearInputFields();
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
                                '<option value="0" disabled selected>Select Item*</option>');
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

            $('select[name="itemSelect"]').on('change', function() {

                var itemID = $(this).val();

                if (itemID) {
                    $.ajax({
                        url: '{{ url('/ajax/binItems/') }}/' + itemID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            let $itemselect = $('tbody[rel="binItems"]');
                            let totalbalance = 0;
                            $itemselect.empty();

                            $.each(data, function(key, value) {
                                $itemselect.append('<tr><td>' + value.binSerial +
                                    '</td><td>' + value.binDate +
                                    '</td><td>' + value.binType +
                                    '</td><td>' + value.binBalance + '</td></tr>');
                                totalbalance += value.binBalance;
                            });
                            $("[name='balance']").val(totalbalance);

                        }
                    });
                }
            });

            function clearInputFields() {
                $('tbody[rel="binItems"]').empty();
                $("[name='level']").val("");
                $("[name='balance']").val("");
                $("[name='qty']").val("");
                $("[name='rmks']").val("");
            }

        });
    </script>
@endsection
