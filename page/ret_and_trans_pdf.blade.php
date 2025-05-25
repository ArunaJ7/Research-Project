<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Return and Transferred Items')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Return and Transferred Items </h1>
    <div class="col-md-5" align="right">
    <a href="{{ url('itemspdf/pdf')}}" class ="btn btn-danger"> Convert into pdf</a></div>
        <div class="row">
                <div class="table-responsive">
               
              
                
           
                <table class="table table-striped table-bordered">
                <thead>
                <tr>
                <th> F/A Code</th>
                <th> Issue Date</th>
                <th> Returned Date</th>
                <th> Division</th>
                
                </tr>
                </thead>
                <tbody>
                @foreach($st_trans as $sttrans_data)
                <tr>
                <td> {{$sttrans_data->fxCode}} </td>
                <td>  {{$sttrans_data->fxIDate}} </td>
                <td>  {{$sttrans_data->fxRDate}} </td>
                <td>  {{$sttrans_data->fxDept}} </td>
                
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