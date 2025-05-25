<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Supplier Report')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">
    <h1> Buddhist and Pali University of SriLanka </h1>
    <h3> Supplier List </h3>
    <div classs="row">
    <div class="col-md-12">
   <br />
    <div class="col-md-12 text-right" >
        <a href="{{ url('/reports/supplierDetails/')}}/{{$suppliers[0]->id}}" class="btn btn-success"> Download as Excel</a>
    </div>
   <br /><br />
<div class="row text-left">
    <div class="col-md-12">
 </div>
    </div>
        <div class="row">
         <div class="col-md-12 pl-5 mt-5" style='text-align:left'>
             <div class="table-responsive">
                <table class="table table-striped ">
                    <thead class="thead-dark">
                        <th>ID</th>
                        <th>Supplier Name</th>
                        <th>Supplier Address</th>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $supplier)
                        <tr>
                            <td>{{$supplier->id}}</td>
                            <td>{{$supplier->Supplier}}</td>
                            <td> {{$supplier->Add1}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
             </div>

        </div>
    </div>
</div>
</div>
@endsection
@section('script')
@endsection
