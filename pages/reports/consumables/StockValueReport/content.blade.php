<h1> Buddhist and Pali University of SriLanka </h1>
<h3> Stock Value - Consumable Items </h3>

<br />

<div class="col-md-12 text-right" >
    <a href="{{ url('/reports/conItem/StockReport/exportToExcel/'.$headers->ch_ConHdr)}}" class="btn btn-success"> Download as Excel</a>
</div>

<div class="row text-left">
    <div class="col-md-6 pl-5">
    <div>{{$headers->ch_ConDesc}}</div>
    </div>
</div>
    <div class="row">
    <div class="col-md-12 pl-5   mt-3" style='text-align:left'>
            <div class="table-responsive">

            @if( $conitems->isNotEmpty() && $conitems->count()>0 )
                @php $totalPrice = 0 @endphp
                <table class="table table-striped ">
                    <thead class="thead-dark">
                        <th>Item Code</th>
                        <th>Item Description</th>
                        <th class="text-right">Quantity</th>
                        <th class="text-right">Unit Price</th>
                        <th class="text-right">Total Value</th>
                    </thead>
                    <tbody>
                        @foreach ($conitems as $item)
                        @php $totalPrice += ($item->binUnitPrice * $item->binBalance) @endphp
                        <tr>
                            <td>{{$item->binItemCode}}</td>
                            <td>{{$item->st_ConIDesc}}</td>
                            <td class="text-right">{{$item->binBalance}}</td>
                            <td class="text-right">{{number_format(($item->binUnitPrice),2,'.',',')}}</td>
                            <td class="text-right">{{number_format(($item->binBalance * $item->binUnitPrice),2,'.',',')}}</td>
                        </tr>
                        @endforeach
                        <tr class="font-weight-bold">
                            <td colspan="4" class="text-right">Total:</td>
                            <td class="text-right">{{number_format(($totalPrice),2,'.',',')}}</td>
                        </tr>
                    </tbody>
                </table>
                @endif

            </div>
        </div>
    </div>
</div>

