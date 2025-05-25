<table>
    <thead>
        <th colspan="10" rowspan="2" align="center"><strong>
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
            <td colspan="10" rowspan="2" align="center">
                <h3><b> Fixed Assets Register</b></h3>
            </td>
        </tr>
        <tr>
            <td>
                <u></u>
            </td>
        </tr>
        <tr>
            <td colspan="10" rowspan="2" align="center">
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
    <thead class="thead-dark">
        <th style="background-color:#DDDDDD; font-weight:bold;"> Item Code </th>
        <th style="background-color:#DDDDDD; font-weight:bold;"> Items Description </th>
        <th style="background-color:#DDDDDD; font-weight:bold;"> Physical Location </th>
        <th style="background-color:#DDDDDD; font-weight:bold;"> Name of the Vendor </th>
        <th style="background-color:#DDDDDD; font-weight:bold;"> Address </th>
        <th style="background-color:#DDDDDD; font-weight:bold;"> GRN No. </th>
        <th style="background-color:#DDDDDD; font-weight:bold;"> GIN No </th>
        <th style="background-color:#DDDDDD; font-weight:bold;"> Serial No </th>
        <th style="background-color:#DDDDDD; font-weight:bold;"> Accquisition Date </th>
        <th style="background-color:#DDDDDD; font-weight:bold;"> Accquisition Cost </th>

    </thead>

    <tbody>
        <tr>
            <td>
            </td>
        </tr>
        @foreach( $fixsdAssent as $data)

        <tr>
            <td class="text-left"> {{ $data->fxCode }} </td>
            <td class="text-left"> {{ $data->fh_Desc }} </td>
            <td class="text-left"> {{ $data->fxDept }} </td>
            <td class="text-left"> {{ $data->Supplier }} </td>
            <td class="text-left"> {{$data->Add1}}{{($data->Add2!=null)? ", ".$data->Add2:' '}}{{($data->Add3!=null)? ", ".$data->Add3:' '}}</td>
            <td class="text-left"> {{ $data->fxGRN }} </td>
            <td class="text-left"> {{ $data->fxGINNo }} </td>
            <td class="text-left"> {{ $data->fxSerialNo }} </td>
            <td class="text-left"> {{ date('M d, Y', strtotime($data->date))}}  </td>
            <td class="text-left"> {{number_format(($data->fxAmount),2,'.',',')}} </td>

        </tr>
        @endforeach

    </tbody>
</table>
@endif