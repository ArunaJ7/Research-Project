<table>
    <thead>
        <th colspan="14" rowspan="2" align="center"><strong><h1>Buddhist and Pali University of SriLanka</h1>
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
            <td colspan="14" rowspan="2" align="center" >
                <h3> Project Consummable Issues Item List Details -</h3>
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
                             From : {{$fromDate}}  To : {{$toDate}}
                        </span>
                @endswitch
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
@if( $stockItem->isNotEmpty() && $stockItem->count()>0 )
@php 
$totalPrice = 0 ;
$grandTotalPrice = 0 ;
$prevHrdCode = null;
$newCategory=true; 
$isfirstrow = true;
@endphp
<table>
    <thead>
        <th align="center" style="background-color:#CCCCCC"><strong>Date</strong> </th>
        <th align="center" style="background-color:#CCCCCC"><strong>Issue No</strong></th>
        <th align="center" style="background-color:#CCCCCC"><strong>Type</strong></th>
        <th align="center" style="background-color:#CCCCCC"><strong>Item Code</strong></th>
        <th align="center" style="background-color:#CCCCCC"><strong>Item Description</strong></th>
        <th align="center" style="background-color:#CCCCCC"><strong>Qty</strong></th>
        <th align="center" style="background-color:#CCCCCC"><strong>Unit Price</strong></th>
        <th align="center" style="background-color:#CCCCCC"><strong>Value</strong></th>
        <th align="center" style="background-color:#CCCCCC"><strong>Remarks</strong></th>
    </thead>
</table>
<table>
    <tbody>
        @foreach( $stockItem as $stockItem)
        @php
        if(!isset($prevCategry) || $prevCategry != $stockItem->st_ConHdr){
        $newCategory=true;

        } else {
        $newCategory = false;
        }
        $prevCategry = $stockItem->st_ConHdr;
        @endphp

        @if ($newCategory)
        @if(!$isfirstrow)
        <tr class="font-weight-bold">
            <td colspan="7"  style="text-align:right;"><strong>Sub Total:</strong></td>
            <td class="text-right"><strong>{{number_format(($totalPrice),2,'.','')}}</strong></td>
        </tr>

        @php
        $totalPrice = 0 ;
        @endphp
        @endif
        <tr>
            <td colspan="9" style="font-weight:bold; text-align:center; background-color:#DDDDDD">
            {{ isset($headers[$stockItem->st_ConHdr]) ? $headers[$stockItem->st_ConHdr]->ch_ConDesc : $stockItem->st_ConHdr}} </td>
        </tr>
        @endif
        @php
        $totalPrice += ($stockItem->binUnitPrice * $stockItem->binQty);
        $grandTotalPrice += ($stockItem->binUnitPrice * $stockItem->binQty);
        @endphp
        <tr>
            <td align="left">{{$stockItem->binDate}}</td>
            <td align="left">{{$stockItem->binMSerial}}</td>
            <td align="center">{{$stockItem->binType}}</td>
            <td align="left">{{$stockItem->st_ConItem}}</td>
            <td align="left">{{$stockItem->st_ConIDesc}}</td>
            <td align="right">{{$stockItem->binQty}}</td>
            <td align="right">{{number_format($stockItem->binUnitPrice,2)}}</td>
            <td align="right">{{number_format($stockItem->binQty * $stockItem->binUnitPrice,2)}}</td>
            <td>{{$stockItem->binRmks}}</td>
        </tr>
        @php
        $isfirstrow = false;
        @endphp
        @endforeach
        <tr class="font-weight-bold">
            <td colspan="7"  style="text-align:right;" ><strong>Sub Total:</strong></td>
            <td  style="text-align:right;" ><strong>{{number_format(($totalPrice),2,'.','')}}</strong></td>
            <td></td>
        </tr>
        <tr class="font-weight-bold">
            <td colspan="7" style="text-align:right;"><strong>Total:</strong></td>
            <td  style="text-align:right;"><strong>{{number_format(($grandTotalPrice),2,'.','')}}</strong></td>
        </tr>
    </tbody>
</table>
@endif