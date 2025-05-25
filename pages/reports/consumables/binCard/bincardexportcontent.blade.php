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
                <h3> Bin Card Items (individual) - Consumable Items </h3>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">
                <u> {{$headers->st_ConIDesc}} </u>
            </td>
        </tr>
    </tbody>
</table>
@if(  $bincard_data != null && $bincard_data->count()>0 )
@php $totalPrice = 0 @endphp
<table>
    <thead>
        <th><strong> Date</strong> </th>
        <th><strong>Type</strong></th>
        <th><strong>Reference</strong></th>
        <th><strong>Quantity</strong></th>
        <th><strong>Unit Price</strong></th>
        <th><strong>Value</strong></th>
        <th><strong>Balance</strong></th>
        <th><strong>Remarks</strong></th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        @php $totalVal = -1 @endphp
            @foreach($bincard_data as $item)
            <tr>
                @php 
                if($totalVal == -1) {
                    $totalVal =  $item->totalValue ;
                } 
                $leftParanthesis = $item->binType != 'R' ? '(' : '';
                $rightParanthesis = $item->binType != 'R' ? ')' : '';
                @endphp
                <td> {{ $item->binDate }} </td>
                <td> {{ $item->binType }} </td>
                <td> {{ $item->binMSerial }} </td>
                <td style="text-align:right"> {{ $leftParanthesis.$item->binQty.$rightParanthesis }} </td>
                <td style="text-align:right"> {{ $item->binUnitPrice }} </td>
                <td style="text-align:right"> {{ $leftParanthesis.number_format(($item->binQty * $item->binUnitPrice),2,'.',',').$rightParanthesis}} </td>
                <td style="text-align:right"> {{ $item->totalBalance}}</td>
                <td> {{ $item->binRmks }} </td>
            </tr>
            @endforeach
        <tr>
            <td></td>
        </tr>
        <tr style="font-weight:bold">
            <td colspan="5" style="text-align:right"><strong>Total:</strong></td>
            <td style="text-align:right"><strong>{{number_format(($totalVal),2,'.','')}}</strong></td>
        </tr>
    </tbody>
</table>
@endif