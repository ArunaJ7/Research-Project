<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Consumable Items Details Report')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Count of Number of Items - Report</h1>
    <br></br>
    <div class="col-md-5" align="right">
    <a href="/CountItemsGRNfixdastPDF/pdf" class ="btn btn-danger"> Convert into pdf</a></div>
    <br></br>

        <div class="row">
                <div class="table-responsive">
               
                <table class="table table-striped table-bordered">
                <thead>
                <tr>
                <th>Item Description</th>
                <th>No of Items</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($CountgrnFxAst_data as $CountgrnFxAst_data2)
                    <tr>
                    <td>  {{$CountgrnFxAst_data2->full_desc}} </td>
                    <td>  {{$CountgrnFxAst_data2->binQty}} </td>
                </tr>
                @endforeach
                </tbody>
                </table>
               
                
                <td>
      
    </td>

    
   
               
               
                </div>
        </div>




    </div>

  </div>

</div>
@endsection 