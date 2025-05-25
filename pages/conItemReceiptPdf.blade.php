<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Consumable Items Received')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">
        
            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> Annual Consumable Items Received </h3>

            <br/>

            <div class="col-md-5" align="right">
            <a href="{{ url('conItemReceiptPdf/pdf')}}" class ="btn btn-danger"> Convert Into PDF</a></div>

            <div class="row">
                <div class="table-responsive">
               
                    <table class="table table-striped table-bordered">
                        <?php $category=''?>

                        @foreach($conItemReceipt_data as $conItemReceipt_data)
                            <?php $category2 = $conItemReceipt_data->ch_ConHdr ?>
                           
                            @if ($category!=$category2) 
                                <thead>
                                    <tr>
                                        <th> <?php echo($conItemReceipt_data->ch_ConDesc) ?> </th>
                                    </tr>
                                
                                    <th> Date </th>
                                    <th> GRN No. </th>
                                    <th> Type </th>
                                    <th> Item Description </th>
                                    <th> Supplier </th>
                                    <th> Qty </th>
                                    <th> Unit Price </th>
                                    <th> Value </th>
                                    <th> Remarks </th>

                                    <tr>
                                        <td> {{$conItemReceipt_data->binDate}} </td>
                                        <td> {{$conItemReceipt_data->binMSerial}} </td>
                                        <td> {{$conItemReceipt_data->binType}} </td>
                                        <td> {{$conItemReceipt_data->st_ConItem}} <?php echo('- ') ?> {{$conItemReceipt_data->st_ConIDesc}} </td>
                                        <td> {{$conItemReceipt_data->Supplier}} </td>
                                        <td> {{$conItemReceipt_data->binQty}} </td>
                                        <td> {{$conItemReceipt_data->binUnitPrice}} </td>
                                        <td> {{$conItemReceipt_data->binUnitPrice * $conItemReceipt_data->binQty}} </td>
                                        <td> {{$conItemReceipt_data->binRmks}} </td>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <?php $category = $conItemReceipt_data->ch_ConHdr; ?>

                                    @else
                                        <tr>
                                            <td> {{$conItemReceipt_data->binDate}} </td>
                                            <td> {{$conItemReceipt_data->binMSerial}} </td>
                                            <td> {{$conItemReceipt_data->binType}} </td>
                                            <td> {{$conItemReceipt_data->st_ConItem}} <?php echo('- ') ?> {{$conItemReceipt_data->st_ConIDesc}} </td>
                                            <td> {{$conItemReceipt_data->Supplier}} </td>
                                            <td> {{$conItemReceipt_data->binQty}} </td>
                                            <td> {{$conItemReceipt_data->binUnitPrice}} </td>
                                            <td> {{$conItemReceipt_data->binUnitPrice * $conItemReceipt_data->binQty}} </td>
                                            <td> {{$conItemReceipt_data->binRmks}} </td>
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