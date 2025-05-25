<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Bin Card - All')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">
        
            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> Bincard(All) Details </h3>

            <br/>

            <div class="col-md-5" align="right">
            <a href="{{ url('AllBinCardPdf/pdf')}}" class ="btn btn-danger"> Convert Into PDF</a></div>

            <div class="row">
                <div class="table-responsive">
               
                    <table class="table table-striped table-bordered">
                        <?php $item=''?>

                        @foreach($bincardAll_data as $bincardAll_data)
                            <?php $item2 = $bincardAll_data->st_ConItem ?>
                           
                            @if ($item!=$item2) 
                                <thead>
                                    <tr>
                                        <th> <?php echo($bincardAll_data->st_ConItem); echo('  '); echo( $bincardAll_data->st_ConIDesc) ?> </th>
                                    </tr>
                                
                                    <th> Date </th>
                                    <th> Type </th>
                                    <th> Reference </th>
                                    <th> Quantity </th>
                                    <th> Unit Price </th>
                                    <th> Value </th>
                                    <th> Balance </th>
                                    <th> Remarks </th>

                                    <tr>
                                        <td> {{$bincardAll_data->binDate}} </td>
                                        <td> {{$bincardAll_data->binType}} </td>
                                        <td> {{$bincardAll_data->binRct}} </td>
                                        <td> {{$bincardAll_data->binQty}} </td>
                                        <td> {{$bincardAll_data->binUnitPrice}} </td>
                                        <td> {{$bincardAll_data->binUnitPrice * $bincardAll_data->binQty}} </td>
                                        <td> {{$bincardAll_data->binBalance}} </td>
                                        <td> {{$bincardAll_data->binRmks}} </td>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <?php $item=$bincardAll_data->st_ConItem; ?>

                                    @else
                                        <tr>
                                            <td> {{$bincardAll_data->binDate}} </td>
                                            <td> {{$bincardAll_data->binType}} </td>
                                            <td> {{$bincardAll_data->binRct}} </td>
                                            <td> {{$bincardAll_data->binQty}} </td>
                                            <td> {{$bincardAll_data->binUnitPrice}} </td>
                                            <td> {{$bincardAll_data->binUnitPrice * $bincardAll_data->binQty}} </td>
                                            <td> {{$bincardAll_data->binBalance}} </td>
                                            <td> {{$bincardAll_data->binRmks}} </td>
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