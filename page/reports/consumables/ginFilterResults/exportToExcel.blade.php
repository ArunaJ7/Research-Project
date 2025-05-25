<table class="waffle" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td colspan="8" style="font-size: 18px;"><strong>Buddhist and Pali University of SriLanka</strong></td>
        </tr>
        <tr>
            <td colspan="8" style="font-size: 16px;">Goods Issued Note(GIN) - Consumable Items</td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td>Issue No :</td>
            <td>{{$gin->cihMSerial}}</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">Burasar,</td>
            <td colspan="3"></td>
            <td>Date:</td>
            <td>{{date('Y-M-d', strtotime($gin->cihDate))}}</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="7">Request your premission to issue the following items to the {{(isset($gin->department) && isset($gin->department->deptName))?$gin->department->deptName : ''}}</td>
            <td></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" style="text-align: center;">…................................................................... </td>
            <td>…...................................................................</td>
            <td></td>
            <td colspan="2">…...............................................................</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" style="text-align: center;">Head of the Department</td>
            <td colspan="2" style="text-align: center;">Executive Officer</td>
            <td colspan="2">Bursar</td>
            <td></td>
        </tr>
        <tr>
        </tr>
    </tbody>
</table>

@php
$totalPrice = 0 ;
@endphp
@if( $IssuedItems->isNotEmpty() && $IssuedItems->count()>0 )
@php $totalPrice = 0 @endphp
<table class="table table-striped">
    <thead class="thead-dark">
        <th style="background-color: #343a40;color: #ffffff;"><strong>No</strong></th>
        <th style="background-color: #343a40;color: #ffffff;"><strong>Item Code</strong></th>
        <th style="background-color: #343a40;color: #ffffff;"><strong>Item Description</strong></th>
        <th style="background-color: #343a40;color: #ffffff; text-align:right;"><strong>Quantity</strong></th>
        <th style="background-color: #343a40;color: #ffffff; text-align:right;"><strong>Unit Price</strong></th>
        <th style="background-color: #343a40;color: #ffffff; text-align:right;"><strong>Price</strong></th>
    </thead>
    <tbody style="border: #343a40 1px solid;">
        <tr>
            <td></td>
        </tr>
        @foreach ( $IssuedItems as $item)
        @php $totalPrice += ($item->binUnitPrice * $item->binQty) @endphp
        <tr>
            <td>{{$item->binSerial}}</td>
            <td>{{$item->binItemCode}}</td>
            <td>{{$item->st_ConIDesc}}</td>
            <td>{{$item->binQty}}</td>
            <td>{{number_format(($item->binUnitPrice),2,'.',',')}}</td>
            <td>{{number_format(($item->binQty * $item->binUnitPrice),2,'.',',')}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5" style="text-align:right"><strong>Total:</strong></td>
            <td><strong>{{number_format(($totalPrice),2,'.',',')}}</strong></td>
        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
        </tr>
        <tr>
            <td colspan="9">
                <div class="softmerge-inner" style="width:203px;left:-1px"><strong> Issuing of Goods: </strong></div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">Above items were issued.</td>
            <td></td>
            <td colspan="3">Above items were received in good condition.</td>
            <td></td>
        </tr>
        <tr>

        </tr>
        <tr>
            <td></td>
            <td colspan="2">…..................................................</td>
            <td></td>
            <td colspan="3">…..............................................................</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">Storekeeper:</td>
            <td></td>
            <td colspan="3">Receiver of goods:</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">{{(isset($gin->creator) && isset($gin->creator->namewithinitials))? $gin->creator->namewithinitials : '' }}</td>
            <td></td>
            <td colspan="3">{{(isset($gin->receiver) && isset($gin->receiver->namewithinitials))? $gin->receiver->namewithinitials : '' }}</td>
            <td></td>
        </tr>
        <tr></tr>
        <tr>
            <td></td>
            <td colspan="2">…..................................................</td>
            <td></td>
            <td colspan="3"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">Approved By:</td>
            <td></td>
            <td colspan="3"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">{{(isset($gin->approver) && isset($gin->approver->namewithinitials))? $gin->approver->namewithinitials : '' }}</td>
            <td></td>
            <td colspan="3"></td>
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