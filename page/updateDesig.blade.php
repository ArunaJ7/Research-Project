@extends('layouts.mainlayout')

@section('title','Update Designation')

@section('content')

    <div class="container" id="container_designation">
      <div class="row" style="align:center">         
        <div class="col-md-12">
        
            <form  method="post" action="/updatedesignation">
            {{csrf_field()}}
            <br/><br/><br/><br/>
                  
                <input type="hidden" class="form-control" id="desigId" name="desigId" value="{{$singleDesigData->id}}" Readonly> 
                  
                <div class="form-group">
                    <label for="desigName">Designation Name</label>
                    <input type="text" class="form-control" id="desigName" name="desigName" value="{{$singleDesigData->designation}}" required> 
                </div>
                            
                <!-- <div class="form-group">
                    <label for="type">Designation Type</label>
                    <input type="text" class="form-control" id="type" name="type" value="{{$singleDesigData->desigtype}}" required>
                </div> -->

                <div class="form-group form-row">
                    <label class="col-sm-3" for="input-title">Designation Type</label>
                    <div class="col-sm-9" style="align:left">

                        <input type="radio" id="1" name="type" value="1" {{ $singleDesigData->desigtype == '1' ? 'checked' : '' }}>
                            <label for="academic">Academic</label><br>

                        <input type="radio" id="2" name="type" value="2" {{ $singleDesigData->desigtype == '2' ? 'checked' : '' }}>
                            <label for="nonacademic">Non-Academic</label><br>

                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                    
            </form>

        </div>
      </div>
    </div>

@endsection