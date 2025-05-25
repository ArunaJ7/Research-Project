<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Verification Adjustment')

@section('content')
<div class="container">
  <div class="row">
    <div class="container" id="faccontainer">

      <h1>Verification Adjustment</h1>
      <div class="row">
        <div class="col-md-12">
               
          <form action="/Stores/public/save_VerifyAdjust" method="POST">
          {{csrf_field()}}
          
            <br/>

            <div class="form-group form-row">
              <label class="col-sm-3" for="type">Recive / Issue</label>
              <div class="col-sm-9" >
                <label class="radio-inline">
                  <input type="radio" id="ph_type" required="required" name="ph_type" value="VR"> Receive
                </label>

                <label class="radio-inline">
                  <input type="radio" id="ph_type" required="required" name="ph_type" value="VI"> Issue
                </label>
              </div>
            </div>

            <!-- Header -->
            <div class="form-group form-row">
              <label class="col-sm-3" for="header">Header Discription</label>
              <div class="col-sm-9">
                <select class="form-control" placeholder="Select Header" id="ph_header" name="ph_header" required="required">
                  <option value="">--Select Consumable Header Desctiption--</option>
                  @foreach($data_conhd as $key => $value)
                    <option  value="{{ $key }}">
                      {{ $value }}
                    </option>
                  @endforeach
                </select>
              </div> 
            </div>

            <!-- Item -->
            <div class="form-group form-row">
              <label class="col-sm-3" for="item">Item Description</label>
              <div class="col-sm-9">
                <select class="form-control" placeholder="Select Item" id="ph_item" name="ph_item" required="required">
                  <option value="">--Select Consumable Item Desctiption--</option>
                </select>
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-3" for="date">Date</label>
              <div class="col-sm-9">
                <input class="form-control datepicker" type="date" name="ph_date" value = <?php echo($Date) ?> id="ph_date" readonly>
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-3" for="price">Unit Price</label>
              <div class="col-sm-9">
                <input value="" class="form-control" type="text" name="ph_price" placeholder="Enter Unit Price" required="required" id="ph_price">
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-3" for="qty">Adjusted Qty</label>
              <div class="col-sm-9">
                <input value="" class="form-control" type="text" name="ph_qty" placeholder="Enter Adjusted Quantity" required="required" id="ph_qty">
              </div>
            </div>


            </br>
            <input type="submit" class="btn btn-primary" value="SAVE">
            <input type="reset" class="btn btn-warning" value="CLEAR">
            </br></br>
          
          </form>

          <table class="table table-dark">
            <th>ID</th>
            <th>Bin Type</th>
            <th>Header Code</th>
            <th>Item Code</th>
            <th>Date</th>
            <th>Unit Price</th>
            <th>Adjested Qty</th>
            
            @foreach($verification_uitbl as $verification_tbl)
              @if($verification_tbl->binType == 'VR')
                <tr>
                  <td> {{$verification_tbl->id}} </td>
                  <td> {{$verification_tbl->binType}} </td>
                  <td> {{$verification_tbl->binSerial}} </td>
                  <td> {{$verification_tbl->binItemCode}} </td>
                  <td> {{$verification_tbl->binDate}} </td>
                  <td> {{$verification_tbl->binUnitPrice}} </td>
                  <td> {{$verification_tbl->binQty}} </td>

                  <td>
                  <a href="/Delete_veifyadjust/{{$verification_tbl->id}}" class="btn btn-danger">Delete</a>
                  <a href="/Update_veifyadjust/{{$verification_tbl->id}}" class="btn btn-warning">Update</a>
                  </td>
                </tr>
              @endif
            @endforeach
          </table>

        </div>
      </div>

    </div>
  </div>
</div>

<style>
  #faccontainer
  {
    text-align: left;
    /* margin-top: 100px;
    margin-bottom: 80px; */
  }

  h1
  {
    text-align: center;
  }
</style>

<!-- <script>
  $(document).ready(function() {
    $('select[name="ph_header"]').on('change', function() {
      var HeaderID = $(this).val();
      if(HeaderID) {
        $.ajax({
          url : '/verificationadjustment/ajax/'+HeaderID,
          type : "GET",
          dataType : "json",
          success:function(data) {
            $('select[name="ph_item"]').empty();
            $.each(data, function(key, value) {
                $('select[name="ph_item"]').append('<option value="'+ key +'">'+ value +'</option>');
            });
          }
        });
      }else{
        $('select[name="ph_item"]').empty();
      }
    });
  });
</script> -->

<script type="text/javascript">
  jQuery(document).ready(function ()
  {
    jQuery('select[name="ph_header"]').on('change',function(){
      var HeaderID = jQuery(this).val();
      if(HeaderID)
      {
        jQuery.ajax({
          url : 'verificationadjustment/view_conItem_data/'+HeaderID,
          type : "GET",
          dataType : "json",
          success:function(data)
          {
            console.log(data);
            jQuery('select[name="ph_item"]').empty();
            jQuery.each(data, function(key,value){
              $('select[name="ph_item"]').append('<option value="'+ key +'">'+ value +'</option>');
            });
          }
        });
      }
      else
      {
        $('select[name="ph_item"]').empty();
      }
    });
  });
</script>

@endsection