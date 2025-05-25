<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Fixed Assests Category Details')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Fixed Assests Category Details</h1>
        <div class="row">
                <div class="col-md-12">
               
                <form action="/Stores/public/fxastcatdet" method="POST"> 
                {{csrf_field()}} 
<br> </br>


                <div class="form-group form-row">
              <label class="col-sm-3" for="input-applicant">Header</label>
                <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Header" id="heder" name="heder">
                            <option value="0" disabled selected>Select Header</option>
                            @foreach($fixheaderdetail as $fixheaderdetails)
                            <option  value="{{$fixheaderdetails->id}}">
                                {{ ucfirst($fixheaderdetails->full_desc) }}</option>
                            @endforeach
                        </select>
                        </div> 
                        </div> 
                        <div class="form-group form-row">
                <label class="col-sm-3" for="input-">Category Code</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="catcode" placeholder="Category Code" required="required" id="catcode">

        
        
              </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-">Description</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="des" placeholder="Enter Description" required="required" id="des">

        
        
              </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-">Next No</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="nextno" placeholder="Enter Next No" required="required" id="nextno">

        
        
              </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-">Useful Life</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="uselife" placeholder="Enter Useful Life" required="required" id="uselife">

        
        
              </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-">Depreciation Rate %</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="desrate" placeholder="Enter Description Rate" required="required" id="desrate">
    
        
        
              </div>
              </div>
              <div class="form-group form-row">
              <label class="col-sm-3" for="input-applicant">Depreciation Method</label>
                <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Group" id="depmeth" name="depmeth">
                
                <option value="0" disabled selected>Select Header</option>
                            <option value="S" >Straight line</option>
                            <option value="R" >Reducing Balance</option>
                            <option value="O" >Other</option>

                          
                        </select>
                        </div> 
                        </div>

              
               
              
             
              </br>
                <input type="submit" class="btn btn-primary" value="SAVE">
                <input type="reset" class="btn btn-warning" value="CLEAR">
                </br> </br>     
                </form>
                <table class="table table-dark">
                <th>ID</th>
                <th> Header</th>
                <th> Code</th>
                <th> Description</th>
                <th> Next No</th>
                <th> Life</th>
                <th> Rate %</th>
                <th> Method</th>
                
                
                
                @foreach($sto_fxhdr2 as $sto_fxhdr2)
                <tr>
                <td> {{$sto_fxhdr2->id}} </td>
                <td> {{$sto_fxhdr2->fh_FxHdr}} </td>
                <td> {{$sto_fxhdr2->fh_FxHdr2}} </td>
                <td> {{$sto_fxhdr2->fh_Desc}} </td>
                <td> {{$sto_fxhdr2->fh_NextNo}} </td>
                <td> {{$sto_fxhdr2->fh_Life}} </td>
                <td> {{$sto_fxhdr2->fh_Rate}} </td>
                <td> {{$sto_fxhdr2->fh_Depnm}} </td>
                <td>
    			<a href="/Stores/public/deletefxAstCatDet/{{$sto_fxhdr2->id}}" class="btn btn-danger">Delete</a>
    			<a href="/Stores/public/updatefxAstCatDet/{{$sto_fxhdr2->id}}" class="btn btn-warning">Update</a>
    		</td>
                </tr>
                @endforeach       
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
@endsection