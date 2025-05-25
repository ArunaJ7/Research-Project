<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title','Return Item')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12 content-container">

      <h1>Transfer Item</h1>
      <div class="row text-left">
        <div class="col-md-12">
          <form action="{{url('/savetransItms')}}" method="POST">
            {{csrf_field()}}

            <div class="form-group form-row">
              <label class="col-sm-2" for="header">Header</label>
              <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Header" id="header" name="header">
                  <option value="-1" selected>Select Fixed Asset Header Name</option>
                  @foreach($sto_fxhdrs as $header)
                  <option value="{{$header->fh_FxHdr}}">
                    {{ ucfirst($header->fh_FxDesc.' - '.$header->fh_FxHdr) }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-2" for="item">Item</label>
              <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Fixed Asset Name" id="item" name="item">
                  <option value="-1" selected>Select Fixed Asset Header Name</option>
                </select>
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-2" for="itemNo"> Number </label>
              <div class="col-sm-9">
                <select value="" class="form-control" type="text" name="itemNo" placeholder="Enter Number" required="required">
                </select>
              </div>

            </div>

            <div class="form-group form-row">
              <label class="col-sm-2" for="code">F/A Code</label>
              <div class="col-sm-9">
                <input disabled value="" class="form-control" type="text" name="code" placeholder=" " required="required" id="code">
                <input value="" type="hidden" name="id" required="required" >
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-2" for="division">Division</label>
              <div class="col-sm-9">
                <select class="form-control formselect" placeholder="Select Division" id="division" name="division" required="required">
                  <option value="0" disabled selected>Select Division</option>
                  @foreach($div as $itemName)
                  <option value="{{$itemName->deptFA}}">
                    {{ ucfirst($itemName->deptName. ' - '. $itemName->deptCode) }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-2" for="empSelect"> Employee </label>
              <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Employee" id="empSelect" name="empepf">
                  <option value="0" disabled selected>Select Employee*</option>
                  @foreach($employees as $employee)
                  <option value="{{$employee->empepf}}">
                    {{ ucfirst($employee->empSurname.' '.$employee->empInitials) }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group form-row">
              <label class="col-sm-2" for="RDate">Date</label>
              <div class="col-sm-9">
                <input value="" class="form-control" type="date" name="RDate" placeholder="Enter Date" required="required" id="RDate">
              </div>
            </div>
            <br />

            <input type="submit" class="btn btn-danger" value="TRANSFER">
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
      if (HeaderID != '-1') {
        $.ajax({
          url: '{{ url("/ajax/grn/fxItem/") }}/' + HeaderID,
          type: "GET",
          dataType: "json",
          success: function(data) {
            let $itemselect = $('select[name="item"]');
            $itemselect.empty();
            let firstItem = null;
            $itemselect.append('<option value="-1" selected>Select Fixed Asset Header Name</option>');
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
        let $itemselect = $('select[name="item"]');
        $itemselect.empty();
        $itemselect.append('<option value="-1" selected>Select Fixed Asset Header Name</option>');
        $itemselect[0].value = "-1";
        $itemselect[0].dispatchEvent(new Event('change'));
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
              $itemselect.append('<option value="' + itemNo + '" data-id="' + value.id + '" data-fa="' + fa + '"  data-dept="' + value.fxDept + '">' + itemNo + '</option>');
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
      $('input[name="id"]').val(values['data-id'].value);
      $('select[name="division"]').val(values['data-dept'].value);

    });
  });
</script>

@endsection