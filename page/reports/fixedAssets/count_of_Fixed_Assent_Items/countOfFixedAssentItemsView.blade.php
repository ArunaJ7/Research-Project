@extends('layouts.mainlayout')

@section('title','FixedAssents')

@section('content')
<div class="container">
  <div class="row">
    <div class="container">
      <br /><br /><br /><br /><br />
      <h1 style='text-align:center'>Count of Fixed assets items</h1>
      <form action="fixreportview" method="GET" onsubmit="return validateForm()">
        {{csrf_field()}}
        <br> <br>
        <div class="form-group form-row">                                                                                                                                                                                                                    
          <label class="col-sm-2" for="fixedAssent">DIVISION</label>
          <div class="col-sm-4">
          <select class="form-control formselect required" placeholder="Select Division" id="division" name="division">
              <option value="-1">All Division</option>
              @foreach($div as $itemName)
              <option value="{{$itemName->deptFA}}" data-dept-code="{{$itemName->deptFA}}">
                {{ ucfirst($itemName->deptName) }}
              </option>
              @endforeach
            </select>
          
          </div>
          <div class="col-sm-2">
          <input value="All" class="form-control" type="text" placeholder=""  id="category" disabled>
          </div>
        </div>
        <div class="form-group form-row">
          <label class="col-sm-2" for="input-date">CATEGORY</label>
          <div class="col-sm-4">
          <select class="form-control formselect required" placeholder="Select Header" id="MainCategory" name="MainCategory">
              <option value="-1" >All Catagory</option>
              @foreach($sto_fxhdrs as $header)
              <option value="{{$header->fh_FxHdr}}"  data-heder-code="{{$header->fh_FxHdr}}">
                {{ ucfirst($header->fh_FxDesc) }}
              </option>
              @endforeach
            </select>
          </div>
          
          <div class="col-sm-2">
          <input value="All" class="form-control" type="text" placeholder=""  id="categoryheder" disabled>
          </div>
        </div>
       
        <div class="row justify-content-md-left">
          <label class="col-sm-2" for="input-unitprice"></label>
          <div class="col-sm-3">
            <label class="" for="ginNo"> From: </label>
            <input type="Date" class="form-control" placeholder="From Date"  id="FromDate" name="FromDate"  >
          </div>
          <div class="col-sm-3">
            <label class="" for="ginNo"> To : </label>
            <input type="Date"  class="form-control" placeholder="To date" id="Todate" name="Todate" >
          </div>
        </div><br>
        <div class="form-group form-row">
          <label class="col-sm-2" for="input-unitprice"></label>
          <div class="col-sm-10">
            <input type="submit" class="btn btn-danger" value="VIEW"></button>
            <input type="reset" class="btn btn-warning" value="CLOSE">
          </div>
        </div>
        <br> <br>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {

    $('select[name="MainCategory"]').on('change', function() {
      var fxItem = $(this).val();
      $('tbody[rel="fxItems"]').empty();
      if (fxItem) {
        $.ajax({
          url: '{{ url("/ajax/fxItems/") }}/' + fxItem,
          type: "GET",
          dataType: "json",
          success: function(data) {
            let $heder = $('select[name="itemSelect"]');
               // $sub = $('div[name = "sub"]');
            $heder.empty();
            $.each(data, function(key, value) {
              $heder.append('<option value="' + value.fh_FxHdr2 + '"  data-footer-code= '+ value.fh_FxHdr2+'>' + value.fh_Desc + '</option>');
            
            });
          }
        });
      } else {
        $('select[name="itemSelect"]').empty();
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

    $('select[name="division"]').on('change', function(){
      let selectedDiv = $(this).val();
      let selectedDeptCode = $(this).find('option[value="'+ selectedDiv +'"]').attr('data-dept-code');
      $('#category').val(selectedDeptCode);
    });
    

    
    $('select[name="MainCategory"]').on('change', function(){
      let selectedDiv = $(this).val();
      let selectedhedCode = $(this).find('option[value="'+ selectedDiv +'"]').attr('data-heder-code');
      $('#categoryheder').val(selectedhedCode);
    });
  
  });
</script>
@endsection