<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title', 'Qty Details')

@section('content')
    <div class="container">
        <div class="row">

            <div class="container" id="faccontainer">

                <h3> Material Quantity Details</h3>
                <div class="row">
                    <div class="col-md-12">

                        <form action="{{ url('saveqty') }}" method="Post">
                            {{ csrf_field() }}
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="input-amount">Item Code</label>
                                <div class="col-sm-9">

                                    <select class="form-control formselect required" placeholder="Select Item Code"
                                        id="itemcode" name="itemcode">

                                        <option value="0" disabled selected>Select Item Code*</option>
                                        @foreach ($data1 as $data1)
                                            <option value="{{ $data1->st_ConItem }}">
                                                {{ ucfirst($data1->st_ConItem) }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <label class="col-sm-3" for="input-agentcode">Required Quantity</label>
                                <div class="col-sm-9">

                                    <input value="" class="form-control" type="number" name="reqqty"
                                        placeholder="Enter Required Quantity" required="required" id="reqqty">
                                </div>
                            </div>

                            </br>
                            <input type="submit" class="btn btn-primary" value="SAVE">
                            <input type="button" class="btn btn-warning" value="CLEAR">
                            </br> </br>
                        </form>
                        <table class="table table-dark">
                            <th>ID</th>
                            <th>Item No.</th>
                            <th> Quantity</th>
                            <th> DATE</th>
                            @foreach ($data2 as $data2)
                                <tr>
                                    <td> {{ $data2->id }} </td>
                                    <td> {{ $data2->itemno }} </td>
                                    <td> {{ $data2->req_qty }} </td>
                                    <td> {{ $data2->updated_at }} </td>
                                </tr>
                                <tr></tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ url('mailPdf/pdf') }}" class="btn btn-danger"> Download as PDF</a>
                        <a href="{{ url('sendemail') }}" class="btn btn-danger">Send Mail</a>
                    </div>
                    <div class="col-md-6 ">
                        <div class="row justify-content-end mr-1">
                            <button class ="btn btn-danger"><a href="{{ url('mail') }}"
                                    class="text-white">Back</a></button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <style>
        #faccontainer {
            text-align: left;
            /* margin-top: 100px;
                            margin-bottom: 80px; */
        }

        h1 {
            text-align: center;
        }
    </style>
@endsection
