<h2> Buddhist and Pali University of SriLanka </h2>
<h3> Project Consumable Issues Item Lists <br> </h3>
{{$project != '-1'? 'Project : '.$projectDesc : ''}},
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

<br />
<div class="col-md-12 text-left">
    <b><u> {{$ItemNoData}}</u></b>
</div>
<div class="col-md-12 text-right">
    <a href="{{url('/project-issues/view/excel/'.$project.'/'.$ItemNo.'/'.$year.'/'.$month.'/'.$valueOfDateCategory.'/'.$fromDate.'/'.$toDate)}}" class="btn btn-success"> Convert Into Excel</a>
</div>
<div class="row">
    <div class="col-md-12 pl-5   mt-5" style='text-align:left'>
        <div class="table-responsive">
            @if($stockItem->isNotEmpty() && $stockItem->count()>0 )
            @php $totalPrice = 0 @endphp
            <table class="table table-striped ">
                <thead class="thead-dark">
                    <th>Date</th>
                    <th>Issue No</th>
                    <th>Type</th>
                    <th>Item Code</th>
                    <th>Item Description</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Value</th>
                    <th>Remarks</th>
                </thead>
                <tbody>
                    @foreach( $stockItem as $stockItem)
                    @php $totalPrice += ($stockItem->binQty * $stockItem->binUnitPrice) @endphp
                    <tr>
                        <td>{{$stockItem->binDate}}</td>
                        <td>{{$stockItem->binMSerial}}</td>
                        <td>{{$stockItem->binType}}</td>
                        <td>{{$stockItem->st_ConItem}}</td>
                        <td>{{$stockItem->st_ConIDesc}}</td>
                        <td class="text-right">{{$stockItem->binQty}}</td>
                        <td class="text-right">{{number_format($stockItem->binUnitPrice,2)}}</td>
                        <td class="text-right">{{number_format($stockItem->binQty * $stockItem->binUnitPrice,2)}}</td>
                        <td>{{$stockItem->binRmks}}</td>
                    </tr>
                    @endforeach
                    <tr class="font-weight-bold">
                        <td colspan="7" class="text-right">Total:</td>
                        <td class="text-right">{{number_format(($totalPrice),2)}}</td>
                    </tr>
                </tbody>
            </table>
            @else($stockItem->isEmpty())
                <div class="alert alert-danger" role="alert">
                    No Item Avalable !
                </div>
            @endif
        </div>
    </div>
</div>
</div>