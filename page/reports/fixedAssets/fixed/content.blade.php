<h1> Buddhist and Pali University of SriLanka </h1>
<h3> Fixed Asset Not Issued to Users </h3>
<br /><br />

<div class="col-md-12 text-right">
    <a href="{{url('/reports/fixItem/FixedAssetNotIssuedToUsers/filter-excel/'.$item_no->fh_FxHdr)}}" class="btn btn-success">
        Download Excel</a>
</div>
<div class="row text-left">
    <div class="col-md-12">
        <div><b><u>{{$item_no->fh_FxDesc}}</u></b> </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 pl-5 mt-5" style='text-align:left'>

        <div class="table-responsive">

            @if( $item_name->isNotEmpty() && $item_name->count()>=0 )
            <table class="table table-striped ">
                <thead class="thead-dark">
                    <th>GRN Date</th>
                    <th>GRN No </th>
                    <th>Item Description</th>
                    <th>Unit Price</th>
                    <th>Balance Units</th>
                </thead>
                <tbody>
                    @foreach ( $item_name as $item)
                    <tr>
                        <td>{{$item->binDate}} </td>
                        <td>{{$item->binMSerial}} </td>
                        <td>{{$item->fh_Desc}}</td>
                        <td span style="text-align:right">{{number_format($item->binUnitPrice,2)}}</span></td>
                        <td span style="text-align:right">{{$item->binBalance}}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else($item_name->Empty())
            <div class="alert alert-danger" role="alert">
                No Items Avalable!
            </div>
            @endif

        </div>
    </div>
</div>
</div>