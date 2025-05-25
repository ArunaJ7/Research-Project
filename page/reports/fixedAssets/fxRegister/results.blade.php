<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','FixedAssets Item List')

@section('content')
<div class="content-container">
    <div class="row">
        <div class="col-md-12">
            <section>
                <div id="ajaxResults">
                </div>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $('#ajaxResults').html('Loading..');
        $.ajax({
            type: 'GET',
            url: '{{url("/fx-register/view/")}}/{{$division == null ? "-1" : $division}}/{{$maincategory == null ? "1" : $maincategory}}/{{$subcategory == null ? "-1" : $subcategory }}/{{$fromDate == null ? "-1": $fromDate}}/{{$toDate == null ? "-1" : $toDate}}',
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
</script>
@endsection
@section('script')

@endsection