<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title','View Fixed Assets Image')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 content-container" >
            <h1>View Fixed Assets Image</h1>
            <br />
            <div class="row text-left">
                <div class="col-md-12">
                    <form action="{{ url('/fx/viewImage/') }}" method="POST">
                        {{csrf_field()}}

                        <div class="form-group form-row">
                            <label class="col-sm-2" for="supplier">Header</label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" placeholder="Select Header" id="header" name="header">
                                    <option value="0" disabled selected>Select Fixed Asset Header Name</option>
                                    @foreach($sto_fxhdrs as $header)
                                    <option value="{{$header->fh_FxHdr}}">
                                        {{ ucfirst($header->fh_FxDesc.' - '.$header->fh_FxHdr) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-2" for="supplier">Item</label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" placeholder="Select Fixed Asset Name" id="item" name="item">

                                </select>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-2" for="supplier"> Number </label>
                            <div class="col-sm-9">
                                <select value="" class="form-control" type="text" name="itemNo" placeholder="Enter Number" required="required">
                                </select>
                            </div>

                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-2" for="supplier">F/A Code</label>
                            <div class="col-sm-9">
                                <input disabled value="" class="form-control" type="text" name="code" placeholder=" " required="required" id="code">
                                <input value="" type="hidden" name="codehdn" required="required" >
                            </div>
                        </div>

                        <br />

                        <!-- <input type="submit" class="btn btn-primary" value="RETURN"> -->
                        <input type="submit" class="btn btn-danger" value="VIEW">
                        <input type="reset" class="btn btn-warning" value="CLEAR">
                        </br> </br>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="header"]').on('change', function() {
            var HeaderID = $(this).val();
            if (HeaderID) {
                $.ajax({
                    url: '{{ url("/ajax/grn/fxItem/") }}/' + HeaderID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        let $itemselect = $('select[name="item"]');
                        $itemselect.empty();
                        let firstItem = null;
                        $.each(data, function(key, value) {
                            firstItem = firstItem == null ? key : firstItem;
                            $itemselect.append('<option value="' + key + '">' + value + ' - ' + key + '</option>');
                        });
                        if (data.length) {
                            $itemselect[0].value = firstItem;
                            $itemselect[0].dispatchEvent(new Event('change'));
                        }
                    }
                });
            } else {
                $('select[name="item"]').empty();
            }
        });
        $('select[name="item"]').on('change', function() {
            let HeaderID = $(this).val();
            if (HeaderID) {
                $.ajax({
                    url: '{{ url("/ajax/fx/issue/") }}/' + HeaderID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        let $itemselect = $('select[name="itemNo"]');
                        $itemselect.empty();
                        let firstItem = null;
                        $.each(data, function(key, value) {
                            let fa = value.fxCode;
                            let itemNoArr = fa.split('/');
                            let itemNo = itemNoArr[itemNoArr.length - 1];
                            firstItem = firstItem == null ? itemNo : firstItem;
                            $itemselect.append('<option value="' + itemNo + '" data-fa="' + fa +  '">' + itemNo + '</option>');
                        });
                        if (data.length) {
                            $itemselect[0].value = firstItem;
                            $itemselect[0].dispatchEvent(new Event('change'));
                        }
                    }

                });
            } else {
                $('select[name="itemNo"]').empty();
            }
        });

        $('select[name="itemNo"]').on('change', function() {
            let values = $(this).find('[value="' + $(this).val() + '"]')[0].attributes;
            $('input[name="code"]').val(values['data-fa'].value);
            $('input[name="codehdn"]').val(values['data-fa'].value);
            

        });
    });
</script>
@endsection