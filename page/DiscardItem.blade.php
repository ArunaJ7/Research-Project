<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title','Discard Item')
@section('content')

<div class="container">
    <div class="row">
      <div class="container" id="faccontainer">
  
        <h1>Discard Item Details</h1>

        <br/>

        <div class="row">
            <div class="col-md-12">
                <form action="{{url('/savediscarditem')}}" method="POST">
                {{csrf_field()}}

                <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">Header</label>
                        <div class="col-sm-9">
                        <select class="form-control formselect required" placeholder="Select Header" id="header" name="header">
                            <option value="0" disabled selected>Select Fixed Asset Header Name</option>
                            @foreach($sto_fxhdrs as $header)
                            <option  value="{{$header->fh_FxHdr}}">
                            {{ ucfirst($header->fh_FxDesc.' - '.$header->fh_FxHdr) }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">Item</label>
                        <div class="col-sm-9">
                        <select class="form-control formselect required" placeholder="Select Fixed Asset Name" id="item" name="item">
                            <option value="0" disabled selected>Select Fixed Asset Name</option>
                            
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
                        <input value="" class="form-control" type="text" name="code" placeholder=" " required="required" id="code">
                        </div>
                    </div>

                    <div class="form-group form-row">
                            <label class="col-sm-2" for="supplier">Division</label>
                            <div class="col-sm-9">
                                <select disabled class="form-control formselect required" placeholder="Select Division" id="division" name="division">
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
                        <label class="col-sm-2" for="supplier">Date</label>
                        <div class="col-sm-9">
                            <input value="" class="form-control" type="date" name="RDate" placeholder="Enter Date" required="required" id="RDate">
                        </div>
                    </div>


                    <br/>

                    <input type="submit" class="btn btn-danger" value="DISCARD">
                    <input type="reset" class="btn btn-warning" value="CLEAR">
            </br> </br>     
          </form>

          <table class="table table-dark">
           
            <th> Date</th>
            <th> Header</th>
            <th> F/A Code</th>
            <th> Division</th>
            <th> Status</th>
            
            
            @foreach($disitms as $discarditem)
              <tr>
                <td> {{$discarditem->fxRDate}} </td>
                <td> {{$discarditem->fh_FxHdr2}} </td>
                <td> {{$discarditem->fxCode}} </td>
                <td> {{$discarditem->fxDept}} </td>
                <td> {{$discarditem->fxStatus}} </td>

                <td> 
                  
                </td>
              </tr>
            @endforeach
          </table>       
                
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
                        $.each(data, function(key, value) {
                            $itemselect.append('<option value="' + key + '">' + value + ' - ' + key + '</option>');
                        });
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
                    url: '{{ url("/ajax/fx/inactive/") }}/' + HeaderID,
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
                            $itemselect.append('<option value="' + itemNo + '" data-fa="' + fa + '"  data-dept="' + value.fxDept + '">' + itemNo + '</option>');
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
            $('select[name="division"] option[value="' + values['data-dept'].value).attr("selected", "selected")

        });

    });
</script>
@endsection