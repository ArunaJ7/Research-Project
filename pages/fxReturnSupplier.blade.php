<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Return To Supplier Items')

@section('content')

<div class="container">
    <div class="row">
      <div class="container" id="faccontainer">
  
        <h1>Return To Supplier Items</h1>

        <br/>

        <div class="row">
            <div class="col-md-12">

                <form action="/fxreturnsupplier" method="POST">
                {{csrf_field()}}
                    
                    <div class="form-group form-row">
                        <label class="col-sm-2" for="header">Header *</label>
                        <div class="col-sm-9">
                            <select class="form-control" placeholder="Select Header" id="header" name="header" required="required">
                                <option selected="false"> --Select Fixed Asset Header Desctiption-- </option>
                           	@foreach($header as $key => $value)
                    		    <option  value="{{ $key }}">
                      			{{ $value }}
                    		    </option>
                  		@endforeach
                            </select>
                        </div> 
                    </div>

		    <!-- Item -->
            	    <div class="form-group form-row">
              		<label class="col-sm-2" for="item">Item Description</label>
              		<div class="col-sm-9">
                		<select class="form-control" placeholder="Select Fixed Asset Item" id="item" name="item" required="required">
                  			<option value="">--Select Fixed Asset Desctiption--</option>
                		</select>
             	 	</div>
            	    </div>

                    {{csrf_field()}}

                    <br/>

                    <input type="submit" class="btn btn-primary" value="SAVE">
                    <input type="reset" class="btn btn-warning" value="CLEAR">

                    <br/><br/> 
                    
                </form>

                <form action="/searchGIN" method="GET">
                {{csrf_field()}}

                    
                    <div class="form-group form-row">
                        <label class="col-sm-2" for="qty">Number</label>
                        <div class="col-sm-9">
                            <input value="" class="form-control" type="text" name="query" placeholder="Enter Issue Number"  id="ph_qty">
                        </div>
                    </div>
                
                    <br/>

                    <button type="submit" class="btn btn-primary">Search</button>
                    
                    <br/><br/> 
                    
                </form>

                <br><br>
                      
            </div>
        </div>     
      </div>
    </div>
</div>     

<script type="text/javascript">
  jQuery(document).ready(function ()
  {
    jQuery('select[name="header"]').on('change',function(){
      var HeaderID = jQuery(this).val();
      if(HeaderID)
      {
        jQuery.ajax({
          url : 'fxreturnsupplier/view_fxAstItem_data/'+HeaderID,
          type : "GET",
          dataType : "json",
          success:function(data)
          {
            console.log(data);
            jQuery('select[name="item"]').empty();
            jQuery.each(data, function(key,value){
              $('select[name="item"]').append('<option value="'+ key +'">'+ value +'</option>');
            });
          }
        });
      }
      else
      {
        $('select[name="item"]').empty();
      }
    });
  });
</script>

<style>
    #faccontainer {
        text-align: left;
    }

    h1{
        text-align: center;
    }
</style>

@endsection