<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Consumable Items Issued Details')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">
        
            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> Annual Consumable Items Issued Details </h3>

            <br/>

            <div class="col-md-5" align="right">
            <a href="{{ url('conItemIssuedPdf/pdf')}}" class ="btn btn-danger"> Convert Into PDF</a></div>
            <br/>
            
            <div class="row">
                <div class="table-responsive">
               
                    <table class="table table-striped table-bordered">
                        <?php $category=''?>

                        @foreach($conItemIssued_data as $conItemIssued_data)
                            <?php $category2 = $conItemIssued_data->ch_ConHdr ?>
                           
                            @if ($category!=$category2) 
                                <thead>
                                    <tr>
                                        <th> <?php echo($conItemIssued_data->ch_ConDesc) ?> </th>
                                    </tr>
                                
                                    <th> Date </th>
                                    <th> Issue Number </th>
                                    <th> Type </th>
                                    <th> Item Description </th>
                                    <th> Quantity </th>
                                    <th> Unit Price </th>
                                    <th> Value </th>
                                    <th> Remarks </th>

                                    <tr>
                                        <td> {{$conItemIssued_data->binDate}} </td>
                                        <td> {{$conItemIssued_data->binMSerial}} </td>
                                        <td> {{$conItemIssued_data->binType}} </td>
                                        <td> {{$conItemIssued_data->st_ConItem}} <?php echo('- ') ?> {{$conItemIssued_data->st_ConIDesc}} </td>
                                        <td> {{$conItemIssued_data->binQty}} </td>
                                        <td> {{$conItemIssued_data->binUnitPrice}} </td>
                                        <td> {{$conItemIssued_data->binUnitPrice * $conItemIssued_data->binQty}} </td>
                                        <td> {{$conItemIssued_data->binRmks}} </td>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <?php $category=$conItemIssued_data->ch_ConHdr; ?>

                                    @else
                                        <tr>
                                            <td> {{$conItemIssued_data->binDate}} </td>
                                            <td> {{$conItemIssued_data->binMSerial}} </td>
                                            <td> {{$conItemIssued_data->binType}} </td>
                                            <td> {{$conItemIssued_data->st_ConItem}} <?php echo('- ') ?> {{$conItemIssued_data->st_ConIDesc}} </td>
                                            <td> {{$conItemIssued_data->binQty}} </td>
                                            <td> {{$conItemIssued_data->binUnitPrice}} </td>
                                            <td> {{$conItemIssued_data->binUnitPrice * $conItemIssued_data->binQty}} </td>
                                            <td> {{$conItemIssued_data->binRmks}} </td>
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