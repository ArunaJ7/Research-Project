<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title','GIN Fixed Assets')
@section('content')

<div class="container">
    <div class="row">
        <div id="faccontainer">

            <h1>Issued Fixed Asset Items</h1>
            <br />

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-dark">
                        <tr>
                            <th>FA Code</th>
                            <th>Item</th>
                            <th>GIN No</th>
                            <th>GIN Sub</th>
                            <th>Model S/N</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Remark</th>
                            <th>Salvage Value</th>
                            <th>Issued Date</th>
                            <th>Image</th>
                        </tr>
                        <tbody>
                            @foreach($gins as $gin)
                            <tr>
                                <td>
                                    {{ $gin->fxCode}}
                                </td>
                                <td>
                                    {{ $gin->fxHdr2}}
                                </td>
                                <td>
                                    {{ $gin->fxGINNo}}
                                </td>
                                <td>
                                    {{ $gin->fxGINSub}}
                                </td>
                                <td>
                                    {{ $gin->fxSerialNo}}
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    {{ $gin->fxDept}}
                                </td>
                                <td>
                                    {{ $gin->fxRmks}}
                                </td>
                                <td>
                                    {{ $gin->fxSalvage}}
                                </td>
                                <td>
                                    {{ $gin->fxIDate}}
                                </td>
                                <td>
                                    <img width="100%" id="display_image<?php echo  $gin->id;?>" style="height: 40px;width:40px; border-radius: 50%;" />
                                    <script>
                            @if("$gin->fxPhoto" != null)
                                document.getElementById('display_image<?php echo  $gin->id;?>').setAttribute("src", "{{ asset('fx_image/' . $gin->fxPhoto) }}");
                            @else
                                document.getElementById('display_image<?php echo  $gin->id;?>').setAttribute("src", "{{ asset('fx_image/' . 'contact-bg.jpg') }}");
                            @endif

                                    </script>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('layouts.messagePopup')
                    <br />
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #faccontainer {
        text-align: left;
    }

    h1 {
        text-align: center;
    }
</style>

@endsection
