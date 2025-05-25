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
                <h3><b> Fixed Assets Returned and Transfered - Details</b></h3>
            </td>
        </tr>
        <tr>
            <td>
                <u></u>
            </td>
        </tr>
        <tr>
            <td colspan="4" rowspan="2" align="center">
                <u>
                    <h5> Category : {{$maincategory == '-1' ? 'All' : $maincategoryDes}} ,
                        Period From : {{ $fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate}},
                        to : {{$toDate == '-1' || $toDate == 'All' ? 'All' : $toDate}} </h5>
                </u>
            </td>
        </tr>
    </tbody>
</table>
@if( $fixsdAssets->isNotEmpty() && $fixsdAssets->count()>0 )
<table>
    <thead colspan="12">
        <th style="background-color:#DDDDDD"> F/A Code </th>
        <th style="background-color:#DDDDDD"> Issue Date </th>
        <th style="background-color:#DDDDDD"> Returned Date </th>
        <th style="background-color:#DDDDDD"> Devision </th>
    </thead>
</table>
<table>
    <tbody>
        @php $newType = true; @endphp
        @foreach( $fixsdAssets as $data)
        @php
        if(!isset($preType) || $preType != $data->fxStatus){
        $newType = true;
        $typeDesc = $data->fxStatus == 'R' ? 'Return to Stores' : 'Transfers from Stores';
        } else {
        $newType = false;
        }
        $preType = $data->fxStatus
        @endphp
        @if($newType)
        <tr>
            <td colspan="4" style=" text-align:center"> {{ $typeDesc }} </td>
        </tr>
        @endif
        <tr>
            <td > {{ $data->fxCode }} </td>
            <td > {{ date('M d, Y', strtotime($data->fxIDate))}} </td>
            <td > {{ date('M d, Y', strtotime($data->fxRDate))}} </td>
            <td > {{ $data->fxDept }} </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif