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
                <h3> Stock Value - Consumable Items </h3>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">
                <u>{{$headers->ch_ConDesc}}</u>
            </td>
        </tr>
    </tbody>
</table>
@if( $conitems->isNotEmpty() && $conitems->count()>0 )
@php $totalPrice = 0 @endphp
<table>
    <thead>
        <th><strong> Item Code</strong> </th>
        <th><strong>Item Description</strong></th>
        <th><strong>Quantity</strong></th>
        <th><strong>Unit Price</strong></th>
        <th><strong>Total Value</strong></th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        @foreach ($conitems as $item)
        @php $totalPrice += ($item->binUnitPrice * $item->binBalance) @endphp
        <tr>
            <td>{{$item->binItemCode}}</td>
            <td width="100%"> {{$item->st_ConIDesc}}</td>
            <td class="text-right">{{$item->binBalance}}</td>
            <td class="text-right">{{number_format(($item->binUnitPrice),2,'.','')}}</td>
            <td class="text-right">{{number_format(($item->binBalance * $item->binUnitPrice),2,'.','')}}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
        </tr>
        <tr class="font-weight-bold">
            <td colspan="4" class="text-right"><strong>Total:</strong></td>
            <td class="text-right"><strong>{{number_format(($totalPrice),2,'.','')}}</strong></td>
        </tr>
    </tbody>
</table>
@endif