<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title', 'Reports - Consumables (GIN)')
@section('content')
    <div class="container">
        <div class="content-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sidebar">
                        <div id="loadingButton" class = "loading-container"> </div>
                        @foreach ($results as $hrd)
                            <a ref="hrdItem" data-no="{{ $hrd->ch_ConHdr }}" fromDate="{{ $fromDate }}"
                                toDate="{{ $toDate }}" href="#" target="">{{ $hrd->ch_ConDesc }}</a>
                        @endforeach
                        <a ref="hrdAll" fromDate="{{ $fromDate }}" toDate="{{ $toDate }}" href="#"
                            target="">All Items</a>
                    </div>
                    <div class = "content" id="loadingButton1"><button class="loading-button">
                            Loading...
                        </button>
                    </div>
                    <div id ="tx">
                        <div class="content" id="ajaxResults">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Including JavaScript -->
    <script type="text/javascript">
        jQuery(document).ready(function() {
            const loadingButton = document.getElementById('loadingButton');
            const loadingButton1 = document.getElementById('loadingButton1');
            const tx = document.getElementById('tx');

            function showLoading() {
                loadingButton.style.display = 'block';
                loadingButton1.style.display = 'block';
                tx.style.display = 'none';
            }

            function hideLoading() {
                loadingButton.style.display = 'none';
                loadingButton1.style.display = 'none';
                tx.style.display = 'block';
            }

            $('a[ref="hrdItem"]').click(function() {
                let currentDate = new Date().toJSON().slice(0, 10);
                var next = $(this).attr("data-no");
                var fromDate = $(this).attr("fromDate") == "" ? '0000-00-00' : $(this).attr("fromDate");
                var toDate = $(this).attr("toDate") == "" ? currentDate : $(this).attr("toDate");
                $('a[ref="hrdItem"]').removeClass('active');
                $('a[ref="hrdAll"]').removeClass('active');
                $(this).addClass('active');

                showLoading();

                $.ajax({
                    type: 'GET',
                    url: '{{ url('/reports/conItem/AgeAnalysisReport/results/') }}/' + next + '/' +
                        fromDate + '/' + toDate,
                    data: {},
                    dataType: 'json',
                    success: function(data) {
                        $('#ajaxResults').html(data.html);
                    },
                    error: function(error) {
                        console.log(error.responseJSON.message);
                    },
                    complete: function() {
                        hideLoading();
                    }
                });
            });

            $('a[ref="hrdAll"]').click(function() {
                let currentDate = new Date().toJSON().slice(0, 10);
                let fromDate = $(this).attr("fromDate") == "" ? '0000-00-00' : $(this).attr("fromDate");
                let toDate = $(this).attr("toDate") == "" ? currentDate : $(this).attr("toDate");
                $('a[ref="hrdItem"]').removeClass('active');
                $(this).addClass('active');

                showLoading();

                $.ajax({
                    type: 'GET',
                    url: '{{ url('/reports/conItem/AgeAnalysisReport/total') }}/' + fromDate + '/' +
                        toDate,
                    data: {},
                    dataType: 'json',
                    success: function(data) {
                        $('#ajaxResults').html(data.html);
                    },
                    error: function(error) {
                        console.log(error.responseJSON.message);
                    },
                    complete: function() {
                        hideLoading();
                    }
                });
            });

            $('a[ref="hrdItem"]:first').click();
        });
    </script>

@endsection
@section('script')

@endsection
