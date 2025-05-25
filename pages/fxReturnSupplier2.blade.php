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
                 
                
                <br><br>
                <form action="\updatefxIssuse" method="POST"> 
                {{csrf_field()}} 
                <br> </br>
                    <div class="form-group form-row">
                        <label for="rid" class="col-sm-3">ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="id" placeholder="Enter GRN No" name="id" value="{{$singleuserdata->id}}" Readonly>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label for="rid" class="col-sm-3">F/A Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxCode" placeholder="Enter GRN No" name="fxCode" value="{{$singleuserdata->fxCode}}" Readonly>
                        </div>
                    </div>
 
                    <div class="form-group form-row">
                        <label for="rid" class="col-sm-3">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxDept" placeholder="Enter GRN No." name="fxDept" value="{{$singleuserdata->fxDept}}" Readonly>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-3" for="input-applicant">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control formselect required" placeholder="Select Group" id="fxStatus" name="fxStatus" value="{{$singleuserdata->fxStatus}}" Readonly>
                
                                <option >R</option>
                                
                            </select>
                        </div> 
                    </div>

                    <div class="form-group form-row">
                        <label for="rid" class="col-sm-3">Return Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="fxRDate" placeholder="Enter Date" name="fxRDate"  >
                        </div>
                    </div>
                    <div class="form-group form-row" hidden>
                        <label for="rid" class="col-sm-3">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxGINNo" placeholder="Enter GRN No." name="fxGINNo" value="{{$singleuserdata->fxGINNo}}" Readonly>
                        </div>
                    </div>
                    <div class="form-group form-row" hidden>
                        <label for="rid" class="col-sm-3">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxGINSub" placeholder="Enter GRN No." name="fxGINSub" value="{{$singleuserdata->fxGINSub}}" Readonly>
                        </div>
                    </div>
                    <div class="form-group form-row" hidden>
                        <label for="rid" class="col-sm-3">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxGRN" placeholder="Enter GRN No." name="fxGRN" value="{{$singleuserdata->fxGRN}}" Readonly>
                        </div>
                    </div>
                    <div class="form-group form-row" hidden>
                        <label for="rid" class="col-sm-3">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxGRNSub" placeholder="Enter GRN No." name="fxGRNSub" value="{{$singleuserdata->fxGRNSub}}" Readonly>
                        </div>
                    </div>
                    <div class="form-group form-row" hidden>
                        <label for="rid" class="col-sm-3">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxHdr2" placeholder="Enter GRN No." name="fxHdr2" value="{{$singleuserdata->fxHdr2}}" Readonly>
                        </div>
                    </div>
                    <div class="form-group form-row" hidden>
                        <label for="rid" class="col-sm-3">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxUPFNo" placeholder="Enter GRN No." name="fxUPFNo" value="{{$singleuserdata->fxUPFNo}}" Readonly>
                        </div>
                    </div>
                    <div class="form-group form-row" hidden>
                        <label for="rid" class="col-sm-3">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxAmount" placeholder="Enter GRN No." name="fxAmount" value="{{$singleuserdata->fxAmount}}" Readonly>
                        </div>
                    </div>
                    <div class="form-group form-row" hidden>
                        <label for="rid" class="col-sm-3">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxIDate" placeholder="Enter GRN No." name="fxIDate" value="{{$singleuserdata->fxIDate}}" Readonly>
                        </div>
                    </div>
                    <div class="form-group form-row" hidden>
                        <label for="rid" class="col-sm-3">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxRmks" placeholder="Enter GRN No." name="fxRmks" value="{{$singleuserdata->fxRmks}}" Readonly>
                        </div>
                    </div>
                    <div class="form-group form-row" hidden>
                        <label for="rid" class="col-sm-3">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxSerialNo" placeholder="Enter GRN No." name="fxSerialNo" value="{{$singleuserdata->fxSerialNo}}" Readonly>
                        </div>
                    </div>
                    <div class="form-group form-row" hidden>
                        <label for="rid" class="col-sm-3">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxPhoto" placeholder="Enter GRN No." name="fxPhoto" value="{{$singleuserdata->fxPhoto}}" Readonly>
                        </div>
                    </div>
                    <div class="form-group form-row" hidden>
                        <label for="rid" class="col-sm-3">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fxSalvage" placeholder="Enter GRN No." name="fxSalvage" value="{{$singleuserdata->fxSalvage}}" Readonly>
                        </div>
                    </div>

                    <br> </br>

                    <button type="submit" class="btn btn-primary">Update</button >

                </form>
            </div>
        </div>     
      </div>
    </div>
</div>      
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<script>
$(document).ready(function(){
    $('.dynamic').change(function(){
        if($(this).val() != '')
        {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ route('fxreturnsupplier.fetch')}}",
                //url:'{[[URL::to('fetch')]]}',
                //url:"sto_fxreturnsupplier/fetch",
                method:"POST",
                data:{select:select,value:value,_token:_token,dependent:dependent},
                success:function(result)
                {
                    $('#' +dependent).html(result);

                }
            })
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