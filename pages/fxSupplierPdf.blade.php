<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Fixed Asset Supplier Details')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">
        
            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> Fixed Asset Supplier Details </h3>

            <br/>

            <div class="col-md-5" align="right">
            <a href="{{ url('fxSupplierPdf/pdf')}}" class ="btn btn-danger"> Convert Into PDF</a></div> 

            <div class="row">
                <div class="table-responsive">
               
                    <table class="table table-striped table-bordered">
                        <?php $category=''?>

                        @foreach($fxSupplier_data as $fxSupplier_data)
                            <?php $category2 = $fxSupplier_data->fh_FxDesc ?>
                           
                            @if ($category!=$category2) 
                                <thead>
                                    <tr>
                                        <th> <?php echo($fxSupplier_data->fh_FxHdr) ?> <?php echo(' : ') ?> <?php echo($fxSupplier_data->fh_FxDesc) ?>  </th>
                                    </tr>
                                
                                    <th> GRN No </th>
                                    <th> Fixed Asset Name </th>
                                    <th> Supplier </th>
                                    <th> Location Details </th>

                                    <tr>
                                        <td> {{$fxSupplier_data->binMSerial}} </td>
                                        <td> {{$fxSupplier_data->fh_Desc}} </td>
                                        <td> {{$fxSupplier_data->Supplier}} </td>
                                        <td> {{$fxSupplier_data->Add1}} {{$fxSupplier_data->Add2}} {{$fxSupplier_data->Add3}} </td>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <?php $category=$fxSupplier_data->fh_FxDesc; ?>

                                    @else
                                        <tr>
                                            <td> {{$fxSupplier_data->binMSerial}} </td>
                                            <td> {{$fxSupplier_data->fh_Desc}} </td>
                                            <td> {{$fxSupplier_data->Supplier}} </td>
                                            <td> {{$fxSupplier_data->Add1}} {{$fxSupplier_data->Add2}} {{$fxSupplier_data->Add3}} </td>
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