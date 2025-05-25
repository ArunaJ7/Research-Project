<table>
    <thead>
        <th colspan="4" rowspan="2" align="center"><strong>
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
            <td colspan="4" rowspan="2" align="center">
                <h3><b> Fixed Asset Not Issued to Users</b></h3>
            </td>
        </tr>
        <tr>
            <td>
                <u></u>
            </td>
        </tr>
    </tbody>
</table>
@if( $item_name->isNotEmpty() && $item_name->count()>0 )
<table>
    <thead>
        <th style="background-color:#CCCCCC; font-weight:bold;">GRN Date</th>
        <th style="background-color:#CCCCCC; font-weight:bold;">GRN No </th>
        <th style="background-color:#CCCCCC; font-weight:bold;">Item Description</th>
        <th style="background-color:#CCCCCC; font-weight:bold;text-align:right">Unit Price</th>
        <th style="background-color:#CCCCCC; font-weight:bold; text-align:right">Balance Units</th>
    </thead>
</table>
<table>
    <tbody>
        @foreach ( $item_name as $item)

        <tr>
            <td>{{$item->binDate}} </td>
            <td>{{$item->binMSerial}} </td>
            <td>{{$item->fh_Desc}}</td>
            <td> <span style="text-align:right">{{number_format($item->binUnitPrice,2)}}</span></td>
            <td> <span style="text-align:right">{{$item->binBalance}}</span></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif