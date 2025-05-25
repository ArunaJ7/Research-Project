<table>
    <thead>
        <th colspan="10" rowspan="2" align="center"><strong><h1>Buddhist and Pali University of SriLanka</h1></strong></th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td> </td>
        </tr>
        <tr>
            <td colspan="10" rowspan="2" align="center" >
                <h3> Monthly Received Item List Details -</h3>
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
            <td>
                {{$ItemNoData}}
            </td>
        </tr>
    </tbody>
</table>
@if( $receivedItem->isNotEmpty() && $receivedItem->count()>0 )
@php 
$totalPrice = 0 ;
$grandTotalPrice = 0 ;
$prevHrdCode = null;
$newCategory=true; 
$isfirstrow = true;
@endphp
<table>
    <thead>
        <th align="center"><strong>Date</strong> </th>
        <th align="center"><strong>GRN No</strong></th>
        <th align="center"><strong>Type</strong></th>
        <th align="center"><strong>Item Code</strong></th>
        <th align="center"><strong>Item Description</strong></th>
        <th align="center"><strong>Supplier</strong></th>
        <th align="center"><strong>Qty</strong></th>
        <th align="center"><strong>Unit Price</strong></th>
        <th align="center"><strong>Value</strong></th>
        <th align="center"><strong>Remarks</strong></th>
    </thead>
</table>
<table>
    <tbody>
        @foreach( $receivedItem as $receivedItem)
        @php
        if(!isset($prevCategry) || $prevCategry != $receivedItem->st_ConHdr){
        $newCategory=true;

        } else {
        $newCategory = false;
        }
        $prevCategry = $receivedItem->st_ConHdr;
        @endphp

        @if ($newCategory)
        @if(!$isfirstrow)
        <tr class="font-weight-bold">
            <td colspan="8"  style="text-align:right;"><strong>Sub Total:</strong></td>
            <td class="text-right"><strong>{{number_format(($totalPrice),2,'.','')}}</strong></td>
        </tr>

        @php
        $totalPrice = 0 ;
        @endphp
        @endif
        <tr>
            <td colspan="10" style="font-weight:bold; text-align:center; background-color:#DDDDDD">
            {{ isset($headers[$receivedItem->st_ConHdr]) ? $headers[$receivedItem->st_ConHdr]->ch_ConDesc : $receivedItem ->st_ConHdr}} </td>
        </tr>
        @endif
        @php
        $totalPrice += ($receivedItem->binUnitPrice * $receivedItem->binQty);
        $grandTotalPrice += ($receivedItem->binUnitPrice * $receivedItem->binQty);
        @endphp
        <tr>
            <td align="left">{{$receivedItem->binDate}}</td>
            <td align="left">{{$receivedItem->GRN_No}}</td>
            <td align="center">{{$receivedItem->binType}}</td>
            <td align="left">{{$receivedItem->st_ConItem}}</td>
            <td align="left">{{$receivedItem->st_ConIDesc}}</td>
            <td align="left">{{$receivedItem->Supplier}}</td>
            <td align="right">{{$receivedItem->binQty}}</td>
            <td align="right">{{number_format($receivedItem->binUnitPrice,2)}}</td>
            <td align="right">{{number_format($receivedItem->binQty * $receivedItem->binUnitPrice,2)}}</td>
            <td>{{$receivedItem->binRmks}}</td>
        </tr>
        @php
        $isfirstrow = false;
        @endphp
        @endforeach
        <tr class="font-weight-bold">
            <td colspan="8"  style="text-align:right;" ><strong>Sub Total:</strong></td>
            <td  style="text-align:right;" ><strong>{{number_format(($totalPrice),2,'.','')}}</strong></td>
            <td></td>
        </tr>
        <tr class="font-weight-bold">
            <td colspan="8" style="text-align:right;"><strong>Total:</strong></td>
            <td  style="text-align:right;"><strong>{{number_format(($grandTotalPrice),2,'.','')}}</strong></td>
        </tr>
    </tbody>
</table>
@endif