@extends('layouts.mainlayout')

@section('title','Consummable Issue Department')

@section('content')
<div class="container" id='content'>
    <div class="container">
        <div class="row">
            <div class="container" id="faccontainer">
                <h1>Issue Department</h1>
                <div class="row">
                    <div class="col-xl-12">
                        <form action="issuedepartmenttable" method="GET">
                            {{csrf_field()}}
                            <input type="hidden" name="_token" value="XfkUfZ7Re5Zyv6XpKv0jcA5znVwbwZvgGds5lSv3"><br />
                            <div class="form-group form-row">

                                <div class="col-xl-12">
                                    <label class="radio-inline">
                                        <input type="radio" id="chkYes" required="required" name="chkPassPort" value="VR"> Monthly
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" id="chkNo" required="required" name="chkPassPort" value="VI" checked="checked"> Annual
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" id="chkDate" required="required" name="chkPassPort" value="VT"> Date Range
                                    </label>
                                </div>
                            </div>

                            <!-- Header -->
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="header">Department</label>
                                <div class="col-sm-9">
                                    <select class="form-control formselect required" placeholder="Select Division" id="department" name="department">
                                        <option value="-1" selected>All</option>
                                        @foreach($div as $itemName)
                                        <option value="{{$itemName->deptCode}}">{{ ucfirst($itemName->deptName) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Item -->

                            <div class="form-group form-row" id="dvyear">
                                <label class="col-sm-3" for="hdrSelect">Year</label>
                                <div class="col-sm-9">
                                    <select id="year" name="year" class="form-control">
                                        @for ($year = date('Y')-30; $year <=date('Y'); $year++) <option value="{{$year}}" {{$year == date('Y') ? 'selected':''}}>{{ $year }}</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-row" id="dvPassport" style="display: none">
                                <label class="col-sm-3" for="date">Month</label>
                                <div class="col-sm-9">
                                    <select class="form-control" placeholder="--Select Month--" id="month" name="month">
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-row" id="dvDateRange" style="display: none">
                                <label class="col-sm-3" for="hdrSelect">From :</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control date" type="date" name="fromDate" placeholder="Enter Item number" id="fromDate">
                                </div>
                                <br><br>
                                <label class="col-sm-3" for="hdrSelect">To :</label>
                                <div class="col-sm-9">
                                    <input value="" class="form-control date" type="date" name="toDate" placeholder="Enter Item number" id="toDate">
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="hdrSelect">Header</label>
                                <div class="col-sm-9">
                                    <select class="form-control formselect required" placeholder="Select Header" id="hdrSelect" name="hdrSelect" required>
                                        <option value="-1" selected>All</option>
                                        @foreach($conHeader as $conHeader)
                                        <option value="{{$conHeader->ch_ConHdr}}">{{ ucfirst($conHeader->ch_ConDesc) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="qty">Item</label>
                                <div class="col-sm-9">
                                    <select class="form-control formselect required" placeholder="Select Item" id="itemSelect" name="itemSelect" required>
                                        <option value="-1" selected>All</option>
                                    </select>
                                </div>
                            </div></br>
                            <button type="submit" class="btn btn-warning" value="View">VIEW</button>
                            <input type="button" class="btn btn-danger" value="Close">
                            </br></br>
                        </form>
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
                            $itemselect.append('<option value="-1" selected>All</option>');
                            $.each(data, function(key, value) {
                                $itemselect.append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="itemSelect"]').empty();
                    $.ajax({
                        url: '{{ url("/ajax/conItem/") }}/' + fxItem,
                        type: "GET",
                        dataType: "json",
                        empty: function(data) {
                            let $heder = $('select[name="itemSelect"]');
                            $heder.append('<option value="0"');
                        }
                    });
                }
            });

        });
    </script>
    <script type="text/javascript">
        $(function() {
            $("input[name='chkPassPort']").click(function() {
                        if ($("#chkYes").is(":checked")) {
                            $("#dvPassport").show();
                            $("#dvyear").show();
                            $("#dvDateRange").hide();
                        }
                        else if ($("#chkDate").is(":checked")) {
                            $("#dvyear").hide();
                            $("#dvPassport").hide();
                            $("#dvDateRange").show();
                        }
                       else if ($("#chkNo").is(":checked")) {
                            $("#dvyear").show();
                            $("#dvDateRange").hide();
                            $("#dvPassport").hide();
                       }
                    });

        });
    </script>

    @endsection