<table>
    <thead>
        <th colspan="8" rowspan="2" align="center"><strong>
                <h1>Buddhist and Pali University of SriLanka</h1>
            </strong></th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td> </td>
        </tr>
        <tr>
            <td colspan="8" rowspan="2" align="center">
                <h3> {{$title}} -</h3>
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
            </td>
        </tr>
        <tr>
            <td>
            </td>
        </tr>
    </tbody>
</table>
@if( $data->isNotEmpty() && $data->count()>0 )
@php $totalPrice = 0 ;
$grandTotalPrice = 0 ;@endphp
<table>
    <thead>
        <th style="background-color:#DDDDDD"> Date </th>
        <th style="background-color:#DDDDDD"> Issue Number </th>
        <th style="background-color:#DDDDDD"> Type </th>
        <th style="background-color:#DDDDDD"> Item Description </th>
        <th style="background-color:#DDDDDD"> Quantity </th>
        <th style="background-color:#DDDDDD"> Unit Price </th>
        <th style="background-color:#DDDDDD"> Value </th>
        <th style="background-color:#DDDDDD"> Remarks </th>
    </thead>
    <tbody>

        <tr>
            <td>
            </td>
        </tr>
        @php $newCategory=true; $isfirstrow = true; @endphp

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
        </tr>

        @php
        $totalPrice = 0 ;
        @endphp
        @endif
        <tr>
            <td colspan="8" style="font-weight:bold; text-align:center">{{$prevCategry}} </td>
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
            <td style="text-align:right;"> {{$data->binQty}} </td>
            <td style="text-align:right;"> {{number_format(($data->binUnitPrice),2,'.','')}} </td>
            <td style="text-align:right;"> {{number_format(($data->binUnitPrice * $data->binQty),2,'.','')}} </td>
            <td> {{$data->binRmks}} </td>
        </tr>

        @php
        $isfirstrow = false;
        @endphp
        @endforeach
        <tr class="font-weight-bold">
            <td colspan="6"  style="text-align:right;" class="text-right"><strong>Sub Total:</strong></td>
            <td  style="text-align:right;" class="text-right"><strong>{{number_format(($totalPrice),2,'.','')}}</strong></td>
            <td></td>
        </tr>
        <tr class="font-weight-bold">
            <td colspan="6"  style="text-align:right;"><strong>Total:</strong></td>
            <td class="text-right"><strong>{{number_format(($grandTotalPrice),2,'.','')}}</strong></td>
        </tr>
    </tbody>
</table>
@endif