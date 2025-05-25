<table>
    <thead>
        <th colspan="5" rowspan="2" align="center"><strong>
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
            <td colspan="5" rowspan="2" align="center">
                <h3> Verification Adjustments </h3>
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
                {{$ItemNoData!= null ? $ItemNoData->ch_ConDesc : ''}}
            </td>
        </tr>
    </tbody>
</table>
@if($verifiItem->isNotEmpty() && $verifiItem->count()>0 )
@php $totalPrice = 0 @endphp
<table class="table table-striped ">
    <thead class="thead-dark">
        <th  style="background-color:#DDDDDD; font-weight:bold;">Item Description</th>
        <th  style="background-color:#DDDDDD; font-weight:bold;">Unit Price</th>
        <th  style="background-color:#DDDDDD; font-weight:bold;">Qty</th>
        <th  style="background-color:#DDDDDD; font-weight:bold;">Amount</th>
        <th  style="background-color:#DDDDDD; font-weight:bold;">Status</th>

    </thead>
    <tbody>
        <tr>
            <td>
            </td>
        </tr>
        @foreach( $verifiItem as $verifiItem)
        @php $totalPrice += ($verifiItem->binQty * $verifiItem->binUnitPrice) @endphp
        <tr>
            <td>{{$verifiItem->binItemCode}} {{$verifiItem->st_ConIDesc}}</td>
            <td style="text-align:right">{{number_format($verifiItem->binUnitPrice,2)}}</td>
            <td style="text-align:right">{{$verifiItem->binQty}}</td>
            <td style="text-align:right">{{number_format($verifiItem->binQty * $verifiItem->binUnitPrice,2)}}</td>
            <td >{{$verifiItem->binType}}</td>
        </tr>
        @endforeach
        <tr style="font-weight:bold">
            <td colspan="3" style="text-align:right;font-weight:bold">Total:</td>
            <td style="text-align:right;font-weight:bold">{{number_format(($totalPrice),2)}}</td>
            <td></td>
        </tr>
    </tbody>
</table>
@else($verifiItem->isEmpty())
<table>
    <tr>
        <td>
            No Item Avalable !
        </td>
    </tr>
</table>
@endif