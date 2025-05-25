<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Return To Supplier Items')

@section('content')

<div class="container">
    <div class="row">
      <div class="container" id="faccontainer">
  
        <h1>Return To Supplier Items</h1>

        

                <br><br>
                <table class="table table-dark">
                    <th> Id</th>
                    <th> fxGINNo</th>
                    <th> fxGINSub </th>
                    <th> fxGRN </th>
                    <th> fxGRNSub </th>
                    <th> fxCode </th>
                    <th> fxAmount </th>
                    <th> fxRDate</th>
                    
                    @foreach($fxItems as $fxItems)
                    <tr>
                        <td> {{$fxItems->id}} </td>
                        <td> {{$fxItems->fxGINNo}} </td>
                        <td> {{$fxItems->fxGINSub}} </td>
                        <td> {{$fxItems->fxGRN}} </td>
                        <td> {{$fxItems->fxGRNSub}} </td>
                        <td> {{$fxItems->fxCode}} </td>
                        <td> {{$fxItems->fxAmount}} </td>
                        <td> {{$fxItems->fxRDate}} </td>
                        <td>
                        {{csrf_field()}} 
                            <a href="/updatefxIssuseview/{{$fxItems->id}}" class="btn btn-warning">Select</a>
                        </td>
                    </tr>
                    @endforeach
                </table> 
                
                <br><br>
                
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