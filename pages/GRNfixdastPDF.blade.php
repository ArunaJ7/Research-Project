<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Consumable Items Details Report')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> GRN - Fixed Assets Report</h1>
    <br></br>
    <div class="col-md-5" align="right">
    <a href="/GRNfixdastPDF/pdf" class ="btn btn-danger"> Convert into pdf</a></div>
    <br></br>

        <div class="row">
                <div class="table-responsive">
               
                <table class="table table-striped table-bordered">
                <thead>
                <tr>
               
                <th>Voucher/PO</th>
                <th>Receipt No</th>
                <th>Item Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($grnFxAst_data as $grnFxAst_data2)
                    <tr>
                    <td>  {{$grnFxAst_data2->binVch_PO}} </td>
                    <td>  {{$grnFxAst_data2->binRct}} </td>
                    <td>  {{$grnFxAst_data2->full_desc}} </td>
                    <td>  {{$grnFxAst_data2->binQty}} </td>
                    <td>  {{$grnFxAst_data2->binUnitPrice}} </td>
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