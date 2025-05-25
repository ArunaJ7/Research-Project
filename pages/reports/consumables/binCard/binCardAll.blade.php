<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Bincard All Items')

@section('content')
<div class="container">
    <div class="row">
        <div class="content-container"  rel="content-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sidebar">
                        @foreach($conItems as $stockItem )
                        <a ref="ItemNo" data-no="{{$stockItem->st_ConItem}}" href="#" target="">{{$stockItem->st_ConItem}}</a>
                        @endforeach
                        <!-- <a ref="hrdAll"  href="#" target="">All Items</a> -->
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
        var next = $(this).attr("data-no");
        $('a[ref="ItemNo"]').removeClass('active');
        $('a[ref="hrdAll"]').removeClass('active');
        $(this).addClass('active');
        $.ajax({
            type: 'GET',
            url: '{{url("/ajax/viewBinCardIndividualReport")}}/' + next,
            data: {},
            dataType: 'json',
            success: function(data) {
                $('#ajaxResults').html(data.html);
            },
            error:function(error){
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
            url: '{{url("/reports/conItem/ListConsumableItems/filter/all")}}' ,
            data: {},
            dataType: 'json',
            success: function(data) {
                $('#ajaxResults').html(data.html);
            },
            error:function(error){
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
