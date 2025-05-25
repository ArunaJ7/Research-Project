<h2> Buddhist and Pali University of SriLanka </h2>
<h3>Fixed Assets Item List - Details</h3>
<h5>Division :{{$divisionDes == '-1' ? 'All' : $divisionDes}} ,
     Category : {{$maincategoryDes == '-1' ? 'All' : $maincategoryDes}} ,
         Period From : {{ $fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate}},
            to : {{$toDate == '-1' || $toDate == 'All' ? 'All' : $toDate}} </h5>
<br />
<div class="col-md-12 text-right">
    <a href="{{url('/FixedAssetsItemListview/view/excel/'.($hedercode == null ? '-1' : $hedercode).
        '/'.$division.'/'.$maincategory.'/'.$subcategory.'/'.($fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate).
            '/'.($toDate == '-1' || $toDate == 'All' ? 'All' : $toDate))}}" class="btn btn-success">
        Convert Into Excel</a>
</div>

<div class="row text-left">
    <div class="col-md-6 pl-5">
        <div><u>{{$categorydescription}}</u></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 pl-5 mt-5">
        <div class="table-responsive">

            @if( $fixsdAssent->isNotEmpty() && $fixsdAssent->count()>0 )

            <table class="table table-striped ">
                <thead class="thead-dark">
                    <th> Item Code </th>
                    <th> Issue Date </th>
                    <th> GRN No. </th>
                    <th> GIN No. </th>
                    <th> Items Description </th>
                    <th> DEPT. </th>
                    <th> Serial No. </th>
                    <th> Amount </th>
                    <th> Remarks </th>
                </thead>

                <tbody>
                    @foreach( $fixsdAssent as $data)

                    <tr>
                        <td class="text-left"> {{ $data->fxCode }} </td>
                        <td class="text-left"> {{ date('M d, Y', strtotime($data->fxIDate))}} </td>
                        <td class="text-left"> {{ $data->fxGRN }} </td>
                        <td class="text-left"> {{ $data->fxGINNo }} </td>
                        <td class="text-left"> {{ $data->fh_Desc }} </td>
                        <td class="text-left"> {{ $data->fxDept }} </td>
                        <td class="text-left"> {{ $data->fxSerialNo }}</span></td>
                        <td class="text-right"> {{number_format(($data->fxAmount),2,'.',',')}}</td>
                        <td class="text-left">{{$data-> fxRmks}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            @else( $data->Empty())
            <div class="alert alert-danger" role="alert">
                No items available
            </div>
            @endif

        </div>
    </div>
</div>