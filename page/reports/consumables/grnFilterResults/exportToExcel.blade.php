<table class="waffle" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td colspan="8" style="font-size: 18px;"><strong>Buddhist and Pali University of SriLanka</strong></td>
        </tr>
        <tr>
            <td colspan="8" style="font-size: 16px;">Goods Received Note(GRN) - Consumable Items</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="4">
                Supplier: {{$grn->supplier->Supplier ?? ''}}
            </td>
            <td colspan="4">GRN No : {{$grn->GRN_No}}</td>

        </tr>
        <tr>
            <td colspan="4">
                Address: {{($grn->supplier->Add1 ?? '').' '.($grn->supplier->Add2 ?? '').' '.($grn->supplier->Add3 ?? '')}}
            </td>
            <td colspan="4">Date : {{date('Y-M-d', strtotime($grn->date))}}</td>

        </tr>
        @php
            $receiptNo = '--';
            $voucherNo = '--';
            if($receivedItems->isNotEmpty() && $receivedItems->count()>0) {
                $receiptNo = $receivedItems[0]->binRct;
                $voucherNo = $receivedItems[0]->binVch_PO;
            }
        @endphp
        <tr>
            <td colspan="4">
            Receipt No :  {{$receiptNo}}
            </td>
            <td colspan="4">Voucher No : {{$voucherNo}}</td>
        </tr>
        <tr>
        </tr>
    </tbody>
</table>

@if( $receivedItems->isNotEmpty() && $receivedItems->count()>0 )
@php $totalPrice = 0 @endphp
<table>
    <thead>

        <th style="background-color: #343a40;color: #ffffff;"><strong> No</strong></th>
        <th style="background-color: #343a40;color: #ffffff;"><strong>Item Code</strong></th>
        <th style="background-color: #343a40;color: #ffffff;"><strong>Item Description</strong></th>
        <th style="background-color: #343a40;color: #ffffff;text-align:right;"><strong>Qty</strong></th>
        <th style="background-color: #343a40;color: #ffffff;text-align:right;"><strong>Unit Price</strong></th>
        <th style="background-color: #343a40;color: #ffffff;text-align:right;"><strong>Price</strong></th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        @foreach ( $receivedItems as $item)
        @php $totalPrice += ($item->binUnitPrice * $item->binQty) @endphp
        <tr>
            <td>{{$item->binSerial}}</td>
            <td>{{$item->binItemCode}}</td>
            <td>{{$item->st_ConIDesc}}</td>
            <td style="text-align:right;">{{$item->binQty}}</td>
            <td style="text-align:right;">{{number_format(($item->binUnitPrice),2,'.',',')}}</td>
            <td style="text-align:right;">{{number_format(($item->binQty * $item->binUnitPrice),2,'.',',')}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5" style="text-align:right;"><strong>Total:</strong> </td>
            <td style="text-align:right;"><strong>{{number_format(($totalPrice),2,'.',',')}}</strong> </td>
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
            <td colspan="2">Date : {{($grn->status === 1) ? date('Y-M-d', strtotime($grn->approved_date)) : '' }}</td>
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
            <td colspan="3">{{(isset($grn->creator) && isset($grn->creator->namewithinitials))? $grn->creator->namewithinitials : '' }}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            @if($grn->status === 1)
            <td colspan="2"> {{(isset($grn->approver) && isset($grn->approver->namewithinitials))? $grn->approver->namewithinitials : '' }}</td>
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
@else( $receivedItems->isEmpty())
<table>
    <tr>
        <td>This Page have no items available...!</td>
    </tr>
</table>
@endif