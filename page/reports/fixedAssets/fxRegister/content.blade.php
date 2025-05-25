<h2> Buddhist and Pali University of SriLanka </h2>
<h3>Fixed Assets Register</h3>
<h5>Division :{{$divisionDes == '-1' ? 'All' : $divisionDes}} ,
     Category : {{$maincategoryDes == '-1' ? 'All' : $maincategoryDes}} ,
         Period From : {{ $fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate}},
            to : {{$toDate == '-1' || $toDate == 'All' ? 'All' : $toDate}} </h5>
<br />
<div class="col-md-12 text-right">
    <a href="{{url('/fx-register/view/excel/'
    .$division.'/'.$maincategory.'/'.$subcategory.'/'.($fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate).
            '/'.($toDate == '-1' || $toDate == 'All' ? 'All' : $toDate))}}" class="btn btn-success">
        Convert Into Excel</a>
</div>

<div class="row text-left" >
    <div class="col-md-12 pl-5 mt-5">
        <div class="table-responsive">

            @if( $fixsdAssent->isNotEmpty() && $fixsdAssent->count()>0 )

            <table class="table table-striped ">
                <thead class="thead-dark">
                    <th> Item Code </th>
                    <th> Items Description <br/> Physical Location </th>
                    <th> Name of the Vendor <br/> Address </th>
                    <th> GRN No.<br/> GIN No <br/> Serial No </th>
                    <th> Accquisition Date <br/> Accquisition Cost </th>
                    
                </thead>

                <tbody>
                    @foreach( $fixsdAssent as $data)

                    <tr>
                        <td class="text-left"> {{ $data->fxCode }} </td>
                        <td class="text-left"> {{ $data->fh_Desc }} <br /> {{$data->fxDept}}</td>
                        <td class="text-left"> {{ $data->Supplier }} <br /> 
                             {{$data->Add1}}{{($data->Add2!=null)? ", ".$data->Add2:' '}}{{($data->Add3!=null)? ", ".$data->Add3:' '}}</td>
                        <td class="text-left"> {{ $data->fxGRN }} <br /> {{$data->fxGINNo}} <br/> {{ $data->fxSerialNo }}</td>
                        <td class="text-left"> {{ date('M d, Y', strtotime($data->date))}} <br> {{number_format(($data->fxAmount),2,'.',',')}} </td>
                        
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