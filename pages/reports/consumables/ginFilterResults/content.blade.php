<h1> Buddhist and Pali University of SriLanka </h1>
<h3> Goods Issue Note(GIN) - Consumable Items </h3>
<br />
@if($gin->status === 1)
    <h6 class="text-left ml-4 alert alert-success font-weight-bold">GIN was approved
        by {{ $gin->approver->namewithinitials??'--' }}</h6>
@else
    <h6 class="text-left ml-4 alert alert-warning font-weight-bold">GIN approval pending...</h6>
@endif
<div class="col-md-12 text-right">
    <a href="{{ url('conItemGinExcel',['ginNo'=>$gin->cihMSerial])}}" class="btn btn-success"> Download as Excel</a>
</div>
<div class="row text-left mt-3">
    <div class="col-md-6 pl-5">
        <div> <span class="font-weight-bold"> Department : </span> {{ $vendor->deptName ?? ''}}</div>
        <div> <span class="font-weight-bold"> Employee : </span> {{$vendor->empTitle ?? '' }} {{$vendor->empInitials ?? ''}} {{$vendor->empSurname ?? ''}}</div>
        <div> <span class="font-weight-bold"> project : </span> {{ $vendor->projCode  ?? ''}} {{$vendor->projDesc ?? ''}}</div>
    </div>
    <div class="col-md-6 pl-5">
        <div> <span class="font-weight-bold">GIN No : </span> {{$gin->cihMSerial}}</div>
        <div><span class="font-weight-bold"> Date : </span> {{date('Y-M-d', strtotime($gin->cihDate))}}</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 pl-5   mt-2" style='text-align:left'>
        <div class="table-responsive">
            @if( $IssuedItems->isNotEmpty() && $IssuedItems->count()>0 )
            @php $totalPrice = 0 @endphp
            <table class="table table-striped">
                <thead class="thead-dark">
                    <th>No</th>
                    <th>Item Code</th>
                    <th>Item Description</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Price</th>
                </thead>
                <tbody>
                    @foreach ( $IssuedItems as $item)
                    @php $totalPrice += ($item->binUnitPrice * $item->binQty) @endphp
                    <tr>
                        <td>{{$item->binSerial}}</td>
                        <td>{{$item->binItemCode}}</td>
                        <td>{{$item->st_ConIDesc}}</td>
                        <td class="text-right">{{$item->binQty}}</td>
                        <td class="text-right">{{number_format(($item->binUnitPrice),2,'.',',')}}</td>
                        <td class="text-right">{{number_format(($item->binQty * $item->binUnitPrice),2,'.',',')}}</td>
                    </tr>
                    @endforeach
                    <tr class="font-weight-bold">
                        <td colspan="5" class="text-right">Total:</td>
                        <td class="text-right">{{number_format(($totalPrice),2,'.',',')}}</td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
