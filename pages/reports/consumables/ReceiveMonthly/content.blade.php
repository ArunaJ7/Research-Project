<h2> Buddhist and Pali University of SriLanka </h2>

<h3> Monthly Consumable Received Item Lists <br>
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

</h3>
<br />
<div class="col-md-12 text-left">
    <b><u> {{$ItemNoData}}</u></b>
</div>
<div class="col-md-12 text-right">
    <a href="{{url('/ReceivedMonthly/view/excel/'.$ItemNo.'/'.$year.'/'.$month.'/'.$valueOfDateCategory.'/'.$fromDate.'/'.$toDate)}}" class="btn btn-success"> Convert Into Excel</a>
</div>
<div class="row">
    <div class="col-md-12 pl-5   mt-5" style='text-align:left'>
        <div class="table-responsive">
            @if($receivedItem->isNotEmpty() && $receivedItem->count()>0 )
            @php $totalPrice = 0 @endphp
            <table class="table table-striped ">
                <thead class="thead-dark">
                    <th>Date</th>
                    <th>GRN No</th>
                    <th>Type</th>
                    <th>Item Code</th>
                    <th>Item Description</th>
                    <th>Supplier</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Value</th>
                    <th>Remarks</th>
                </thead>
                <tbody>
                    @foreach( $receivedItem as $receivedItem)
                    @php $totalPrice += ($receivedItem->binQty * $receivedItem->binUnitPrice) @endphp
                    <tr>
                        <td>{{$receivedItem->binDate}}</td>
                        <td>{{$receivedItem->GRN_No}}</td>
                        <td>{{$receivedItem->binType}}</td>
                        <td>{{$receivedItem->st_ConItem}}</td>
                        <td>{{$receivedItem->st_ConIDesc}}</td>
                        <td>{{$receivedItem->Supplier}}</td>
                        <td class="text-right">{{$receivedItem->binQty}}</td>
                        <td class="text-right">{{number_format($receivedItem->binUnitPrice,2)}}</td>
                        <td class="text-right">{{number_format($receivedItem->binQty * $receivedItem->binUnitPrice,2)}}</td>
                        <td>{{$receivedItem->binRmks}}</td>
                    </tr>
                    @endforeach
                    <tr class="font-weight-bold">
                        <td colspan="8" class="text-right">Total:</td>
                        <td class="text-right">{{number_format(($totalPrice),2)}}</td>
                    </tr>
                </tbody>
            </table>
            @else($receivedItem->isEmpty())
                <div class="alert alert-danger" role="alert">
                    No Item Avalable !
                </div>
            @endif
        </div>
    </div>
</div>
</div>