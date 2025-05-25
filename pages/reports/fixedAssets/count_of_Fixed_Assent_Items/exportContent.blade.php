<table>
    <thead>
        <th colspan="7" rowspan="2" align="center"><strong>
                <h1>Buddhist and Pali University of SriLanka</h1>
            </strong>
        </th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td> </td>
        </tr>
        <tr>
            <td colspan="7" rowspan="2" align="center">
                <h3><b> Assets Item List - Count</b></h3>
            </td>
        </tr>
        <tr>
            <td>
                <u></u>
            </td>
        </tr>
        <tr>
            <td colspan="7" rowspan="3" align="center">
                <u>
                    <h5>Division :{{$divisionDes == '-1' ? 'All' : $divisionDes}} ,
                        Category : {{$maincategoryDes == '-1' ? 'All' : $maincategoryDes}} ,
                        Period From : {{ $fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate}},
                        to : {{$toDate == '-1' || $toDate == 'All' ? 'All' : $toDate}} </h5>
                </u>
            </td>
        </tr>
        <tr>
            <td>
                <u></u>
            </td>
        </tr>
    </tbody>
</table>
@if( $fixsdAssent->isNotEmpty() && $fixsdAssent->count()>0 )
@php $totalPrice = 0 @endphp
<table>
    <thead colspan="7">
        <tr>
            <th>
                <u></u>
            </th>
        <tr>
            <th colspan="5" rowspan="1" align="center"><u><strong><h3>Items Description</h3></strong> </u></th>
            <th colspan="2" rowspan="1" align="center"><u><strong><h3> No. Of Items</h3></strong></u></th>
    </thead>
</table>
<table>
    <tbody>
      
        @foreach( $fixsdAssent as $data)
        @php $totalPrice += ($data->items) @endphp
        <tr>
            <td align="left"> {{$data->fh_FxHdr2}}</td>
            <td colspan="4" align="left">{{$data->fh_Desc}}</td>
            <td colspan="2" align="right"> {{number_format(($data->items),2)}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7" align="right"><b>Total Number Of Items: {{number_format(($totalPrice),2)}}</b></td>
        </tr>
    </tbody>
</table>
@endif