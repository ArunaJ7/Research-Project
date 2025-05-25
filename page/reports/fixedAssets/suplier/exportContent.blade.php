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
                <h3><b> Fixed Assets Supplier Details</b></h3>
            </td>
        </tr>
        <tr>
            <td>
            </td>
        </tr>
        <tr>
            <td colspan="4" rowspan="2" align="center">
                <u>
                    <h5>Division :{{$divisionDesc}} ,
                        Category : {{$maincategoryDesc}} ,
                        Period From : {{ $fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate}},
                        to : {{$toDate == '-1' || $toDate == 'All' ? 'All' : $toDate}} </h5>
                </u>
            </td>
        </tr>
        @if( $subcategory != '-1')
        <tr>
            <td>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <strong>
                    Sub Category : {{$subcategoryDesc}} </strong>
            </td>
        </tr>
        @endif
    </tbody>
</table>
@if( $supplier->isNotEmpty() && $supplier->count()>0 )
<table>
    <thead style="background-color:#DDDDDD">
        <th style="background-color:#DDDDDD">GRN No</th>
        <th style="background-color:#DDDDDD">Fixed Assest No</th>
        <th style="background-color:#DDDDDD">Supplier</th>
        <th style="background-color:#DDDDDD">Contact Details</th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        @foreach ( $supplier as $supplier)
        <tr>
            <td> {{$supplier->GRN_No}} </td>
            <td> {{$supplier->fxCode}} </td>
            <td> {{$supplier->Supplier}} </td>
            <td> {{$supplier->Add1}}{{($supplier->Add2!=null)? ", ".$supplier->Add2:' '}}{{($supplier->Add3!=null)? ", ".$supplier->Add3:' '}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else($supplier->Empty())
<table>
    <tbody>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>Data Unavailable !</td>
        </tr>
    </tbody>

</table>
@endif