<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','List of Consumable Items')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">
        
            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> Consumable Items - Return to Stores </h3>

            <br/>

            <div class="col-md-5" align="right">
            <a href="{{ url('returnToStoresPdf/pdf')}}" class ="btn btn-danger"> Convert Into PDF</a></div>

            <div class="row">
                <div class="table-responsive">
               
                    <table class="table table-striped table-bordered">
                        <?php $category=''?>

                        @foreach($returnToStores_data as $returnToStores_data)
                            <?php $category2 = $returnToStores_data->ch_ConHdr ?>
                           
                            @if ($category!=$category2) 
                                <thead>
                                    <tr>
                                        <th> <?php echo($returnToStores_data->ch_ConDesc) ?> </th>
                                    </tr>
                                
                                    <th> Date </th>
                                    <th> Issue Number </th>
                                    <th> Type </th>
                                    <th> Item Code </th>
                                    <th> Item Description </th>
                                    <th> Quantity </th>
                                    <th> Unit Price </th>
                                    <th> Value </th>
                                    <th> Remarks </th>

                                    <tr>
                                        <td> {{$returnToStores_data->binDate}} </td>
                                        <td> {{$returnToStores_data->binMSerial}} </td>
                                        <td> {{$returnToStores_data->binType}} </td>
                                        <td> {{$returnToStores_data->st_ConItem}} </td>
                                        <td> {{$returnToStores_data->st_ConIDesc}} </td>
                                        <td> {{$returnToStores_data->binQty}} </td>
                                        <td> {{$returnToStores_data->binUnitPrice}} </td>
                                        <td> {{$returnToStores_data->binUnitPrice * $returnToStores_data->binQty}} </td>
                                        <td> {{$returnToStores_data->binRmks}} </td>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <?php $category=$returnToStores_data->ch_ConHdr; ?>

                                    @else
                                        <tr>
                                            <td> {{$returnToStores_data->binDate}} </td>
                                            <td> {{$returnToStores_data->binMSerial}} </td>
                                            <td> {{$returnToStores_data->binType}} </td>
                                            <td> {{$returnToStores_data->st_ConItem}} </td>
                                            <td> {{$returnToStores_data->st_ConIDesc}} </td>
                                            <td> {{$returnToStores_data->binQty}} </td>
                                            <td> {{$returnToStores_data->binUnitPrice}} </td>
                                            <td> {{$returnToStores_data->binUnitPrice * $returnToStores_data->binQty}} </td>
                                            <td> {{$returnToStores_data->binRmks}} </td>
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