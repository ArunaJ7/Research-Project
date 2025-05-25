<table>
    <thead>
        <th colspan="6" style="font-size: 18px;"><strong> Buddhist and Pali University of SriLanka</strong>
        </th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="6" style="font-size: 16px;">
                Goods Received Note(GRN) - Fixed Assets
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="4">
                Supplier: {{$fx_grn_data->supplier->Supplier ?? ''}}
            </td>
            <td colspan="4">GRN No : {{$fx_grn_data->GRN_No}}</td>

        </tr>
        <tr>
            <td colspan="4">
                Address: {{$fx_grn_data->supplier->supplier_address ?? ''}}
            </td>
            <td colspan="4">Date : {{date('Y-M-d', strtotime($fx_grn_data->date))}}</td>

        </tr>
    </tbody>
</table>

@if($fx_grn_data->grnRecords->isNotEmpty() && $fx_grn_data->grnRecords->count()>0 )
@php $totalPrice = 0 @endphp
<table class="table table-striped ">
    <thead class="thead-dark">
        <th><strong>Voucher/ PO</strong> </th>
        <th><strong>Receipt No</strong></th>
        <th><strong>Item Description</strong></th>
        <th><strong>Quantity</strong></th>
        <th><strong>Unit Price (Rs.)</strong></th>
        <th><strong>Price (Rs.)</strong></th>
    </thead>
    <tbody>
        <tr></tr>
        @foreach ($fx_grn_data->grnRecords as $item)
        @php $totalPrice += ($item->binQty * $item->binUnitPrice) @endphp
        <tr>
            <td>{{ $item->binVch_PO}}</td>
            <td>{{ $item->binRct}}</td>
            <td>{{$item->item->fh_FxHdr2. ' - '. $item->item->fh_Desc}}</td>
            <td class="text-center">{{ $item->binQty}}</td>
            <td style="text-align:right">{{number_format(($item->binUnitPrice),2,'.',',')}}</td>
            <td style="text-align:right">{{number_format(($item->binQty * $item->binUnitPrice),2,'.',',')}}</td>
        </tr>
        @endforeach
        <tr class="font-weight-bold">
            <td colspan="5" style="text-align:right"><strong>Total:</strong></td>
            <td style="text-align:right"><strong>{{number_format(($totalPrice),2,'.',',')}}</strong></td>
        </tr>
    </tbody>
</table>

<table>
    <tbody>
        <tr colspan="8">
        </tr>
        <tr>
            <td></td>
            <td colspan="7">I certify that the above items were received by the stores is in good condition.</td>

        </tr>
        <tr>

        </tr>
        <tr>
            <td></td>
            <td colspan="2">Date : {{($fx_grn_data->status === 1) ? date('Y-M-d', strtotime($fx_grn_data->approved_date)) : '' }}</td>
            <td></td>
            <td colspan="3">…..............................................................</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">..............................................................</td>
            <td></td>
            <td colspan="3">Storekeeper:</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">Checked and Approved by:</td>
            <td></td>
            <td colspan="3">{{(isset($fx_grn_data->creator) && isset($fx_grn_data->creator->namewithinitials))? $fx_grn_data->creator->namewithinitials : '' }}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            @if($fx_grn_data->status === 1)
            <td colspan="2"> {{(isset($fx_grn_data->approver) && isset($fx_grn_data->approver->namewithinitials))? $fx_grn_data->approver->namewithinitials : '' }}</td>
            @else
            <td colspan="2" style="color:red"> Approval pending...</td>
            @endif

            <td></td>
            <td colspan="3">..............................................................</td>
            <td></td>

        </tr>
        <tr>
            <td></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="3">Bursar</td>
            <td></td>
        </tr>

    </tbody>
</table>
@else( $IssuedItems->isEmpty())
<table>
    <tr>
        <td>This Page have no items available...!</td>
    </tr>
</table>
@endif