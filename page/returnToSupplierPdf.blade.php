<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Return to Supplier')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">
        
            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> Return to Supplier </h3>

            <br/>

            <div class="col-md-5" align="right">
            <a href="{{ url('returnToSupplierPdf/pdf')}}" class ="btn btn-danger"> Convert Into PDF</a></div>

            <div class="row">
                <div class="table-responsive">
               
                    <table class="table table-striped table-bordered">
                        <?php $category=''?>

                        @foreach($returnToSupplier_data as $returnToSupplier_data)
                            <?php $category2 = $returnToSupplier_data->ch_ConHdr ?>
                           
                            @if ($category!=$category2) 
                                <thead>
                                    @if ($category!='')
                                        <tr>
                                            <th colspan ="4"> Total </th>
                                            <th colspan ="1"><?php echo($total_Amount)?></th> 
                                        </tr> 
                                    @endif 

                                    <tr>
                                        <th> <?php echo($returnToSupplier_data->ch_ConDesc) ?> </th>
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
                                        <td> {{$returnToSupplier_data->binDate}} </td>
                                        <td> {{$returnToSupplier_data->binMSerial}} </td>
                                        <td> {{$returnToSupplier_data->binType}} </td>
                                        <td> {{$returnToSupplier_data->st_ConItem}} </td>
                                        <td> {{$returnToSupplier_data->st_ConIDesc}} </td>
                                        <td> {{$returnToSupplier_data->binQty}} </td>
                                        <td> {{$returnToSupplier_data->binUnitPrice}} </td>
                                        <td> {{$returnToSupplier_data->binUnitPrice * $returnToSupplier_data->binQty}} </td>
                                        <td> {{$returnToSupplier_data->binRmks}} </td>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <?php $category=$returnToSupplier_data->ch_ConHdr;
                                    $total_Amount = 0;?>
                                    <?php $total_Amount = $returnToSupplier_data->binUnitPrice * $returnToSupplier_data->binQty; ?>
                     
                                    @else
                                        <?php $total_Amount += $returnToSupplier_data->binUnitPrice * $returnToSupplier_data->binQty; ?>
                                        <tr>
                                            <td> {{$returnToSupplier_data->binDate}} </td>
                                            <td> {{$returnToSupplier_data->binMSerial}} </td>
                                            <td> {{$returnToSupplier_data->binType}} </td>
                                            <td> {{$returnToSupplier_data->st_ConItem}} </td>
                                            <td> {{$returnToSupplier_data->st_ConIDesc}} </td>
                                            <td> {{$returnToSupplier_data->binQty}} </td>
                                            <td> {{$returnToSupplier_data->binUnitPrice}} </td>
                                            <td> {{$returnToSupplier_data->binUnitPrice * $returnToSupplier_data->binQty}} </td>
                                            <td> {{$returnToSupplier_data->binRmks}} </td>
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