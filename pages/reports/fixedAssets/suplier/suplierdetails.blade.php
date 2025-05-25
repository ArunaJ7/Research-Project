@extends('layouts.mainlayout')
@section('title','suplier details')
@section('content')
<div class="container">
    <div class="row">
        <div class="content-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sidebar" id="sidebar01">
                        @foreach($results as $item )
                        <a ref="ItemNo" data-no="{{$item-> fh_FxHdr}}" href="#" target="">{{$item->fh_FxDesc}}</a>
                        @endforeach
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
        let sidebar = '{{$displaySidebar ? "true" : "false"}}';
        if (sidebar != 'false') {
            $('a[ref="ItemNo"]').click(function() {
                var next = $(this).attr("data-no");
                $('a[ref="ItemNo"]').removeClass('active');
                $(this).addClass('active');
                $.ajax({
                    type: 'GET',
                    url: '{{url("reports/fixedAssets/suplier")}}/' + next + '/{{$division==null ? "-1" : $division}}/{{$maincategory== null ? "-1" : $maincategory }}/{{$subcategory== null ? "-1" : $subcategory }}/{{$fromDate == null ? "-1" :$fromDate}}/{{$toDate == null ? "-1" :$toDate}}',
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
                url: '{{url("reports/fixedAssets/suplier")}}/' + next + 
                '/{{$division==null ? "-1" : $division}}/{{$maincategory== null ? "-1" : $maincategory }}/{{$subcategory== null ? "-1" : $subcategory }}/{{$fromDate == null ? "-1" :$fromDate}}/{{$toDate == null ? "-1" :$toDate}}',
                data: {},
                dataType: 'json',
                success: function(data) {
                    $('#ajaxResults').html(data.html);
                },
                error: function(error) {
                    console.log(error.responseJSON.message);
                }
            })
        }
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