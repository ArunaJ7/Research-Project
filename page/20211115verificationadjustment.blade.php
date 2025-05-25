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
              <div class="col-sm-9" style="align:left">
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

	    <div class="form-group" align="center">
		<button type="button" name="filter" id="filter" class="btn btn-info">FILTER</button>
		<button type="button" name="reset" id="reset" class="btn btn-light">RESET</button>
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

          <div class="table-responsive">
    		<table id="customer_data" class="table table-dark">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Number</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                </table>
   	  </div>     
   
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

@endsection