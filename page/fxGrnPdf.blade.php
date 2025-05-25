<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Fixed Asset - GRN')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">
        
            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> Goods Received Note(GRN) - Fixed Asset </h3>

            <br/>

            <div class="col-md-5" align="right">
            <a href="{{ url('fxGrnPdf/pdf')}}" class ="btn btn-danger"> Convert Into PDF</a></div>
            <br/><br/>

            <div class="row">
                <div class="table-responsive">
               
                    <table class="table table-striped table-bordered">
                        <?php $serial=''?>

                        @foreach($fxGRN_data as $fxGRN_data)
                            <?php $serial2 = $fxGRN_data->Supplier ?>
                        
                            @if ($serial!=$serial2) 

                                <thead>
                                    <tr>
                                        <th> <?php echo('GRN No : ') ?><?php echo($fxGRN_data->binMSerial) ?> </th>
                                        <th> <?php echo('Supplier : ') ?><?php echo($fxGRN_data->Supplier) ?> </th>
                                        <th> <?php echo('Address : ') ?><?php echo($fxGRN_data->Add1 )?> 
                                             <?php echo($fxGRN_data->Add2 )?> <?php echo($fxGRN_data->Add3)?> </th>
                                        <th> <?php echo('Date : ') ?><?php echo($fxGRN_data->binDate) ?> </th>
                                    </tr>

                                    <th> Voucher/PO </th>
                                    <th> Receipt No </th>
                                    <th> Item Description </th>
                                    <th> Quantity </th>
                                    <th> Unit Price </th>
                                    <th> Price </th>

                                    <tr>
                                        <td> {{$fxGRN_data->binVch_PO}} </td>
                                        <td> {{$fxGRN_data->binRct}} </td>
                                        <td> {{$fxGRN_data->fh_FxHdr2}} <?php echo('- ') ?> {{$fxGRN_data->fh_Desc}} </td>
                                        <td> {{$fxGRN_data->binQty}} </td>
                                        <td> {{$fxGRN_data->binUnitPrice}} </td>
                                        <td> {{$fxGRN_data->binUnitPrice * $fxGRN_data->binQty}} </td>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <?php $serial=$fxGRN_data->Supplier; ?>

                                    @else
                                        <tr>
                                            <td> {{$fxGRN_data->binVch_PO}} </td>
                                            <td> {{$fxGRN_data->binRct}} </td>
                                            <td> {{$fxGRN_data->fh_FxHdr2}} <?php echo('- ') ?> {{$fxGRN_data->fh_Desc}} </td>
                                            <td> {{$fxGRN_data->binQty}} </td>
                                            <td> {{$fxGRN_data->binUnitPrice}} </td>
                                            <td> {{$fxGRN_data->binUnitPrice * $fxGRN_data->binQty}} </td>
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