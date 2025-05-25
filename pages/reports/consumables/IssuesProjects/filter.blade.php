<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title','Consumable Items Issued Details')
@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">
            <br><br>
            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> Project Consumable Items Issues Details </h3>
            <br />
            <form action='{{url("/filter-project-issues")}}' method="GET">

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
                <!-- Item -->
                <div class="form-group form-row" id="dvyear">
                    <label class="col-sm-3" for="hdrSelect">Year</label>
                    <div class="col-sm-9">
                        <select id="year" name="year" class="form-control">
                            @for ($year =date('Y')-30; $year <=date('Y')+50; $year++) <option value="{{$year}}" {{$year == date('Y') ? 'selected' : '' }}>{{$year}}</option>
                                @endfor
                        </select>
                    </div>
                </div>
                <div class="form-group form-row" id="dvPassport" style="display: none">
                    <label class="col-sm-3" for="date">Month</label>
                    <div class="col-sm-9">
                        <select class="form-control" placeholder="--Select Month--" id="month" name="month" required="required">
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
                            <label class="col-sm-3" for="input-dept"> Project </label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" placeholder="Select Project" id="projSelect" name="projSelect">
                                    <option value="-1" disabled selected>Select Project*</option>
                                    @foreach($projects as $project)
                                    <option value="{{$project->projCode}}">
                                        {{ ucfirst($project->projname) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </br>
                <input type="submit" class="btn btn-warning" value="View"></a>&nbsp;
                <input type="button" class="btn btn-danger" value="Close">
                </br></br>
            </form>
            <script type="text/javascript">
                $(function() {
                    $("input[name='chkPassPort']").click(function() {
                        if ($("#chkYes").is(":checked")) {
                            $("#dvPassport").show();
                            $("#dvyear").show();
                            $("#dvDateRange").hide();
                        } else if ($("#chkDate").is(":checked")) {
                            $("#dvyear").hide();
                            $("#dvPassport").hide();
                            $("#dvDateRange").show();
                        } else if ($("#chkNo").is(":checked")) {
                            $("#dvyear").show();
                            $("#dvDateRange").hide();
                            $("#dvPassport").hide();
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>
@endsection