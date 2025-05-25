<table>
    <thead>
        <th colspan="5"><strong> Buddhist and Pali University of SriLanka</strong>
        </th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">
                <h3 style="text-decoration: underline"> Stock Value - Consumable Items </h3>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>

    </tbody>
</table>
@if( $conitems->isNotEmpty() && $conitems->count()>0 )
@php $totalPrice = 0 ;
$grandTotalPrice = 0 ;
$prevHrdCode = null;
$newCategory=true; 
$isfirstrow = true;
@endphp
<table>
    <thead style="background-color:#CCCCCC">
        <th style="background-color:#CCCCCC"><strong> Item Code</strong> </th>
        <th style="background-color:#CCCCCC"><strong>Item Description</strong></th>
        <th style="background-color:#CCCCCC"><strong>Quantity</strong></th>
        <th style="background-color:#CCCCCC"><strong>Unit Price</strong></th>
        <th style="background-color:#CCCCCC"><strong>Total Value</strong></th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        @foreach ($conitems as $item)
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
            <td colspan="4"  style="text-align:right;"><strong>Sub Total:</strong></td>
            <td class="text-right"><strong>{{number_format(($totalPrice),2,'.','')}}</strong></td>
        </tr>

        @php
        $totalPrice = 0 ;
        @endphp
        @endif
        <tr>
            <td colspan="5" style="font-weight:bold; text-align:center; background-color:#DDDDDD">{{$headers[$item->st_ConHdr]->ch_ConDesc}} </td>
        </tr>
        @endif
        @php
        $totalPrice += ($item->binUnitPrice * $item->binBalance);
        $grandTotalPrice += ($item->binUnitPrice * $item->binBalance);
        @endphp

        
        <tr>
            <td>{{$item->binItemCode}}</td>
            <td width="100%"> {{$item->st_ConIDesc}}</td>
            <td class="text-right">{{$item->binBalance}}</td>
            <td class="text-right">{{number_format(($item->binUnitPrice),2,'.','')}}</td>
            <td class="text-right">{{number_format(($item->binBalance * $item->binUnitPrice),2,'.','')}}</td>
        </tr>
        @php
        $isfirstrow = false;
        @endphp
        @endforeach
        <tr class="font-weight-bold">
            <td colspan="4"  style="text-align:right;" ><strong>Sub Total:</strong></td>
            <td  style="text-align:right;" ><strong>{{number_format(($totalPrice),2,'.','')}}</strong></td>
            <td></td>
        </tr>
        <tr class="font-weight-bold">
            <td colspan="4" style="text-align:right;"><strong>Total:</strong></td>
            <td  style="text-align:right;"><strong>{{number_format(($grandTotalPrice),2,'.','')}}</strong></td>
        </tr>
    </tbody>
</table>
@endif