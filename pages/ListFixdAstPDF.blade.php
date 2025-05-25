<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','List of Fixed Assets Details Report')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> GRN - Fixed Assets Report</h1>
    <br></br>
    <div class="col-md-5" align="right">
    <a href="/ListFixdAstPDF/pdf" class ="btn btn-danger"> Convert into pdf</a></div>
    <br></br>

        <div class="row">
                <div class="table-responsive">
               
                <table class="table table-striped table-bordered">
                <thead>
                <tr>
               
                <th>Item Code</th>
                <th>Issue Date</th>
                <th>GRN No</th>
                <th>Item Description</th>
                <th>Departmenta</th>
                <th>Serial No</th>
                <th>Status</th>
                <th>Remark</th>
                <th>Amount</th>

                </tr>
                </thead>

                <tbody>
                    @foreach($listFxAst_data as $listFxAst_data_n)
                    <tr>
                    <td>  {{$listFxAst_data_n->fh_FxHdr}} </td>
                    <td>  {{$listFxAst_data_n->binDate}} </td>
                    <td>  {{$listFxAst_data_n->binMSerial}} </td>
                    <td>  {{$listFxAst_data_n->fh_FxDesc}} </td>
                    <td>  {{$listFxAst_data_n->dname}} </td>
                    <td>  {{$listFxAst_data_n->binSerial}} </td>
                    <td>  {{$listFxAst_data_n->binType}} </td>
                    <td>  {{$listFxAst_data_n->binRmks}} </td>
                    <td>  {{$listFxAst_data_n->binBalance}} </td>
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