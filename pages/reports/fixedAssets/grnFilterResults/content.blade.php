<h1> Buddhist and Pali University of SriLanka </h1>
<h3> Goods Received Note(GRN) - Fixed Assets </h3>

<br />

@if($fx_grn_data->status === 1)
    <h6 class="text-left ml-4 alert alert-success font-weight-bold">GRN was approved
        by {{ $fx_grn_data->approver->namewithinitials??'--' }}</h6>
@else
    <h6 class="text-left ml-4 alert alert-warning font-weight-bold">GRN approval pending...</h6>
@endif

<div class="col-md-12 text-right">
{{--    <a href="{{ url('conItemGinPdf/pdf')}}" class="btn btn-danger"> Convert Into PDF</a>--}}
    <a href="{{ url('/reports/fxItem/fxItemGrnExcel',['ginNo'=>$fx_grn_data->GRN_No])}}" class="btn btn-success"> Download as Excel</a>
</div>
<br><br>


<div class="row text-left">
    <div class="col-md-8 pl-5">
        <div> Supplier: {{$fx_grn_data->supplier->Supplier ?? ''}}</div>
        <div> Address:  {{$fx_grn_data->supplier->supplier_address ?? ''}}</div>
    </div>
    <div class="col-md-4 pl-5">
        <div> GRN No : {{$fx_grn_data->GRN_No}}</div>
        <div> Date : {{date('Y-M-d', strtotime($fx_grn_data->date))}}</div>

    </div>
</div>
<div class="row">
    <div class="col-md-12 pl-5   mt-5" style='text-align:left'>
        <div class="table-responsive">
            @if($fx_grn_data->grnRecords->isNotEmpty() && $fx_grn_data->grnRecords->count()>0 )
            @php $totalPrice = 0 @endphp
            <table class="table table-striped ">
                <thead class="thead-dark">
                    <th>Voucher/ PO </th>
                    <th>Receipt No</th>
                    <th>Item Description</th>
                    <th>Quantity</th>
                    <th>Unit Price (Rs.)</th>
                    <th>Price (Rs.)</th>
                </thead>
                <tbody>
                    @foreach ($fx_grn_data->grnRecords as $item)
                    @php $totalPrice += ($item->binQty * $item->binUnitPrice) @endphp
                    <tr>
                        <td>{{ $item->binVch_PO}}</td>
                        <td>{{ $item->binRct}}</td>
                        <td>{{$item->item->fh_FxHdr2. ' - '. $item->item->fh_Desc}}</td>
                        <td class="text-center">{{ $item->binQty}}</td>
                        <td class="text-right" >{{number_format(($item->binUnitPrice),2,'.',',')}}</td>
                        <td class="text-right" >{{number_format(($item->binQty * $item->binUnitPrice),2,'.',',')}}</td>
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
