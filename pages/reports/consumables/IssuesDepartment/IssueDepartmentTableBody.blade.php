<h1> Buddhist and Pali University of SriLanka </h1>
<h3>Department Consummable Items Issued </h3>
<span class="status"> Department :{{$departmentDesc}} , Category : {{$maincategoryDesc}}, </span>

<?php
    $dateObj = DateTime::createFromFormat('!m', $month);
    $monthName = $dateObj->format('F');   
?>
@switch($radioy)
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
<br /><br />
<div class="row text-left">
    <div class="col-md-12">
        <div><u>{{$item_name}}</u></div>
    </div>
</div>
<div class="col-md-12 text-right">
    <a href="{{url('/reports/consumables/issuesDepartment-excel/'.$department.'/'.$itemCode.'/'.$subcategory
                .'/'.$year.'/'.$month.'/'.$radioy.'/'.$fromDate.'/'.$toDate)}}" class="btn btn-success"> Convert Into Excel</a>
</div>
<div class="row">
    <div class="col-md-12 pl-5 mt-5 text-left">
        <div class="table-responsive">
            @if( $data->isNotEmpty() && $data->count()>0 )
            @php $totalprice = 0 @endphp
            <table class="table table-striped ">
                <thead class="thead-dark">
                    <th>Date</th>
                    <th>Issue No</th>
                    <th>Type</th>
                    <th>Item Description</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Value</th>
                    <th>Remarks</th>
                </thead>
                <tbody>
                    @foreach ( $data as $item)
                    @php $totalprice += ($item->binQty * $item->binUnitPrice) @endphp
                    <tr>
                        <td>{{$item->binDate }} </td>
                        <td>{{$item->binMSerial}}</td>
                        <td>{{$item->binType}}</td>
                        <td>{{$item->st_ConItem.'  '.$item->st_ConIDesc}}</td>
                        <td class="text-right">{{$item->binQty}}</td>
                        <td class="text-right">{{number_format($item->binUnitPrice,2)}}</td>
                        <td class="text-right">{{number_format($item->binQty * $item->binUnitPrice,2)}}</td>
                        <td>{{$item->binRmks}}</td>
                    </tr>
                    @endforeach
                    <tr class="font-weight-bold">
                    <td colspan="06" class="text-right">Total :</td>
                        <td class="text-right">{{number_format($totalprice,2)}}</td>
                    </tr>
                </tbody>
            </table>
            @else( $data->isEmpty())
            <div class="alert alert-danger" role="alert">
            <p>This Page have no items available...!</p>
            </div>
            @endif
        </div>
    </div>
</div>
</div>