<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title',$titleTxt)
@section('content')
<div class="container">
    <div class="row">
        <div class="container" id="faccontainer">

            <h1> Buddhist and Pali University of SriLanka </h1>
            <h3> {{$titleTxt}}</h3>
            <?php
                $dateObj = DateTime::createFromFormat('!m', $month);
                $monthName = $dateObj->format('F');
                ?>
                @switch($valueOfDateCategory)
                @case('VR')
                <span class="status">
                    Year : {{$year}} , Month : {{$monthName}}
                </span>
                @break

                @case('VI')
                <span class="status">
                    Year : {{$year}}
                </span>
                @break

                @default
                <span class="status">
                    From : {{$fromDate}} To : {{$toDate}}
                </span>
                @endswitch
            <br />

            <div class="col-md-12 text-right">
                <a href="{{ url($excelPathPref.$year.'/'.$month.'/'.$valueOfDateCategory.'/'.($fromDate == '-1' || $fromDate == null ? '-1' : $fromDate).
            '/'.($toDate == '-1' || $toDate == null ? '-1' : $toDate))}}" class="btn btn-success"> Convert Excel</a>
            </div>
            <br />

            <div class="row text-left">
                <div class="table-responsive">

                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <th> Date </th>
                            <th> Issue Number </th>
                            <th> Type </th>
                            <th > Item Description </th>
                            <th class="text-right" > Quantity </th>
                            <th class="text-right" > Unit Price </th>
                            <th class="text-right" > Value </th>
                            <th> Remarks </th>
                        </thead>
                        @php $newCategory=true;
                        $totalPrice = 0 ;
                        $grandTotalPrice = 0 ;
                        $isfirstrow = true;
                        @endphp
                        @foreach($data as $data)
                        @php
                       
                        if(!isset($prevCategry) || $prevCategry != $data->ch_ConDesc){
                            $newCategory=true;
                        } else {
                            $newCategory = false;
                        }
                        $prevCategry = $data->ch_ConDesc;
                        @endphp

                        @if ($newCategory)
                        @if(!$isfirstrow)
                        <tr class="font-weight-bold">
                            <td colspan="6" class="text-right"><strong>Sub Total:</strong></td>
                            <td class="text-right"><strong>{{number_format(($totalPrice),2,'.','')}}</strong></td>
                            <td></td>
                        </tr>
                        @php
                        $totalPrice = 0 ;
                        @endphp
                        @endif
                        <tr>
                            <td colspan="8" class="text-center font-weight-bold">{{$prevCategry}} </td>
                        </tr>
                        @endif
                        @php
                        $totalPrice += ($data->binUnitPrice * $data->binQty);
                        $grandTotalPrice += ($data->binUnitPrice * $data->binQty);
                        @endphp
                        <tr>
                            <td> {{$data->binDate}} </td>
                            <td> {{$data->binMSerial}} </td>
                            <td> {{$data->binType}} </td>
                            <td> {{$data->st_ConItem.' - '.$data->st_ConIDesc}}</td>
                            <td class="text-right" > {{$data->binQty}} </td>
                            <td class="text-right" > {{number_format(($data->binUnitPrice),2,'.','')}} </td>
                            <td  class="text-right" > {{number_format(($data->binUnitPrice * $data->binQty),2,'.','')}} </td>
                            <td> {{$data->binRmks}} </td>
                        </tr>
                        @php
                        $isfirstrow = false;
                        @endphp
                        @endforeach
                        <tr class="font-weight-bold">
                            <td colspan="6" class="text-right"><strong>Sub Total:</strong></td>
                            <td class="text-right"><strong>{{number_format(($totalPrice),2,'.','')}}</strong></td>
                            <td></td>
                        </tr>
                        <tr class="font-weight-bold">
                            <td colspan="6" class="text-right"><strong>Total:</strong></td>
                            <td class="text-right"><strong>{{number_format(($grandTotalPrice),2,'.','')}}</strong></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection