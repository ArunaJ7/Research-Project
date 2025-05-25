<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','FixedAssets Returned and Transfered')

@section('content')
<div class="container">
    <div class="row">
        <div class="content-container">
            <div class="row">
                <div class="col-md-12">
                    <section>
                        <div class="content" id="ajaxResults">
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            
                $.ajax({
                    type: 'GET',
                    url: '{{url("/fx-return-transfer/view/")}}/{{$type == null ? "-1" : $type}}/{{$maincategory == null ? "1" : $maincategory}}/{{$subcategory == null ? "-1" : $subcategory }}/{{$fromDate == null ? "-1": $fromDate}}/{{$toDate == null ? "-1" : $toDate}}',
                    data: {},
                    dataType: 'json',
                    success: function(data) {
                        $('#ajaxResults').html(data.html);

                    },
                    error: function(error) {
                        console.log(error.responseJSON.message);
                    }
                })
            
        });

    </script>
    @endsection
    @section('script')

    @endsection