<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Return to Supplier')

@section('content')

<div class="container">
  <div class="row">
    <div class="container" id="faccontainer">

      <h1>Return to Supplier - Consumable Items</h1>

      <div class="row">
        <div class="col-md-12">

          <form action=" {{ url('/saveReturnToSupplier') }}" method="POST" onsubmit="return validateForm()" >
            {{csrf_field()}}
            <br> </br>

            <!-- Header-->
            <div class="form-group form-row">
              <label class="col-sm-2" for="hdrSelect"> Header </label>
              <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Header" id="hdrSelect" name="hdrSelect" required>
                  <option value="0" disabled selected>Select Header*</option>
                  @foreach($conHeader as $conHeader)
                  <option value="{{$conHeader->ch_ConHdr}}">
                    {{ ucfirst($conHeader->ch_ConDesc.' - '.$conHeader->ch_ConHdr) }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-2" for="itemSelect"> Item </label>
              <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Item" id="itemSelect" name="itemSelect" required>
                  <option value="0" disabled selected>Select Item*</option>

                </select>
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-2" for="input-date">Date</label>
              <div class="col-sm-9">
                <input value="" class="form-control date" type="date" name="date" placeholder="Enter Date" required="required" id="date">
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-2" for="input-date">GRN No</label>
              <div class="col-sm-9">
                <input class="form-control required" id="grn" name="grn" placeholder="Select the record from received items table" required readonly>
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-2" for="input-unitprice">Unit Price</label>
              <div class="col-sm-9">
                <input value="" class="form-control" type="text" name="unitprice" placeholder="Select the record from received items table" required="required" id="unitprice" readonly>
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-2" for="input-type">Type</label>
              <div class="col-sm-9">
                <input value="" class="form-control" type="text" name="type" placeholder="Select the record from received items table" required="required" id="type" readonly>
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-2" for="input-balance">Balance</label>
              <div class="col-sm-9">
                <input value="" class="form-control" type="text" name="balance" placeholder="Select the record from received items table " required="required" id="balance" readonly>
              </div>
            </div>

            <div class="form-group form-row">
              <label class="col-sm-2" for="input-qty">Quantity Returned</label>
              <div class="col-sm-9">
                <input value="" class="form-control" type="number" name="qty" placeholder="Enter Quantity Returned" required="required" id="qty">
              </div>
            </div>

            </br>

            <input type="submit" class="btn btn-danger" value="RETURN">
            <input type="reset" class="btn btn-warning" value="CLEAR">
            </br> </br>
          </form>
          @include('layouts.messagePopup')
          <div class="table-responsive">
            <h5 style="text-align:center"> Available Received Consumable Items </h5>
            <table class="table table-dark table-hover">
              <thead>
                <td> GRN Number </td>
                <td> Unit Price </td>
                <td> Received Qty </td>
                <td> Type </td>   
                <td> Available Qty  </td>
              </thead>
              <tbody rel="binItems">

              </tbody>
            </table>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<style>
  #faccontainer {
    text-align: left;
  }

  h1 {
    text-align: center;
  }
</style>

<script type="text/javascript">
  $(document).ready(function() {
    // handles the header selection
    $('select[name="hdrSelect"]').on('change', function() {
      var HeaderID = $(this).val();
      clearInputs(); // clearing the inputs
      $('tbody[rel="binItems"]').empty(); // clearing the table
      if (HeaderID) {
        $.ajax({
          url: '{{ url("/ajax/conItem/") }}/' + HeaderID,
          type: "GET",
          dataType: "json",
          success: function(data) {
            let $itemselect = $('select[name="itemSelect"]');
            $itemselect.empty();
            $itemselect.append('<option value="0" disabled selected>Select Item*</option>');
            $.each(data, function(key, value) {
              $itemselect.append('<option value="' + key + '">' + value + ' - ' + key +'</option>');
            });

          }
        });
      } else {
        $('select[name="itemSelect"]').empty();
      }
    });
    // handles the item selection
    $('select[name="itemSelect"]').on('change', function() {
      var itemID = $(this).val();
      $('tbody[rel="binItems"]').empty();
      clearInputs();
      if (itemID) {
        $.ajax({
          url: '{{ url("/ajax/binItems/") }}/' + itemID,
          type: "GET",
          dataType: "json",
          success: function(data) {
            let $itemselect = $('tbody[rel="binItems"]');
            $itemselect.empty();

            $.each(data, function(key, value) { 
              // appending the items table
              $itemselect.append('<tr><td rel="binMSerial">' + value.binMSerial +
                '</td><td rel="binUnitPrice">' + value.binUnitPrice +
                '</td><td rel="binQty">' + value.binQty  + '</td>' +
                '</td><td rel="binType">' + value.binType  + '</td>' +
                '</td><td rel="binBalance">' + value.binBalance + '</td></tr>');
            });
            // binding row click of table
            $itemselect.find("tr").on('click', function() {
              let $tr = $(this);
              $('input[name="grn"]').val($tr.find("[rel=binMSerial]")[0].innerHTML);
              $('input[name="unitprice"]').val($tr.find("[rel=binUnitPrice]")[0].innerHTML);
              $('input[name="type"]').val($tr.find("[rel=binType]")[0].innerHTML);
              $('input[name="balance"]').val($tr.find("[rel=binBalance]")[0].innerHTML);
            });

          }
        });
      }
    });
  });

  /**@abstract clear the input boxes related to returning item
   * 
   */
  function clearInputs() {
    $('input[name="grn"]').val('');
    $('input[name="unitprice"]').val('');
    $('input[name="balance"]').val('');
  }

  /**@abstract validating form befor submitting */
  function validateForm() {
    let currentBalance = $('input[name="balance"]').val();
    let returnQty = $('input[name="qty"]').val();
    if (+currentBalance < +returnQty) {
      alert("Returning quantity should not be greater than the respective received item's balance!");
      return false;
    }
  }
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
  $("#itemSelect").select2({
    placeholder: "--Select Consumable Item Name--",
    allowClear: true
  });
</script>


@endsection