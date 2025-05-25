<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Consummable Item List')

@section('content')
<div class="container">
    <div class="row">
        <div class="content-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sidebar">
                        @foreach($results as $results )
                        <a ref="ItemNo" data-no="{{$results->ch_ConHdr}}" href="#" target="">{{$results->ch_ConDesc}}</a>
                        @endforeach
                        <a ref="hrdAll" href="#" target="">All Items</a>
                    </div>

                    <div class="content" id="ajaxResults">

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $('a[ref="ItemNo"]').click(function() {
            $('#ajaxResults').html("Loading..");
            var next = $(this).attr("data-no");
            $('a[ref="ItemNo"]').removeClass('active');
            $(this).addClass('active');
            $.ajax({
                type: 'GET',
                url: '{{url("/reports/consumables/ReceiveMonthly/content/")}}/' + next + '/{{$year == null ? "-1" : $year}}/{{$month == null ? "-1" : $month}}/{{$valueOfDateCategory}}/{{$fromDate == null ? "-1" : $fromDate}}/{{$toDate == null ? "-1" : $toDate}}',
                data: {},
                dataType: 'json',
                success: function(data) {
                    $('#ajaxResults').html(data.html);
                },
                error: function(error) {
                    console.log(error.responseJSON.message);
                }
            });

        });

        $('a[ref="hrdAll"]').click(function() {
            $('a[ref="hrdItem"]').removeClass('active');
            $('a[ref="ItemNo"]').removeClass('active');
            $(this).addClass('active');
            var next="-1";
            $.ajax({
                type: 'GET',
                url: '{{url("/reports/consumables/ReceiveMonthly/total")}}/' + next + '/{{$year == null ? "-1" : $year}}/{{$month == null ? "-1" : $month}}/{{$valueOfDateCategory}}/{{$fromDate == null ? "None" : $fromDate}}/{{$toDate == null ? "None" : $toDate}}',
                data: {},
                dataType: 'json',
                success: function(data) {
                    $('#ajaxResults').html(data.html);
                },
                error: function(error) {
                    console.log(error.responseJSON.message);
                }
            });
        });
        $('a[ref="ItemNo"]:first').click();

    });

</script>
@endsection
@section('script')

@endsection