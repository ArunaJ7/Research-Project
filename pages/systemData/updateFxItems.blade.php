<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Update Fixed Assets Item Details')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

        <h1> Fixed Assets Item Details</h1>
        <div class="row">
            <div class="col-md-12">
               
                <form action="{{url('/updateFxAstItems') }}" method="POST"> 
                {{csrf_field()}} 
                <br> </br>

                    <div class="form-group form-row">
                        <label for="rid" class="col-sm-3">ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="id" placeholder=" Fixed assests category details ID" name="id" value="{{$fxAstItemsData->id}}" Readonly>
                        </div>
                    </div>


                    <div class="form-group form-row">
                        <label class="col-sm-3" for="ch_ConHdr">Header</label>
                        <div class="col-sm-9">
                            <select class="form-control formselect required" id="heder" name="heder">
                                <!--To get that Header number-->
                                @foreach($headerData as $headerData)
                                    <option value="{{ucfirst($headerData->fh_FxHdr)}}" selected> 
                                        {{ucfirst($headerData->full_desc)}}
                                    </option>
                                @endforeach
                        
                                <!--To get the Header list-->
                                @foreach($header as $header)
                                    <option  value="{{$header->fh_FxHdr}}">
                                        {{ucfirst($header->full_desc)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-row" >
                        <label for="rtype"class="col-sm-3"> Catogery code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="catcode" placeholder="Edit Catogery code" name="catcode" value="{{$fxAstItemsData->fh_FxHdr2}}" required>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label for="rtype" class="col-sm-3"> Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="des" placeholder="Edit Description" name="des" value="{{$fxAstItemsData->fh_Desc}}" required>
                        </div>
                    </div>

                    <div class="form-group form-row" >  
                        <label for="rtype" class="col-sm-3"> Next No</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nextno" placeholder="Edit  Next No" name="nextno" value="{{$fxAstItemsData->fh_NextNo}}" readonly required>
                        </div>
                    </div>

                    <div class="form-group form-row" >  
                        <label for="rtype" class="col-sm-3"> Useful Life</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="uselife" placeholder="Edit Useful Life" name="uselife" value="{{$fxAstItemsData->fh_Life}}" required>
                        </div>
                    </div>

                    <div class="form-group form-row" >  
                        <label for="rtype" class="col-sm-3"> Depreciation Rate</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="desrate" placeholder="Edit Depreciation Rate" name="desrate" value="{{$fxAstItemsData->fh_Rate}}" required>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-3" for="input-applicant">Depreciation Method</label>
                        <div class="col-sm-9">
                            <select class="form-control formselect required" placeholder="Select Group" id="depmeth" name="depmeth" value="{{$fxAstItemsData->fh_Depnm}}" required>
                                <option value="S" >Straight line</option>
                                <option value="R" >Reducing Balance</option>
                                <option value="O" >Other</option> 
                            </select>
                        </div> 
                    </div>

                    </br>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </br> </br>     
                </form>
              
                
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