<h1> Buddhist and Pali University of SriLanka </h1>
<h3>Count of Fixed Assets Items</h3>
<h5>Division :{{$division == '-1' ? 'All' : $division}} ,
Category : All  ,
         Period From : {{ $fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate}},
            to : {{$toDate == '-1' || $toDate == 'All' ? 'All' : $toDate}} ,
          </h5>
</br>
<div class="col-md-12 text-right">
    <a href="{{url('/FixedAssetsCountEx/excel/-1/'
        .$division.'/-1/'.($fromDate == '-1' || $fromDate == 'All' ? 'All' : $fromDate).
            '/'.($toDate == '-1' || $toDate == 'All' ? 'All' : $toDate))}}" class="btn btn-success">
        Download Excel</a>
</div>