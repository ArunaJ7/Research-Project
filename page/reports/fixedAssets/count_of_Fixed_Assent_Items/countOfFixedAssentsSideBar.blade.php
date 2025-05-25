<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Count of FixedAssets Item List')

@section('content')
<div class="content-container">
    <div class="row">
        <div class="col-md-12">
            <section>
                <div class="sidebar" id="sidebar01">
                    @foreach($results as $stockItem )
                    <a ref="ItemNo" data-no="{{$stockItem-> fh_FxHdr}}" href="#" target="">{{$stockItem->fh_FxDesc}}</a>
                    @endforeach
                    <a ref="hrdAll" href="#" target="">All Items</a>
                </div>
                <div class="content" id="ajaxResults">
                </div>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        let sidebar = '{{$displaySidebar ? "true" : "false"}}';
        if (sidebar != 'false') {
            $('a[ref="ItemNo"]').click(function() {
                var next = $(this).attr("data-no");
                $('a[ref="ItemNo"]').removeClass('active');
                $(this).addClass('active');

                $.ajax({
                    type: 'GET',
                    url: '{{url("/countOfFixedAssetsItem/view/")}}/' + next + '/{{$division == null ? "-1" : $division}}/{{$maincategory == null ? "1" : $maincategory}}/{{$fromDate == null ? "-1": $fromDate}}/{{$toDate == null ? "-1" : $toDate}}',
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

        } else {
            var next = "-1";
            hidesidebar();
            $.ajax({
                type: 'GET',
                url: '{{url("/countOfFixedAssetsItem/view/")}}/' + next + '/{{$division == null ? "-1" : $division}}/{{$maincategory == null ? "1" : $maincategory}}/{{$fromDate == null ? "-1": $fromDate}}/{{$toDate == null ? "-1" : $toDate}}',
                data: {},
                dataType: 'json',
                success: function(data) {
                    $('#ajaxResults').html(data.html);

                },
                error: function(error) {
                    console.log(error.responseJSON.message);
                }
            });
        }

        $('a[ref="hrdAll"]').click(function() {
            $('a[ref="hrdItem"]').removeClass('active');
            $('a[ref="ItemNo"]').removeClass('active');
            $(this).addClass('active');
            $.ajax({
                type: 'GET',
                url: '{{url("/countOfFixedAssetsItem/view-total")}}/{{$division == null ? "-1" : $division}}/{{$fromDate == null ? "-1": $fromDate}}/{{$toDate == null ? "-1" : $toDate}}',
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
    });

    function hidesidebar() {
        var x = document.getElementById("sidebar01");
        let sidebar = '{{$displaySidebar? "true" : "false"}}';
        if (sidebar == 'false') {
            x.style.display = 'none';

        }
    }
</script>
@endsection
@section('script')

@endsection

