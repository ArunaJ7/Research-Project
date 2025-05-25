<table>
    <thead>
        <th colspan="6"><strong> Buddhist and Pali University of SriLanka</strong>
        </th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="6">
                <h3> Goods Issue Note(GIN) - Fixed Assets </h3>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="4">
                Burasar,
            </td>
            <td>Issue No :</td>
            <td>{{$gin->fxGINNo}}</td>
        </tr>
        <tr>
            <td colspan="4">
                Request your premission to issue the following items to the {{ $gin->department->deptName ?? ''}}
            </td>
            <td>Date:</td>
            <td>{{date('Y-M-d', strtotime($gin->fxIDate))}}</td>
        </tr>

        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                -------------------------------
            </td>
            <td colspan="2" style="text-align:center;">-----------------------------</td>
            <td colspan="2" style="text-align:center;">-------------------------------</td>
        </tr>

        <tr>
            <td colspan="2" style="text-align:center;">
                Head of the Department
            </td>
            <td colspan="2" style="text-align:center;">Executive Officer</td>
            <td colspan="2" style="text-align:center;">Bursar</td>
        </tr>
    </tbody>
</table>
@if( $fxGin->isNotEmpty() && $fxGin->count()>0 )
@php $totalPrice = 0; $grandTotalPrice = 0; $hasGrandTotal = false; @endphp
@foreach ($fxGin as $key=>$gins)
@php
if($totalPrice > 0) {
$hasGrandTotal = true;
}
$totalPrice = 0 ;
@endphp
<table>
    <thead>
        <th colspan="6" style="text-decoration: underline">{{$fxDepts[$key][0]->deptName}}
        </th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
    </tbody>
</table>
<table>
    <thead style="background-color:#DDDDDD">
        <th style="background-color:#DDDDDD">No. </th>
        <th style="background-color:#DDDDDD">Item Description</th>
        <th style="background-color:#DDDDDD; text-align:right;">Amount</th>
        <th style="background-color:#DDDDDD">Remarks</th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        @foreach ( $gins as $item)
        @php $totalPrice += ($item->fxAmount) @endphp
        <tr>
            <td>{{ $item->fxGINSub}}</td>
            <td>{{$item->fxCode. ' - '. $item->fh_Desc}}</td>
            <td style="text-align:right;">{{number_format(($item->fxAmount),2,'.',',')}}</td>
            <td>{{$item->fxRmks}}</td>
        </tr>
        @endforeach
        <tr >
            <td colspan="2" style="text-align:right;">Total:</td>
            <td style="text-align:right;">{{number_format(($totalPrice),2,'.',',')}}</td>
            <td></td>
        </tr>
    </tbody>
</table>
@php $grandTotalPrice += $totalPrice; @endphp
@endforeach

@if ($hasGrandTotal)
<table>
    <thead>
        <th colspan="2"style="text-align:right;"> <strong>Grand Total:</strong></th>
        <th  style="text-align:right;"> <strong>{{number_format(($grandTotalPrice),2,'.',',')}}</strong>
        </th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
    </tbody>
</table>
@endif
@endif

<table>
    <thead>
        <th colspan="6">Issueing of goods:
        </th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">
                Above items were issued
            </td>
            <td colspan="3">Above items were received in good condition</td>
        </tr>
        <tr>
            <td></td>
        </tr>

        <tr>
            <td colspan="2">
                ...............................................
            </td>
            <td colspan="3">...............................................</td>
        </tr>

        <tr>
            <td colspan="2">
                Storekeeper
            </td>
            <td colspan="3">Receiver of the goods</td>
        </tr>
    </tbody>
</table>