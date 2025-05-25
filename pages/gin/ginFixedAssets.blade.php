<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title','GIN Fixed Assets')
@section('content')

    <div class="container">
        <div class="row">
            <div class="container" id="faccontainer">

                <h1>Good Issue Note(GIN) - Fixed Asset Items</h1>
                <br/>

                <div class="row">
                    <div class="col-md-12">
                        <form id="fxGINForm" action="{{ url('/saveFxAstGin') }}" method="POST"
                              enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="GinNo">GIN No *</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="text" name="GinNo"
                                           placeholder="Enter GIN No" required="required" id="GinNo">
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="GinSub">GIN Sub *</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="text" name="GinSub"
                                           placeholder="Enter GIN Sub" required="required" id="GinSub">
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="GrnNo">GRN No *</label>
                                <div class="col-sm-9">
                                    <select class="form-control formselect required" placeholder="Select Division"
                                            name="GrnNo">
                                        <option value="0" disabled selected>Select GRN</option>
                                        @foreach($availableGRNs as $grn)
                                            <option value="{{$grn->GRN_No}}">
                                                {{ ucfirst($grn->GRN_No.' - '.($grn->supplier!= null ? $grn->supplier->Supplier : '')) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                            <div class="form-group form-row">
                                <label class="col-sm-2" for="supplier">GRN Sub *</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="text" name="GrnSub"
                                           placeholder="Enter GRN Sub" required="required" readonly>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="division">Division *</label>
                                <div class="col-sm-9">
                                    <select class="form-control formselect required" placeholder="Select Division"
                                            id="division" name="division">
                                        <option value="0" disabled selected>Select Division</option>
                                        @foreach($division as $division)
                                            <option value="{{$division->deptFA}}">
                                                {{ ucfirst($division->deptName.' - '.$division->deptFA) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="issueDate">FA Code</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" name="facode" id="facode" required="required"
                                           readonly>
                                    <button type="button" name="facodebtn" id="filter" class="btn btn-light mt-1">View
                                    </button>
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <label class="col-sm-2" for="issueDate">Issue Date *</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="date" name="issueDate"
                                           placeholder="Enter Date" required="required" id="issueDate">
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="employee">Employee</label>
                                <div class="col-sm-9">
                                    <select class="form-control formselect required" placeholder="Select Employee"
                                            id="emp" name="emp">
                                        <option value="0" disabled selected>Select Employee</option>
                                        @foreach($employee as $employee)
                                            <option value="{{$employee->empepf}}">
                                                {{ ucfirst($employee->empepf.' - '.$employee->empSurname.' '.$employee->empInitials) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="model">Model S/N</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="text" name="model"
                                           placeholder="Enter Model S/N" id="model">
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="fx_image">Image of the fixed Asset</label>
                                <div class="col-sm-3">
                                    <input type="file" name="fx_image" id="fx_image" class="form-control mb-3">
                                    <img name="display_image" id="display_image" style="height: 120px;width:120px;">
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="remarks">Remarks</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="text" name="remarks"
                                           placeholder="Enter Remarks" id="remarks">
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="quantity"> Salvage Value </label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="text" name="salvage"
                                           placeholder="Enter Salvage Value" id="salvage">
                                </div>
                            </div>

                            <br/>
                            <input type="hidden" name="action" id="form-action" value="">
                            <input type="submit" name="btn" class="btn btn-primary" value="ISSUE" onclick="document.getElementById('form-action').value='ISSUE'">
                            <input type="reset" class="btn btn-warning" value="CLEAR">

                            <br/><br/>

                            <div class="form-group form-row">
                                <label class="col-sm-2" for="supplier"> Quantity </label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control" type="text" name="bulkQty"
                                           placeholder="Enter Quantity" id="bulkQty">
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary" name="btns" value="BULK ISSUE" onclick="document.getElementById('form-action').value='BULK_ISSUE'">

                            <br/><br/>

                            <div class="form-group">
                                <label for="req">* Required Feilds</label>
                            </div>

                        </form>
                        @include('layouts.messagePopup')
                        <br/>


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
        jQuery(document).ready(function () {
            jQuery('select[name="GrnNo"]').on('change', function () {
                var HeaderID = jQuery(this).val();
                if (HeaderID) {
                    jQuery.ajax({
                        url: '{{ url("/ajax/fxBinItems/") }}/' + HeaderID,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
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
                let division = $('select[name="division"]').val();
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

            $("#GinNo").off('click').on('blur', function () {
                let gin_no = $(this).val();
                if (gin_no !== "" && 0 !== gin_no) {
                    jQuery.ajax({
                        url: '{{ url("/ajax/validateGIN")}}/' + gin_no,
                        type: "GET",
                        dataType: "text",
                        success: function (response) {
                            if (Object.keys(response).length > 0) {
                                var ginData = JSON.parse(response);
                                if (ginData.fxDept != null) {
                                    $("#division").val(ginData.fxDept).trigger("change");
                                    $("#division").prop("disabled", true);
                                }
                                if (ginData.fxIDate != null) {
                                    var date = ginData.fxIDate.split(' ')[0];
                                    $("#issueDate").val(date);
                                    $("#issueDate").prop("disabled", true);
                                }
                                if (ginData.fxUPFNo != null) {
                                    $("#emp").val(ginData.fxUPFNo).trigger("change");
                                    $("#emp").prop("disabled", true);
                                }
                            } else {
                                enableElements();
                                $("#division").val(0);
                                $("#issueDate").val("");
                                $("#emp").val(0);
                            }
                        }
                    });
                } else {
                    alert('Please fill the GIN Number first.')
                }
            });

            $("#fxGINForm").submit(function () {
                enableElements();
            });

            function enableElements() {
                $("#division").prop("disabled", false);
                $("#issueDate").prop("disabled", false);
                $("#emp").prop("disabled", false);
            }

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
        };

    </script>
@endsection
