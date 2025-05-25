<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Consumable header details')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

<h1> Consumable Header details</h1>
<br/>
        <div class="row">
                <div class="col-md-12">
              
                <form method="post" action="{{ url('/saveconheader') }}">
                {{csrf_field()}}
               
            	    <div class="form-group form-row">
                	<label class="col-sm-3" for="input-st_ConIDesc">Header code</label>
                	    <div class="col-sm-9">
        			<input value="" class="form-control" type="text" name="header_code" placeholder="Enter Header Code" required="required" id="header_code">
              		    </div>
                    </div>

            	    <div class="form-group form-row">
                	<label class="col-sm-3" for="input-st_ConIDesc">Description</label>
                	    <div class="col-sm-9">
        		        <input value="" class="form-control" type="text" name="discription" placeholder="Enter Discription" required="required" id="discription">
              		    </div>
                    </div>
                
                    </br>
                    <input type="submit" class="btn btn-primary" value="SAVE">
                    <input type="reset" class="btn btn-warning" value="CLEAR">
                    </br> </br>     
                </form>
               
                <table class="table table-dark">
                <th style="text-align:left;">ID</th>
                <th style="text-align:left;">Header Code</th>
                <th style="text-align:left;">Description</th>
                
                @foreach($deptdata as $deptdata)
                	<tr>
                	    <td style="text-align:left;"> {{$deptdata->id}} </td>
                            <td style="text-align:left;"> {{$deptdata->ch_ConHdr}} </td>
                            <td style="text-align:left;"> {{$deptdata->ch_ConDesc}} </td>
                            <td>
    		                <!--<a href="/Stores/public/deleteconheader/{{$deptdata->id}}" class="btn btn-danger">Delete</a>-->
    		                <a href="{{ url('/updateconheader/'.$deptdata->id) }}" class="btn btn-warning">Update</a>
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
    }

    h1{
        text-align: center;
    }

</style>

@endsection
