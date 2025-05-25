<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','GRN - Consumable Items')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">
        
            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> Goods Received Note(GRN) - Consumable Items </h3>

            <br/>
            
            <div class="col-md-5" align="right">
            <a href="{{ url('conItemGrnPdf/pdf')}}" class ="btn btn-danger"> Convert Into PDF</a></div>
            <br/><br/>


            <div class="row">
                <div class="col-md-4" style='text-align:left'>
                    <?php $grn = ''?>
                    @foreach($conGRN_data as $data)
                        <?php $grn1 = $data->binMSerial ?>
                        @if($grn1 != '')
                            @if($grn != $grn1)
                                <li>
                                    <span> <?php echo('GRN No : ') ?><?php echo($data->binMSerial) ?> </span>
                                    <span> <?php echo('Supplier : ') ?><?php echo($data->Supplier) ?> </span>
                                </li>
                            @endif
                            <?php $grn = $grn1; ?>
                        @endif

                    @endforeach


                </div>
                <div class="col-md-8" style='text-align:left'>
                    <div class="row">
                        <div class="table-responsive">

                            <table class="table table-striped table-bordered">
                                <?php $grn=''?>

                                @foreach($conGRN_data as $conGRN_data)
                                    <?php $grn2 = $conGRN_data->binMSerial ?>

                                    @if ($grn!=$grn2)
                                        <thead>
                                            @if ($grn!='')
                                                <tr>
                                                    <th colspan ="5">Total</th>
                                                    <th colspan ="1"><?php echo($total_Amount)?></th>
                                                </tr>
                                            @endif
                                            <tr>
                                                <th> <?php echo('GRN No : ') ?><?php echo($conGRN_data->binMSerial) ?> </th>
                                                <th> <?php echo('Supplier : ') ?><?php echo($conGRN_data->Supplier) ?> </th>
                                                <th> <?php echo('Address : ') ?><?php echo($conGRN_data->Add1 )?>
                                                     <?php echo($conGRN_data->Add2)?> <?php echo($conGRN_data->Add3)?> </th>
                                                <th> <?php echo('Date : ') ?><?php echo($conGRN_data->binDate) ?> </th>
                                            </tr>


                                            <th> Voucher/PO </th>
                                            <th> Receipt No </th>
                                            <th> Item Description </th>
                                            <th> Quantity </th>
                                            <th> Unit Price </th>
                                            <th> Price </th>

                                            <tr style='text-align:left'>
                                                <td> {{$conGRN_data->binVch_PO}} </td>
                                                <td> {{$conGRN_data->binRct}} </td>
                                                <td> {{$conGRN_data->st_ConItem}} <?php echo('- ') ?> {{$conGRN_data->st_ConIDesc}} </td>
                                                <td> {{$conGRN_data->binQty}} </td>
                                                <td> {{$conGRN_data->binUnitPrice}} </td>
                                                <td> {{$conGRN_data->binUnitPrice * $conGRN_data->binQty}} </td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $grn=$conGRN_data->binMSerial; $total_Amount=0;?>
                                            <?php $total_Amount=$conGRN_data->binUnitPrice * $conGRN_data->binQty; ?>

                                            @else
                                                <tr style='text-align:left'>
                                                    <?php $total_Amount+=$conGRN_data->binUnitPrice * $conGRN_data->binQty; ?>
                                                    <td> {{$conGRN_data->binVch_PO}} </td>
                                                    <td> {{$conGRN_data->binRct}} </td>
                                                    <td> {{$conGRN_data->st_ConItem}} <?php echo('- ') ?> {{$conGRN_data->st_ConIDesc}} </td>
                                                    <td> {{$conGRN_data->binQty}} </td>
                                                    <td> {{$conGRN_data->binUnitPrice}} </td>
                                                    <td> {{$conGRN_data->binUnitPrice * $conGRN_data->binQty}} </td>
                                                </tr>
                                            @endif
                                @endforeach
                                <tr>
                                    <th colspan ="5"> Total Amount : </th>
                                    <th colspan ="1"><?php echo($total_Amount)?></th>
                                </tr>

                            </table>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
