 <!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Consumable Items Details Report')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Consumable Items Details Report</h1>
    <br></br>
    <div class="col-md-5" align="right">
    <a href="{{ url('conitemspdf/pdf')}}" class ="btn btn-danger"> Convert into pdf</a></div>
    <br></br>

        <div class="row">
                <div class="table-responsive">
               
                <table class="table table-striped table-bordered">
                <thead>
                <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Item No</th>
                <th>Description</th>
                <th>Re-Order</th>
                </tr>
                </thead>
                <tbody>
                @foreach($conitems_data as $conitems)
                <tr>
                <td>  {{$conitems->id}} </td>
                <td>  {{$conitems->st_ConHdr}} </td>
                <td>  {{$conitems->st_ConItem}} </td>
                <td>  {{$conitems->st_ConIDesc}} </td>
                <td>  {{$conitems->st_ConROL}} </td>
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