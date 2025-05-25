<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Reports - Stock Verification')

@section('content')
<div class="container">
    <div class="content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="sidebar">
                    @foreach($results as $stockItem )
                    <a ref="ItemNo" data-no="{{$stockItem->ch_ConHdr}}" href="#" target="">{{$stockItem->ch_ConDesc}}</a>
                    @endforeach
                    <a ref="hrdAll" href="#" target="">All Items</a>
                </div>
                <div class="content" id="ajaxResults">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $('a[ref="ItemNo"]').click(function() {
            var next = $(this).attr("data-no");
            $('a[ref="hrdAll"]').removeClass('active');
            $('a[ref="ItemNo"]').removeClass('active');
            $(this).addClass('active');
            $.ajax({
                type: 'GET',
                url: '{{url("/reports/conItem/stockVerification/filter/results/")}}/' + next,
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
            $.ajax({
                type: 'GET',
                url: '{{url("/reports/conItem/stockVerification/filter/all")}}',
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