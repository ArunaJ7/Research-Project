<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Bin Card PDF')

@section('content')

<div class="container">
  <div class="row">
    <div class="container content-container">
      <h1> Bin Card Details</h1>
      <div class="row">
        <div class="col-md-12">
          <form action="{{url('/viewBinCardIndividualReport')}}" method="post">
            {{csrf_field()}}
            <!-- Nav pills -->
            <ul class="nav nav-pills justify-content-center pb-1 mb-4 border-bottom">
              <li class="nav-item">
                <a class="nav-link btn btn-light mr-2 active" data-toggle="pill" href="#home">Select</a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-light " data-toggle="pill" href="#menu1">Search</a>
              </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane container active" id="home">
                <div class="form-group form-row">
                  <label class="col-sm-3" for="categoryName"> Category Name </label>
                  <div class="col-sm-9">
                    <select class="form-control formselect required" placeholder="Select Category Name" id="categoryName" name="categoryName">
                      <option value="0" disabled selected>Select Category Name</option>
                      @foreach($categoryName as $categoryName)
                      <option value="{{$categoryName->ch_ConHdr}}">
                        {{ ucfirst($categoryName->ch_ConDesc) }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group form-row">
                  <label class="col-sm-3" for="itemName"> Item Name </label>
                  <div class="col-sm-9">
                    <select class="form-control formselect required" placeholder="Select Item Name" name="itemSelect">
                      <option value="0" disabled selected>Select Item Name</option>
                      
                    </select>
                  </div>
                </div>
              </div>
              <div class="tab-pane container fade" id="menu1">
                <div class="form-group form-row">
                  <label class="col-sm-3" for="itemName"> Item Name </label>
                  <div class="col-sm-9">
                    <select class="form-control formselect required" placeholder="Select Item Name" name="itemSearch">
                      <option value="0" disabled selected>Select Item Name</option>
                      @foreach($itemName as $item)
                      <option value="{{$item->st_ConItem}}">
                        {{ ucfirst($item->st_ConIDesc) }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <input type="hidden" name="itemName">
        <input type="submit" name="subBtn" id="sunBtn" class="btn btn-primary" value="View Report">
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('select[name="categoryName"]').on('change', function() {
      var categoryName = jQuery(this).val();
      if (categoryName) {
        jQuery.ajax({
          url: "{{url('/ajax/conItem')}}/" + categoryName,
          type: "GET",
          dataType: "json",
          success: function(data) {
            console.log(data);
            jQuery('select[name="itemSelect"]').empty();
            jQuery.each(data, function(key, value) {
              $('select[name="itemSelect"]').append('<option value="' + key + '">' + value + '</option>');
            });
          }
        });
      } else {
        $('select[name="itemSelect"]').empty();
      }
    });

    jQuery('select[name="itemSelect"]').on('change', function() {
      $('[name="itemName').val($(this).val())
    });

    $('select[name="itemSearch"]').select2({
      multiple: false,
      tags: true,
      width: '100%'
    });

    jQuery('select[name="itemSearch"]').on('change', function() {
      $('[name="itemName').val($(this).val())
    });
  });
</script>

@endsection