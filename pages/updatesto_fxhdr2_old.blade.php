<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Fixed Assests category Details')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Fixed Assests Category Details</h1>
        <div class="row">
                <div class="col-md-12">
               
                <form action="/Stores/public/updatefxastcat" method="POST"> 
                {{csrf_field()}} 

                <div class="form-group form-row">
                          <label for="rid" class="col-sm-3">Fixed Assests Category Details ID</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="id" placeholder=" Fixed assests category details ID" name="id" value="{{$sto_fxhdr2->id}}" Readonly>
                          </div>
                      </div>

                <div class="form-group form-row">
              <label class="col-sm-3" for="input-applicant">Header</label>
                <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Header" id="heder" name="heder">
                            <option value="0" disabled selected>Select Header</option>
                            @foreach($fixheaderdetail as $fixheaderdetails)
                            <option  value="{{$fixheaderdetails->	id}}">
                                {{ ucfirst($fixheaderdetails->codess) }}</option>
                            @endforeach
                        </select>
                        </div> 
                        </div> 
                        <div class="form-group form-row" >
                          <label for="rtype"class="col-sm-3"> Catogery code</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="catcode" placeholder="Edit Catogery code" name="catcode" value="{{$sto_fxhdr2->fh_FxHdr2}}" required>
                          </div>
                      </div>

                      <div class="form-group form-row">
                     
                          <label for="rtype" class="col-sm-3"> Description</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="des" placeholder="Edit Description" name="des" value="{{$sto_fxhdr2->fh_Desc}}" required>
                          </div>
                      </div>

                      <div class="form-group form-row" >
                      
                          <label for="rtype" class="col-sm-3"> Next No</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="nextno" placeholder="Edit  Next No" name="nextno" value="{{$sto_fxhdr2->fh_NextNo}}" required>
                  </div>
                      </div>

                      <div class="form-group form-row" >
                      
                          <label for="rtype" class="col-sm-3"> Useful Life</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="uselife" placeholder="Edit Useful Life" name="uselife" value="{{$sto_fxhdr2->fh_Life}}" required>
                  </div>
                      </div>

                      <div class="form-group form-row" >
                      
                          <label for="rtype" class="col-sm-3"> Depreciation Rate</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="desrate" placeholder="Edit Depreciation Rate" name="desrate" value="{{$sto_fxhdr2->	fh_Rate}}" required>
                  </div>
                      </div>

              <div class="form-group form-row">
              <label class="col-sm-3" for="input-applicant">Depreciation Method</label>
                <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Group" id="depmeth" name="depmeth" value="{{$sto_fxhdr2->fh_Depnm	}}" required>
                
                <option value="0" disabled selected>Select Header</option>
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

