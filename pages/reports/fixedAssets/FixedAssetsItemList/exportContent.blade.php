<table>
    <thead>
        <th colspan="15" rowspan="2" align="center"><strong>
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
            <td colspan="15" rowspan="2" align="center">
                <h3><b> Assets Item List - Details</b></h3>
            </td>
        </tr>
        <tr>
            <td>
                <u></u>
            </td>
        </tr>
        <tr>
            <td colspan="15" rowspan="2" align="center">
                <u>
                <h5>Division :{{$divisionDes == '-1' ? 'All' : $divisionDes}} ,
                     Category : {{$maincategoryDes == '-1' ? 'All' : $maincategoryDes}} ,
                         Period From : {{ $fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate}},
                             to : {{$toDate == '-1' || $toDate == 'All' ? 'All' : $toDate}} </h5>
                </u>
            </td>
        </tr>
    </tbody>
</table>
@if( $fixsdAssent->isNotEmpty() && $fixsdAssent->count()>0 )
<table>
    <thead >
        <th colspan="2" rowspan="2" align="center"><strong>Item Code</strong> </th>
        <th colspan="1" rowspan="2" align="center"><strong>Issue Date</strong></th>
        <th rowspan="2" align="center"><strong>GRN No.</strong></th>
        <th rowspan="2" align="center"><strong>GIN No.</strong></th>
        <th colspan="2" rowspan="2" align="center"><strong>Items Description</strong></th>
        <th colspan="1" rowspan="2" align="center"><strong> DEPT.</strong></th>
        <th colspan="2" rowspan="2" align="center"><strong>Serial No.</strong></th>
        <th colspan="2" rowspan="2" align="center"><strong>Amount</strong></th>
        <th colspan="3" rowspan="2" align="center"><strong> Remarks</strong></th>
    </thead>
</table>
<table>
    <tbody>
        <tr>
            <td>
                <u></u>
            </td>
        </tr>
        @foreach( $fixsdAssent as $data)
        <tr>
            <td colspan="2" align="left"> {{ $data->fxCode }} </td>
            <td colspan="1" align="left"> {{ date('M d, Y', strtotime($data->fxIDate))}} </td>
            <td align="left"> {{ $data->fxGRN }} </td>
            <td align="left"> {{ $data->fxGINNo }} </td>
            <td colspan="2" align="left">{{$data->fh_Desc}}</td>
            <td colspan="1" align="left"> {{ $data->fxDept }} </td>
            <td colspan="2" align="left"> {{ $data->fxSerialNo }}</td>
            <td colspan="2" align="right"> {{number_format(($data->fxAmount),2,'.',',')}}</td>
            <td colspan="3" align="left">{{$data-> fxRmks}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif