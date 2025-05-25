<table>
    <thead>
        <th colspan="8" rowspan="2" align="center"><strong>
                <h1>Buddhist and Pali University of SriLanka</h1>
            </strong>
        </th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td> </td>
        </tr>
        <tr>
            <td colspan="8" rowspan="3" align="center">
                <h3>  Consummable Issues Details for Departments </h3>
                <h5>Department :{{$departmentDesc}} , Category : {{$maincategoryDesc}}, </h5>
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
        <tr>
            <td>
            </td>
        </tr>
        <tr>
            <td align="left">
                {{$ItemNoData}}
            </td>
        </tr>
    </tbody>
</table>
@if( $data->isNotEmpty() && $data->count()>0 )
@php 
$totalPrice = 0 ;
$grandTotalPrice = 0 ;
$prevHrdCode = null;
$newCategory=true; 
$isfirstrow = true;
@endphp
<table class="table table-striped ">
    <thead class="thead-dark">
        <th style="background-color:#CCCCCC; font-weight:bold;">Date</th>
        <th style="background-color:#CCCCCC; font-weight:bold;">Issue No</th>
        <th style="background-color:#CCCCCC; font-weight:bold;">Type</th>
        <th style="background-color:#CCCCCC; font-weight:bold;">Item Description</th>
        <th style="background-color:#CCCCCC; font-weight:bold;">Qty</th>
        <th style="background-color:#CCCCCC; font-weight:bold;">Unit Price</th>
        <th style="background-color:#CCCCCC; font-weight:bold;">Value</th>
        <th style="background-color:#CCCCCC; font-weight:bold;">Remarks</th>
    </thead>
    <tbody>
        <tr>
            <td>
            </td>
        </tr>
        @foreach ( $data as $item)
        @php
        if(!isset($prevCategry) || $prevCategry != $item->st_ConHdr){
        $newCategory=true;

        } else {
        $newCategory = false;
        }
        $prevCategry = $item->st_ConHdr;
        @endphp
        @if ($newCategory)
        @if(!$isfirstrow)
        <tr class="font-weight-bold">
            <td colspan="6"  style="text-align:right;"><strong>Sub Total:</strong></td>
            <td class="text-right"><strong>{{number_format(($totalPrice),2,'.','')}}</strong></td>
        </tr>

        @php
        $totalPrice = 0 ;
        @endphp
        @endif
        <tr>
            <td colspan="8" style="font-weight:bold; text-align:center; background-color:#DDDDDD">
            {{ isset($headers[$item->st_ConHdr]) ? $headers[$item->st_ConHdr]->ch_ConDesc : $item->st_ConHdr}} </td>
        </tr>
        @endif
        @php
        $totalPrice += ($item->binUnitPrice * $item->binQty);
        $grandTotalPrice += ($item->binUnitPrice * $item->binQty);
        @endphp
        <tr>
            <td>{{$item->binDate }} </td>
            <td>{{$item->binMSerial}}</td>
            <td>{{$item->binType}}</td>
            <td>{{$item->st_ConItem.' - '.$item->st_ConIDesc}}</td>
            <td style="text-align:right">{{$item->binQty}}</td>
            <td style="text-align:right">{{number_format($item->binUnitPrice,2)}}</td>
            <td style="text-align:right">{{number_format($item->binQty * $item->binUnitPrice,2)}}</td>
            <td>{{$item->binRmks}}</td>
        </tr>
        @php
        $isfirstrow = false;
        @endphp
        @endforeach
        <tr class="font-weight-bold">
            <td colspan="6"  style="text-align:right;" ><strong>Sub Total:</strong></td>
            <td  style="text-align:right;" ><strong>{{number_format(($totalPrice),2,'.','')}}</strong></td>
            <td></td>
        </tr>
        <tr class="font-weight-bold">
            <td colspan="6" style="text-align:right;"><strong>Total:</strong></td>
            <td  style="text-align:right;"><strong>{{number_format(($grandTotalPrice),2,'.','')}}</strong></td>
        </tr>
    </tbody>
</table>
@else( $data->isEmpty())
<table>
    <tr>
        <td>This Page have no items available...!</td>
    </tr>
</table>
@endif