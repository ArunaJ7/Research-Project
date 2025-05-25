<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Consumer Items Details')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1>Consumable Item Details</h1>
        <div class="row">
                <div class="col-md-12">
               
                <form action="{{url('/save_sto_con_items')}}" method="POST"> 
                {{csrf_field()}}
                <br> </br>

 		<!-- Header-->               
                <div class="form-group form-row">
              	    <label class="col-sm-3" for="input-ch_ConHdr">Header</label>
                        <div class="col-sm-9">
                	    <select class="form-control formselect required" placeholder="Select header" id="header" name="header">
                                <option value="0" disabled selected>Select header</option>
                                @foreach($Header as $sto_header)
                                    <option  value="{{$sto_header->ch_ConHdr}}">
                                        {{ ucfirst($sto_header->ch_ConHdr.' - '.$sto_header->ch_ConDesc) }}
                                    </option>
                                @endforeach
                            </select>
                        </div> 
                </div> 

               <div class="form-group form-row">
                   <label class="col-sm-3" for="input-st_ConItem">Item no</label>
                       <div class="col-sm-9">
        	           <input value="" class="form-control" type="text" name="st_ConItem" placeholder="Enter Item number" required="required" id="st_ConItem" readonly>
                       </div>
               </div>
              
              <div class="form-group form-row">
                  <label class="col-sm-3" for="input-st_ConIDesc">Description</label>
                      <div class="col-sm-9">
                          <input value="" class="form-control" type="text" name="st_ConIDesc" placeholder="Enter Description" required="required" id="st_ConIDesc">  
                      </div>
              </div>
             
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-st_ConROL">Re-Order</label>
                <div class="col-sm-9">
                    <input value="" class="form-control" type="text" name="st_ConROL" placeholder="Enter Reorder" required="required" id="st_ConROL">
                </div>
              </div>

              </br>
                <input type="submit" class="btn btn-primary" value="ADD">
                <input type="reset" class="btn btn-warning" value="CLEAR">
                </br> </br>     
                </form>

                <table class="table table-dark">
                <th width="100"> Header Code</th>
                <th> Header</th>
                <th width="100"> Item No</th>
                <th> Description</th>
                <th> Re-Order Level</th>
              
                @foreach($con_items_details as $con_items)
                <tr>
                <td> {{$con_items->ch_ConHdr}} </td>
                <td> {{$con_items->ch_ConDesc}} </td>
                <td> {{$con_items->st_ConItem}} </td>
                <td> {{$con_items->st_ConIDesc}} </td>
                <td> {{$con_items->st_ConROL}} </td>
                <td>
                	<!-- <a href="/Stores/public/delete_data_con/{{$con_items->id}}" class="btn btn-danger">Delete</a>-->
                	<a href="{{ url('/updateconview/'.$con_items->id)}}" class="btn btn-warning">Update</a>     
                </td>
                </tr>
                @endforeach 
                </table>
                      
                </div>
        </div>

    </div>
  </div>
</div>

<style>
#faccontainer {
    text-align: left;
    /* margin-top: 100px;
    margin-bottom: 80px; */
}

h1{
    text-align: center;
}

</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="header"]').on('change', function() {
            var HeaderID = $(this).val();
            if (HeaderID) {
                $.ajax({
                    url: '{{ url("/ajax/con/next_item_code") }}/' + HeaderID,
                    type: "GET",
                    dataType: "text",
                    success: function(data) {
                        let $item = $('input[name="st_ConItem"]');
                        $item.val(data);
                    }
                });
            } else {
                $('input[name="st_ConItem"]').empty();
            }
        });
    });
</script>

@endsection