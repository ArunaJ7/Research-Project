<h1> Buddhist and Pali University of SriLanka </h1>
<h3> Fixed Asset - supplier details</h3>
<h5>Division :{{$divisionDesc}} , Category : {{$maincategoryDesc}} , Period From : {{isset($fromDate) && $fromDate !='-1'? $fromDate : 'All'}} to : {{isset($toDate) && $toDate  !='-1'? $toDate : 'All'}} </h5>
<div class="col-md-12 text-right mb-2">
    <a href="{{url('reports/fixedAssets/suplier-excel/'.$division.'/'.$dataMainCategory.'/'.$subcategory.'/'.$fromDate.'/'.$toDate)}}" class="btn btn-success">
        Convert Into Excel</a>
</div>
@if( $subcategory != '-1')
<div class="row text-left">
  <div class="col-md-12">
    <div><b><u>{{$subcategoryDesc}}</u></b> </div>
  </div>
</div>
@endif
<div class="row">
  <div class="col-md-12 pl-5 " style='text-align:left'>
    <div class="table-responsive">
      @if( $supplier->isNotEmpty() && $supplier->count()>0 )
      <table class="table table-striped ">
        <thead class="thead-dark">
          <th>GRN No</th>
          <th>Fixed Assest No</th>
          <th>Supplier</th>
          <th>Contact Details</th>
        </thead>
        <tbody>
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
      <div class="alert alert-danger" role="alert">
        Data Unavailable !
      </div>
      @endif
    </div>
  </div>
</div>
</div>