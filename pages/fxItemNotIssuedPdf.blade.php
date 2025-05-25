<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Fixed Asset Supplier Details')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">
        
            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> Fixed Asset Not Issued to Users </h3>

            <br/>

            <div class="col-md-5" align="right">
            <a href="{{ url('fxItemNotIssuedPdf/pdf')}}" class ="btn btn-danger"> Convert Into PDF</a></div>

            <div class="row">
                <div class="table-responsive">
               
                    <table class="table table-striped table-bordered">
                        <?php $category=''?>

                        @foreach($fxNotIssued_data as $fxNotIssued_data)
                            <?php $category2 = $fxNotIssued_data->fh_FxDesc ?>
                           
                            @if ($category!=$category2) 
                                <thead>
                                    <tr>
                                        <th> <?php echo($fxNotIssued_data->fh_FxDesc) ?> </th>
                                    </tr>
                                
                                    <th> GRN Date </th>
                                    <th> GRN No </th>
                                    <th> Grn Sub No </th>
                                    <th> Item Code
                                    <th> Item Name </th>
                                    <th> Unit Price </th>
                                    <th> Balance Units </th>

                                    <tr>
                                        <td> {{$fxNotIssued_data->binDate}} </td>
                                        <td> {{$fxNotIssued_data->binMSerial}} </td>
                                        <td> {{$fxNotIssued_data->binSerial}} </td>
                                        <td> {{$fxNotIssued_data->fh_FxHdr2}} </td>
                                        <td> {{$fxNotIssued_data->fh_Desc}} </td>
                                        <td> {{$fxNotIssued_data->binUnitPrice}} </td>
                                        <td> {{$fxNotIssued_data->binBalance}} </td>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <?php $category=$fxNotIssued_data->fh_FxDesc; ?>

                                    @else
                                        <tr>
                                            <td> {{$fxNotIssued_data->binDate}} </td>
                                            <td> {{$fxNotIssued_data->binMSerial}} </td>
                                            <td> {{$fxNotIssued_data->binSerial}} </td>
                                            <td> {{$fxNotIssued_data->fh_FxHdr2}} </td>
                                            <td> {{$fxNotIssued_data->fh_Desc}} </td>
                                            <td> {{$fxNotIssued_data->binUnitPrice}} </td>
                                            <td> {{$fxNotIssued_data->binBalance}} </td>
                                        </tr> 
                                    @endif
                        @endforeach      
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection