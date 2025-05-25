<h2> Bhuddhist and Pali University of SriLanka </h2>
<h4> Verification Adjustments</h4>
<?php
$dateObj = DateTime::createFromFormat('!m', $month);
$monthName = $dateObj->format('F');
?>
@switch($valueOfDateCategory)
@case('VR')
<span class="status">
    Year : {{$year}} &nbsp &nbsp &nbsp Month : {{$monthName}}
</span>
@break

@case('VI')
<span class="status">
    Year : {{$year}}
</span>
@break

@default
<span class="status">
    From : {{$fromDate}} &nbsp &nbsp &nbsp To : {{$toDate}}
</span>
@endswitch


<br />
<div class="col-md-12 text-left">
    <b><u> {{$ItemNoData->ch_ConDesc}}</u></b>
</div>
<div class="col-md-12 text-right">
    <a href="{{url('/reports/consumables/Verficationadjestment-excel/'.$ItemNo.'/'.$year.'/'.$month.'/'.$valueOfDateCategory.'/'.$fromDate.'/'.$toDate)}}" class="btn btn-success"> Convert Into Excel</a>
</div>

<div class="row">
    <div class="col-md-12 pl-5   mt-5 text-left">
        <div class="table-responsive">
            @if($verifiItem->isNotEmpty() && $verifiItem->count()>0 )
            @php $totalPrice = 0 @endphp
            <table class="table table-striped ">
                <thead class="thead-dark">
                    <th>Item Description</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Amount</th>
                    <th class="text-center">Status</th>

                </thead>
                <tbody>
                    @foreach( $verifiItem as $verifiItem)
                    @php $totalPrice += ($verifiItem->binQty * $verifiItem->binUnitPrice) @endphp
                    <tr>
                        <td>{{$verifiItem->binItemCode}} {{$verifiItem->st_ConIDesc}}</td>
                        <td class="text-right">{{number_format($verifiItem->binUnitPrice,2)}}</td>
                        <td class="text-right">{{$verifiItem->binQty}}</td>
                        <td class="text-right">{{number_format($verifiItem->binQty * $verifiItem->binUnitPrice,2)}}</td>
                        <td class="text-center">{{$verifiItem->binType}}</td>
                    </tr>
                    @endforeach
                    <tr class="font-weight-bold">
                        <td colspan="3" class="text-right">Total:</td>
                        <td class="text-right">{{number_format(($totalPrice),2)}}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            @else($verifiItem->isEmpty())
            <div class="alert alert-danger" role="alert">
                No Item Avalable !
            </div>
            @endif
        </div>
    </div>
</div>
</div>