<h2> Buddhist and Pali University of SriLanka </h2>
<h3>Fixed Assets Returned and Transfered - Details</h3>
<h5>
    Category : {{$maincategoryDes == '-1' ? 'All' : $maincategoryDes}} ,
    Period From : {{ $fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate}},
    to : {{$toDate == '-1' || $toDate == 'All' ? 'All' : $toDate}} </h5>
<br />
<div class="col-md-12 text-right">
    <a href="{{url('/fx-return-transfer/view/excel/'.$type.'/'.$maincategory.'/'.$subcategory.'/'.($fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate).
            '/'.($toDate == '-1' || $toDate == 'All' ? 'All' : $toDate))}}" class="btn btn-success">
        Convert Into Excel</a>
</div>

<div class="row">
    <div class="col-md-12 pl-5 mt-5">
        <div class="table-responsive">

            @if( $fixsdAssent->isNotEmpty() && $fixsdAssent->count()>0 )

            <table class="table table-striped ">
                <thead class="thead-dark">
                    <th> F/A Code </th>
                    <th> Issue Date </th>
                    <th> Returned Date </th>
                    <th> Devision </th>

                </thead>

                <tbody>
                    @php $newType = true; @endphp
                    @foreach( $fixsdAssent as $data)
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
                        <td colspan="4" class="text-center font-weight-bold"> {{ $typeDesc }} </td>

                    </tr>
                    @endif
                    <tr>
                        <td class="text-left"> {{ $data->fxCode }} </td>
                        <td class="text-left"> {{ date('M d, Y', strtotime($data->fxIDate))}} </td>
                        <td class="text-left"> {{ date('M d, Y', strtotime($data->fxRDate))}} </td>
                        <td class="text-left"> {{ $data->fxDept }} </td>
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