<h1> Buddhist and Pali University of SriLanka </h1>
<h3> Goods Issue Note(GIN) - Fixed Assets </h3>

<br />

<div class="col-md-12 text-right">
    <!--<a href="{{ url('conItemGinPdf/pdf')}}" class="btn btn-danger"> Convert Into PDF</a> -->
    <a href="{{ url('/reports/fxItem/GinExcel',['ginNo'=>$gin->fxGINNo])}}" class="btn btn-success"> Download as Excel</a>
</div>

<div class="row text-left mt-3">
    <div class="col-md-8 pl-5">
        <div> Bursar,</div>
        <div> Request your permission to issue the following items to the {{ $gin->department->deptName ?? ''}}</div>
    </div>
    <div class="col-md-4 pl-5">
        <div> GIN No : {{$gin->fxGINNo}}</div>
        <div> Date : {{date('Y-M-d', strtotime($gin->fxIDate));}}</div>
        {{-- {{$gin->cihDate}} --}}
    </div>
</div>
<div class="row text-left">
    <div class="col-md-4 pl-5">
        <div> .........................................</div>
        <div> Head of Department </div>
    </div>
    <div class="col-md-4 pl-5">
        <div> ............................................</div>
        <div> Executive Officer </div>
    </div>
    <div class="col-md-4 pl-5">
        <div> ........................................</div>
        <div> Bursar</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 pl-5   mt-5" style='text-align:left'>
        <div class="table-responsive">
            @if( $fxGin->isNotEmpty() && $fxGin->count()>0 )
            @php $totalPrice = 0; $grandTotalPrice = 0; $hasGrandTotal = false; @endphp
            @foreach ($fxGin as $key=>$gins)
            @php
            if($totalPrice > 0) {
                $hasGrandTotal = true;
            }
            $totalPrice = 0 ;
            @endphp
            <h5> {{$fxDepts[$key][0]->deptName}} </h5>
            <table class="table table-striped ">
                <thead class="thead-dark">
                    <th>No. </th>
                    <th>Item Description</th>
                    <th>Amount</th>
                    <th>Remarks</th>
                </thead>
                <tbody>
                    @foreach ( $gins as $item)
                    @php $totalPrice += ($item->fxAmount) @endphp
                    <tr>
                        <td>{{ $item->fxGINSub}}</td>
                        <td>{{$item->fxCode. ' - '. $item->fh_Desc}}</td>
                        <td class="text-right">{{number_format(($item->fxAmount),2,'.',',')}}</td>
                        <td>{{$item->fxRmks}}</td>
                    </tr>
                    @endforeach
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-right">Total:</td>
                        <td class="text-right">{{number_format(($totalPrice),2,'.',',')}}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            @php $grandTotalPrice += $totalPrice; @endphp
            @endforeach

            @if ($hasGrandTotal)
            <h5 class="text-left  pl-5   mt-5 text-right mr-5"> Grand Total : {{number_format(($grandTotalPrice),2,'.',',')}}</h5>
            @endif
            @endif

        </div>
    </div>
</div>
<div class=" row">
    <h5 class="text-left  pl-5   mt-3"> Issueing of goods:</h5>
</div>
<div class=" row text-left">
        <div class="col-md-6 pl-5   mt-3"">
        <div> Above items were issued</div>
        <div> ................................................</div>
        <div> Storekeeper</div>
    </div>
    <div class=" col-md-6 pl-5 mt-3"">
            <div> Above items were received in good condition</div>
            <div> ................................................</div>
            <div> Receiver of the goods</div>
        </div>
</div>