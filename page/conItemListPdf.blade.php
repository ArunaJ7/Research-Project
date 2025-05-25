<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','List of Consumable Items')

@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">
        
            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> List of Consumable Items </h3>

            <br/>

            <div class="col-md-5" align="right">
            <a href="{{ url('conItemListPdf/pdf')}}" class ="btn btn-danger"> Convert Into PDF</a></div>

            <div class="row">
                <div class="table-responsive">
               
                    <table class="table table-striped table-bordered">
                        <?php $category=''?>

                        @foreach($conItem_data as $conItem_data)
                            <?php $category2 = $conItem_data->ch_ConHdr ?>
                           
                            @if ($category!=$category2) 
                                <thead>
                                    <tr>
                                        <th> <?php echo($conItem_data->ch_ConDesc) ?> </th>
                                    </tr>
                                
                                    <th> Item Code </th>
                                    <th> Item Description </th>
                                    <th> Reorder Level </th>
                                    <th> Balance </th>

                                    <tr>
                                        <td> {{$conItem_data->st_ConItem}} </td>
                                        <td> {{$conItem_data->st_ConIDesc}} </td>
                                        <td> {{$conItem_data->st_ConROL}} </td>
                                        <td> {{$conItem_data->st_ConBalance}} </td>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <?php $category=$conItem_data->ch_ConHdr; ?>

                                    @else
                                        <tr>
                                            <td> {{$conItem_data->st_ConItem}} </td>
                                            <td> {{$conItem_data->st_ConIDesc}} </td>
                                            <td> {{$conItem_data->st_ConROL}} </td>
                                            <td> {{$conItem_data->st_ConBalance}} </td>
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