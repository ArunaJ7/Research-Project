<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title','Reports - Consumables (GRN)')
@section('content')
<div class="container">
    <div class="content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="sidebar">
                    @foreach($results as $grn )
                    <a ref="grnItem" data-no="{{$grn->GRN_No}}" href="#" target="">{{$grn->GRN_No}}</a>
                    @endforeach
                </div>
                <div class="content" id="ajaxResults">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $('a[ref="grnItem"]').click(function() {
            var next = $(this).attr("data-no");
            $('a[ref="grnItem"]').removeClass('active');
            $(this).addClass('active');
            $.ajax({
                type: 'GET',
                url: '{{url("/reports/conItem/grn/filter/results/")}}/' + next,
                data: {},
                dataType: 'json',
                success: function(data) {
                    $('#ajaxResults').html(data.html);
                }
            });
        });
        $('a[ref="grnItem"]:first').click();
    });
</script>
@endsection
@section('script')
@endsection