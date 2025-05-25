<h1> Buddhist and Pali University of SriLanka </h1>
<h3> Goods Received Note(GRN) - Consumable Items </h3>

<br />
@if($grn->status === 1)
    <h6 class="text-left ml-4 alert alert-success font-weight-bold">GRN was approved
        by {{ $grn->approver->namewithinitials??'--' }}</h6>
@else
    <h6 class="text-left ml-4 alert alert-warning font-weight-bold">GRN approval pending...</h6>
@endif
<div class="col-md-12 text-right">
    <a href="{{ url('conItemGrnExcel',['grnNo'=>$grn->GRN_No])}}" class="btn btn-success"> Download as Excel</a>
</div>
<div class="row text-left">
    <div class="col-md-6 pl-5">
        <div> <span class="font-weight-bold">Supplier : </span> {{$supplier->Supplier}}</div>
        <div> <span class="font-weight-bold">Address : </span> {{ $supplier->Add1.' '.$supplier->Add2.' '.$supplier->Add3}}</div>
    </div>
    <div class="col-md-6 pl-5">
        <div> <span class="font-weight-bold">GRN No : </span> {{$grn->GRN_No}}</div>
        <div> <span class="font-weight-bold">Date : </span> {{ $grn->date}}</div>
        @php
            $receiptNo = '--';
            $voucherNo = '--';
            if($receivedItems->isNotEmpty() && $receivedItems->count()>0) {
                $receiptNo = $receivedItems[0]->binRct;
                $voucherNo = $receivedItems[0]->binVch_PO;
            }
        @endphp
        <div> <span class="font-weight-bold">Receipt No : </span> {{$receiptNo}}</div>
        <div> <span class="font-weight-bold">Voucher No : </span> {{$voucherNo}}</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 pl-5   mt-2" style='text-align:left'>
        <div class="table-responsive">
            @if( $receivedItems->isNotEmpty() && $receivedItems->count()>0 )
            @php $totalPrice = 0 @endphp
            <table class="table table-striped ">
                <thead class="thead-dark">

                    <th>No</th>
                    <th>Item Code</th>
                    <th>Item Description</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Price</th>
                </thead>
                <tbody>
                    @foreach ( $receivedItems as $item)
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
</div>