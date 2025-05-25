<h1> Buddhist and Pali University of SriLanka </h1>
<h3> Stock Verification - Consumable Items </h3>

<br />

<div class="col-md-12 text-right">
    <a href="{{ url('conItemstockVerificationExcel',['ItemNo'=>$item_no->st_ConHdr])}}" class="btn btn-success"> Download as Excel</a>
</div>
<div class="row text-left mt-3">
    <div class="col-md-12">
        <div><b>{{$item_name[0]->ch_ConDesc}}</b> - Stock Verification for Consummable Items for the Year {{ date('Y') }} </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 pl-5 mt-2" style='text-align:left'>
        <div class="table-responsive">
            @if( $stockItem->isNotEmpty() && $stockItem->count()>0 )
            @php $totalPrice = 0 @endphp
            <table class="table table-striped ">
                <thead class="thead-dark">
                    <tr>
                        <th rowspan="2"> Item Description </th>
                        <th colspan="2"> Store Count </th>
                    </tr>
                    <tr>
                        <th class="text-right"> Qty </th>
                        <th class="text-right"> Value </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $stockItem as $item)
                    @php $totalPrice += ($item->binUnitPrice * $item->binBalance) @endphp
                    <tr>
                        <td>{{$item->binItemCode }} {{ $item->st_ConIDesc}}</td>
                        <td class="text-right">{{$item->binBalance}}</td>
                        <td class="text-right">{{number_format(($item->binBalance * $item->binUnitPrice),2,'.',',')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

        </div>
    </div>
</div>
</div>