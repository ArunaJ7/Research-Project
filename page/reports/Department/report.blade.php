<h1> Buddhist and Pali University of SriLanka </h1>
<h3> Department Details </h3>

<br />

<div class="col-md-12 text-right" >
    <a href="{{ url('DepartmentDetailslist',['dnam'=>$item_no->st_ConHdr])}}" class="btn btn-success"> Download as Excel</a>
</div>
<br /><br />


<div class="row text-left">
    <div class="col-md-12">
        <div><b><u>{{$item_name[0]->ch_ConDesc}}</u></b> </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-12 pl-5 mt-5" style='text-align:left'>

            <div class="table-responsive">

                @if( $stockItem->isNotEmpty() && $stockItem->count()>0 )
                <table class="table table-striped ">
                    <thead class="thead-dark">
                        <th>Item Code</th>
                        <th>Item Description</th>
                        <th class="text-right">Reorder Level</th>
                        <th class="text-right">Balance</th>
                    </thead>
                    <tbody>
                        @foreach ( $stockItem as $item)
                        <tr>
                            <td>{{$item->st_ConItem }} </td>
                            <td> {{ $item->st_ConIDesc}} </td>
                            <td class="text-right">{{$item->st_ConROL}}</td>
                            <td class="text-right">{{$item->st_ConBalance}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

            </div>
        </div>
    </div>
</div>
