<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Fixed Assets Item Details')

@section('content')
<div class="container">
  <div class="row">
    <div class="container" id="faccontainer">

        <h1> Fixed Assets Item Details</h1>
        <div class="row">
            <div class="col-md-12">
               
                <form action="{{ url('/saveFxAstItems') }}" method="POST"> 
                {{csrf_field()}} 
                    <br/> </br>

                    <div class="form-group form-row">
                        <label class="col-sm-3" for="input-applicant">Header</label>
                        <div class="col-sm-9">
                            <select class="form-control formselect required" placeholder="Select Header" id="heder" name="heder">
                                <option value="0" disabled selected>Select Header</option>
                                @foreach($header as $header)
                                    <option  value="{{$header->fh_FxHdr}}">
                                        {{ ucfirst($header->fh_FxHdr.' - '.$header->fh_FxDesc) }}
                                    </option>
                                @endforeach
                            </select>
                        </div> 
                    </div> 

                    <div class="form-group form-row">
                        <label class="col-sm-3" for="input-">Item Code</label>
                        <div class="col-sm-9">
                            <input value="" class="form-control" type="text" name="catcode" placeholder="Enter Item Code" required="required" id="catcode">
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
                            <input value="0001" readonly class="form-control" type="number" name="nextno" placeholder="Enter Next No" required="required" id="nextno">
                        </div>
                    </div>
          
                    <div class="form-group form-row">
                        <label class="col-sm-3" for="input-">Useful Life</label>
                        <div class="col-sm-9">
                            <input value="" class="form-control" type="number" name="uselife" placeholder="Enter Useful Life" id="uselife">
                        </div>
                    </div>
                    
                    <div class="form-group form-row">
                        <label class="col-sm-3" for="input-">Depreciation Rate %</label>
                        <div class="col-sm-9">
                            <input value="" class="form-control" type="text" name="desrate" placeholder="Enter Depriciation Rate" id="desrate">
                        </div>
                    </div>
                    
                    <div class="form-group form-row">
                        <label class="col-sm-3" for="input-applicant">Depreciation Method</label>
                        <div class="col-sm-9">
                            <select class="form-control formselect" placeholder="Select Depreciation Method" id="depmeth" name="depmeth">      
                            <option value="0" disabled selected>Select Depreciation Method</option>
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

                <div class = "table-responsive">
                <h5 style="text-align:center"> Available Fixed Assets </h5>
                <table class="table table-dark">
                    <thead>
                        <td> Item Code </td>
                        <td> Item Name </td>
                    </thead>
                    <tbody rel="fxItems">

                    </tbody>
                </table>

                <h5 style="text-align:center"> Update Fixed Asset Details </h5>
                <table class="table table-dark">
                    <th> Header</th>
                    <th> Item Name</th>
                    <th> Description </th>
                    <th> Next No. </th>
            
                    @foreach($fxAstItems as $fxAstItems)
                        <tr>
                            <td> {{$fxAstItems->fh_FxHdr}} </td>
                            <td> {{$fxAstItems->fh_FxHdr2}} </td>
                            <td> {{$fxAstItems->fh_Desc}} </td>
                            <td> {{$fxAstItems->fh_NextNo}} </td>
                            <td>
                                <!--<a href="/Stores/public/deletefxAstItems/{{$fxAstItems->id}}" class="btn btn-danger">Delete</a> -->
                                <a href="{{url('/updatefxAstItemsView/'.$fxAstItems->id) }}" class="btn btn-warning">Update</a>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="heder"]').on('change', function() {
            var fxItem = $(this).val();
            $('tbody[rel="fxItems"]').empty();
            if (fxItem) {
                $.ajax({
                    url: '{{ url("/ajax/fxItems/") }}/' + fxItem,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        let $heder = $('tbody[rel="fxItems"]');
                        $heder.empty();
                        $.each(data, function(key, value) {
                            $heder.append('<tr><td>' + value.fh_FxHdr2 + 
                            '</td><td>' + value.fh_Desc + '</td></tr>');
                        });
                    }
                });
            } 
        });
    });
</script>

@endsection