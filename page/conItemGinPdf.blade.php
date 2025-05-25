<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','GIN - Consumable Items')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">
        
            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> Good Issued Note(GIN) - Consumable Items </h3>

            <br/>

            <div class="col-md-5" align="right">
            <a href="{{ url('conItemGinPdf/pdf')}}" class ="btn btn-danger"> Convert Into PDF</a></div>
            <br/><br/>

            <div class="row">
                <div class="table-responsive">
               
                    <table class="table table-striped table-bordered">
                        <?php $serial=''?>

                        @foreach($conGIN_data as $conGIN_data)
                            <?php $serial2 = $conGIN_data->binMSerial ?>
                           
                            @if ($serial!=$serial2) 
                                <thead>
                                    @if ($serial!='')
                                        <tr>
                                            <th colspan ="4"> Total Amount : </th>
			                    <th colspan ="1"><?php echo($total_Amount)?></th>
                                        </tr> 
                                    @endif 

                                    <tr>
                                        <th> <?php echo('Issue No : ') ?><?php echo($conGIN_data->cihMSerial) ?> </th>
                                        <th> <?php echo('Date : ') ?><?php echo($conGIN_data->binDate) ?> </th>
                                    </tr>

                                    <tr>
                                        <th> <?php echo('Employee : ') ?><?php echo($conGIN_data->empTitle) ?>
                                        <?php echo($conGIN_data->empInitials) ?> <?php echo($conGIN_data->empSurname) ?> </th>
                                        <th> <?php echo('Department : ') ?><?php echo($conGIN_data->deptCode) ?> 
                                        <?php echo($conGIN_data->deptName) ?> </th>
                                        <th> <?php echo('Project : ') ?><?php echo($conGIN_data->projDesc) ?> </th>
                                    </tr>
                                
                                    <th> No. </th>
                                    <th> Item Description </th>
                                    <th> Quantity </th>
                                    <th> Unit Price </th>
                                    <th> Price </th>

                                    <tr>
                                        <td> {{$conGIN_data->binSerial}} </td>
                                        <td> {{$conGIN_data->st_ConItem}} <?php echo('- ') ?> {{$conGIN_data->st_ConIDesc}} </td>
                                        <td> {{$conGIN_data->binQty}} </td>
                                        <td> {{$conGIN_data->binUnitPrice}} </td>
                                        <td> {{$conGIN_data->binUnitPrice * $conGIN_data->binQty}} </td>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <?php $serial = $conGIN_data->binMSerial; $total_Amount=0;?>
                                    <?php $total_Amount = $conGIN_data->binUnitPrice * $conGIN_data->binQty;?>

                                    @else
                                        <tr>
                                            <?php $total_Amount+=$conGIN_data->binUnitPrice * $conGIN_data->binQty; ?>
                                            <td> {{$conGIN_data->binSerial}} </td>
                                            <td> {{$conGIN_data->st_ConItem}} <?php echo('- ') ?> {{$conGIN_data->st_ConIDesc}} </td>
                                            <td> {{$conGIN_data->binQty}} </td>
                                            <td> {{$conGIN_data->binUnitPrice}} </td>
                                            <td> {{$conGIN_data->binUnitPrice * $conGIN_data->binQty}} </td>
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