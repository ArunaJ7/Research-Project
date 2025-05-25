@extends('layouts.mainlayout')
@section('title','Fixed Assets Register')
@section('content')
<div class="container">
  <div class="row">
    <div class="container">
      <br /><br /><br /><br /><br />
      <h1 style='text-align:center'>Fixed Assets Register</h1>
      <form action='{{url("/fx-register/view")}}' method="post" onsubmit="return validateForm()">
        {{csrf_field()}}
        <br> </br>
        <div class="form-group form-row">
          <label class="col-sm-2" for="supplier">Division</label>
          <div class="col-sm-10">
            <select class="form-control formselect required" placeholder="Select Division" id="division" name="division">
              <option value="-1" selected>All</option>
              @foreach($division as $itemName)
              <option value="{{$itemName->deptFA}}">
                {{ ucfirst($itemName->deptName) }}
              </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group form-row">
          <label class="col-sm-2" for="input-date">Head Category</label>
          <div class="col-sm-10">
            <select class="form-control formselect required" placeholder="Select Header" id="heder" name="heder">
              <option value="-1" selected>All</option>
              @foreach($headcategory as $header)
              <option value="{{$header->fh_FxHdr}}">
                {{ ucfirst($header->fh_FxHdr.' - '.$header->fh_FxDesc) }}
              </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group form-row">
          <label class="col-sm-2" for="input-unitprice">Sub Category</label>
          <div class="col-sm-10">
            <div class="dropdown">
              <select class="form-control formselect required" placeholder="Select Item" id="dropdownMenuButton" name="itemSelect" required>
                <option value="-1" selected>All</option>

              </select>
            </div>
          </div>
        </div>


        <div class="row justify-content-md-center">
          <label class="col-sm-2" for="input-unitprice"></label>
          <div class="col-sm-5">
            <label class="" for="ginNo"> From: </label>
            <input type="Date" class="form-control" value="0" placeholder="From Date" id="FromDate" name="FromDate" aria-label="First name">
          </div>
          <div class="col-sm-5">
            <label class="" for="ginNo"> To : </label>
            <input type="Date" class="form-control" value="0" placeholder="To date" id="ToDate" name="ToDate" aria-label="Last name">
          </div>
        </div></br>
        <div class="form-group form-row">
          <label class="col-sm-2" for="input-unitprice"></label>
          <div class="col-sm-10">
            <button type="submit" class="btn btn-danger" value="VIEW">View</button>
            <input type="reset" class="btn btn-warning" value="CLOSE">
          </div>
        </div>
        </br> </br>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('select[name="heder"]').on('change', function() {
      var fxItem = $(this).val();
      $('select[name="itemSelect"]').empty();
      if (fxItem) {
        $.ajax({
          url: '{{ url("/ajax/fxItems/") }}/' + fxItem,
          type: "GET",
          dataType: "json",
          success: function(data) {
            let $heder = $('select[name="itemSelect"]');
            $heder.empty();
            $heder.append('<option value="-1">All</option>');
            $.each(data, function(key, value) {

              $heder.append('<option value="' + value.fh_FxHdr2 + '">' + value.fh_Desc + '</option>');
            });
          }
        });
      } else {
        $('select[name="heder"]').empty();
        $.ajax({
          url: '{{ url("/ajax/fxItems/") }}/' + fxItem,
          type: "GET",
          dataType: "json",
          empty: function(data) {
            let $heder = $('select[name="itemSelect"]');
            $heder.append('<option value="0"');
          }
        });
      }
    });
  });
</script>
@endsection