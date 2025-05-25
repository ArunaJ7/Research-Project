<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Reports - Consumables (GIN)')

@section('content')
<div class="container">
    <div class="content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="sidebar">
                    @foreach($results as $gin )
                    <a ref="ginItem" data-no="{{$gin->fxGINNo}}" href="#" target="">{{$gin->fxGINNo}}</a>
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
        $('a[ref="ginItem"]').click(function() {
            var next = $(this).attr("data-no");
            $('a[ref="ginItem"]').removeClass('active');
            $(this).addClass('active');
            $.ajax({
                type: 'GET',
                url: '{{url("/reports/fxItem/gin/filter/results/")}}/' + next,
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
        $('a[ref="ginItem"]:first').click();
    });
</script>
@endsection
@section('script')

@endsection