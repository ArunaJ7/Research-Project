<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title','GIN Fixed Assets Item Details')
@section('content')

    <div class="container">
        <div class="row">
            <div class="container" id="faccontainer">

                <h1>Good Issue Note(GIN) - Fixed Asset Item Details</h1>
                <br/>

                <!--rejection note-->
                @if ($ginData->comment !== null)
                    <div class="alert alert-{{ $ginData->status === -1 ? 'danger' : 'warning' }}" role="alert">
                        <h5 class="font-weight-bold">
                            @php
                                switch ($ginData->status) {
                                    case 0:
                                        echo 'Pending Review';
                                        break;
                                    case -1:
                                        echo 'This fixed item was rejected';
                                        break;
                                    default:
                                        echo '';
                                        break;
                                }
                            @endphp
                        </h5>

                        <h6>Note :</h6>
                        <p id="commentTxt" class="text-break">{!! nl2br(e($ginData->comment)) !!}</p>

                        @if ($ginData->status <= -1)
                            @role('StoresDataEntry')
                            <a href="{{ url('/resolveFxGINItem/' . $ginData->fxGINNo . '/' . urlencode($ginData->fxGINSub)) }}"
                               class="btn btn-danger"
                               confirmation="Are you sure? Do you want to resolve this fixed assets GIN item ?"
                               type="button">Resolve</a>
                            @endrole
                        @endif
                    </div>
                @endif

                <!--Comment Modal -->

                <div class="modal fade" id="commentMdl" tabindex="-1" aria-labelledby="commentModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ url('/rejectFxGINItem') }}"
                                  method="post">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="commentModalLabel">Comment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="fxGINNo" value="{{ $ginData->fxGINNo }}">
                                    <input type="hidden" name="fxGINSub" value="{{ $ginData->fxGINSub }}">
                                    <textarea class="form-control" id="commentTxt" name="commentTxt" maxlength="200"
                                              rows="3">{{ $ginData->comment ?? '' }}</textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit"
                                            class="btn btn-danger">Reject
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <form action="{{ url('/editFxAstGin') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                            {{csrf_field()}}

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="GinNo">GIN No</label>
                                <div class="col-sm-10">
                                    <input value="{{ $ginData->fxGINNo }}" class="form-control" type="text" name="GinNo"
                                           id="GinNo" readonly>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="GinSub">GIN Sub *</label>
                                <div class="col-sm-10">
                                    <input value="{{ $ginData->fxGINSub }}" name="GinSubOld" id="GinSubOld" hidden="">
                                    <input value="{{ $ginData->fxGINSub }}" class="form-control" type="text"
                                           name="GinSub" id="GinSub"
                                           @if($ginData->status > 0) disabled @else @cannot('stores.fxGINItem.edit') disabled @endcannot @endif>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="GrnNo">GRN No *</label>
                                <div class="col-sm-10">
                                    <select class="form-control formselect required" name="GrnNo"
                                            @if($ginData->status > 0) disabled @else @cannot('stores.fxGINItem.edit') disabled @endcannot @endif>
                                        <option value="0" disabled selected>Select GRN</option>
                                        @foreach($availableGRNs as $grn)
                                            <option value="{{$grn->GRN_No}}"
                                                    @if($grn->GRN_No == $ginData->fxGRN) selected @endif>
                                                {{ ucfirst($grn->GRN_No.' - '.($grn->supplier!= null ? $grn->supplier->Supplier : '')) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if($ginData->status <= 0)
                                @can('stores.fxGINItem.edit')
                                    <table class="table table-dark">
                                        <tr>
                                            <th>Serial No</th>
                                            <th>Item</th>
                                            <th>Received Date</th>
                                            <th>Balance</th>
                                            <th>U. Price</th>
                                        </tr>

                                        <tbody rel="subItems">

                                        </tbody>
                                    </table>
                                @endcan
                            @endif
                            <div class="form-group form-row">
                                <label class="col-sm-2" for="supplier">GRN Sub *</label>
                                <div class="col-sm-10">
                                    <input value="{{ $ginData->fxGRNSub }}" class="form-control" type="text"
                                           name="GrnSub" placeholder="Enter GRN Sub" required="required" readonly>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="division">Division *</label>
                                <div class="col-sm-10">
                                    <input
                                        value="{{ $ginData->department->deptFA . ' - ' . $ginData->department->deptName }}"
                                        data-info="{{ $ginData->department->deptFA }}"
                                        class="form-control" type="text" id="division" name="division" readonly>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="issueDate">FA Code</label>
                                <div class="col-sm-10">
                                    <input value="{{ $ginData->fxCode }}" class="form-control" name="facode"
                                           id="facode" required="required"
                                           readonly>
                                    @if($ginData->fxCode == null)
                                        <button type="button" name="facodebtn" id="filter" class="btn btn-dark mt-2">
                                            View
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <label class="col-sm-2" for="issueDate">Issue Date *</label>
                                <div class="col-sm-10">
                                    <input value="{{ date('Y-m-d', strtotime($ginData->fxIDate)) }}"
                                           class="form-control" type="date" name="issueDate" id="issueDate" disabled>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="employee">Employee</label>
                                <div class="col-sm-10">
                                    <input
                                        value="{{ $ginData->employee->namewithinitials }}"
                                        class="form-control" type="text" name="emp" disabled>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="model">Model S/N</label>
                                <div class="col-sm-10">
                                    <input value="{{ $ginData->fxSerialNo }}" class="form-control" type="text"
                                           name="model"
                                           placeholder="Enter Model S/N" id="model"
                                           @if($ginData->status > 0) disabled @else @cannot('stores.fxGINItem.edit') disabled @endcannot @endif>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="remarks">Remarks</label>
                                <div class="col-sm-10">
                                    <input value="{{ $ginData->fxRmks }}" class="form-control" type="text"
                                           name="remarks"
                                           placeholder="Enter Remarks" id="remarks"
                                           @if($ginData->status > 0) disabled @else @cannot('stores.fxGINItem.edit') disabled @endcannot @endif>
                                </div>
                            </div>

                            <br/>

                            @if ($ginData->status <= 0)
                                @can('stores.fxGINItem.edit')
                                    <input type="submit" name="btn" class="btn btn-success" value="EDIT">
                                @endcan
                                @can('stores.fxGINItem.delete')
                                    <a confirmation="Are you sure? Do you want to delete this item?"
                                       type="button"
                                       href="{{ url('/deleteFxAstGINItem/' . $ginData->fxGINNo . '/' . urlencode($ginData->fxGINSub)) }}"
                                       class="btn btn-danger">Delete</a>
                                @endcan
{{--                                @can('stores.fxGIN.edit')--}}
{{--                                    <a type="button"--}}
{{--                                       href="{{ url('/editFxAstGIN/' . $ginData->fxGINNo) }}"--}}
{{--                                       class="btn btn-warning">Edit Issue Details</a>--}}
{{--                                @endcan--}}
                                @can('stores.fxGINItem.approve')
                                    <a href="{{ url('/approvefxGINItem/' . $ginData->fxGINNo . '/' . urlencode($ginData->fxGINSub)) }}"
                                       class="btn btn-success"
                                       confirmation="Are you sure? Do you want to approve this item ?"
                                       type="button">Approve</a>

                                    <button id="btnReject" type="button" class="btn btn-danger ml-3" data-toggle="modal"
                                            data-target="#commentMdl">
                                        Reject
                                    </button>
                                @endcan
                            @endif

                            <br><br>

                            <div class="form-group">
                                <label for="req">* Required Feilds</label>
                            </div>


                        </div>
                        <div class="col-md-4">
                            <label for="fx_image">Image of the fixed Asset</label>
                            <img id="display_image"
                                 src="{{ asset($ginData->fxPhoto != null ?'storage/fx_image/' . $ginData->fxPhoto : 'images/imageNotAvailable.png') }}"
                                 alt="" width="100%"
                                 class="mb-3">
                            <input type="file" name="fx_image" id="fx_image" class="form-control"
                                   @if($ginData->status > 0) hidden="" @else @cannot('stores.fxGINItem.edit') hidden="" @endcannot @endif>
                        </div>

                    </div>
                </form>
                @include('layouts.messagePopup')
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
        jQuery(document).ready(function () {
            jQuery('select[name="GrnNo"]').on('change', function () {
                let HeaderID = jQuery(this).val();
                if (HeaderID) {
                    jQuery.ajax({
                        url: '{{ url("/ajax/fxBinItems/") }}/' + HeaderID,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            let elSubs = jQuery('tbody[rel="subItems"]');
                            elSubs.empty();
                            jQuery.each(data, function (key, value) {
                                elSubs.append('<tr data-binSerial="' + value.binSerial + '"><td>' + value.binSerial + '</td><td>' + value.binItemCode + '</td><td>' + value.binDate + '</td><td>' + value.binBalance + '</td><td>' + value.binUnitPrice + '</td></tr>');
                            });
                            elSubs.find('tr').off('click').on('click', function () {
                                let elItem = $(this);
                                elItem.parent().find('tr').removeClass('highlight')
                                let itemCode = elItem.attr('data-binSerial');
                                elItem.addClass('highlight')
                                $("input[name='GrnSub']").val(itemCode);
                            });
                        }
                    });
                } else {
                    $('select[name="item"]').empty();
                }
            });
            $('button[name="facodebtn"]').off('click').on('click', function () {
                let division = $("#division").attr('data-info');
                let GrnNo = $('select[name="GrnNo"]').val();
                let GrnSub = $('input[name="GrnSub"]').val();
                if (division != "0" && GrnNo != "0" && GrnSub.trim() != "") {
                    jQuery.ajax({
                        url: '{{ url("/ajax/gin/facode/")}}/' + division + '/' + GrnNo + '/' + GrnSub.replaceAll('/', '_slash_'),
                        type: "GET",
                        dataType: "text",
                        success: function (data) {
                            $('input[name="facode"]').val(data);
                        }
                    });
                } else {
                    alert('Please fill the Division, GRN Number and GRN sub.')
                }
            });

        });
    </script>
    <script>
        $(function () {
            $(":file").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        /**@abstract Get executed when image is changed from the file controller
         * @param Event e - triggered event
         */
        function imageIsLoaded(e) {
            $('#display_image').attr('src', e.target.result);
        }
    </script>
@endsection
