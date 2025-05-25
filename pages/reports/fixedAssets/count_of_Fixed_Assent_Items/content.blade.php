<h2> Buddhist and Pali University of SriLanka </h2>
<h3>Count of Fixed Assets Items</h3>
<h5>Division :{{$division == '-1' ? 'All' : $division}} ,
Category : {{$maincategoryDes == '-1' ? 'All' : $maincategoryDes}} ,
         Period From : {{ $fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate}},
            to : {{$toDate == '-1' || $toDate == 'All' ? 'All' : $toDate}} ,
          </h5>

</br>
<div class="col-md-12 text-right">
    <a href="{{url('/FixedAssetsCountEx/excel/'.($hedercode == null ? '-1' : $hedercode).
        '/'.$division.'/'.$maincategory.'/'.($fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate).
            '/'.($toDate == '-1' || $toDate == 'All' ? 'All' : $toDate))}}" class="btn btn-success">
        Convert Into Excel</a>
</div>

<div class="row text-left">
    <div class="col-md-6 pl-5">
        <div><u></u></div>
    </div>
</div >
<div class="row">
 
    <div class="col-xl-12 pl-5 mt-5">
        <div class="table-responsive">

            @if( $fixsdAssent->isNotEmpty() && $fixsdAssent->count()>0)
            @php $totalPrice = 0 @endphp
            <h5 class="text-left">{{$categorydes}}</h5>
            <table  class="table">
                <thead class="thead-dark">
                   
                    <th colspan="2" class="text-left"> Items Description </th>

                    <th colspan="2"> No. Of Items </th>
                </thead>

                <tbody>
                    @foreach( $fixsdAssent as $data)
                    @php $totalPrice += ($data->items) @endphp
                    <tr>
                        <td class="text-left"> {{$data->fh_FxHdr2}}</td>
                        <td class="text-left">{{$data->fh_Desc}}</td>
                        <td class="text-right"> {{number_format(($data->items),2)}}</td>
                    </tr>
                    @endforeach
                    <tr class="font-weight-bold">
                        <td colspan="7" class="text-right">Total Number Of Items: {{number_format(($totalPrice),2)}}</td>
                        <td class="text-right"></td>
                    </tr>
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