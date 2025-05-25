<h1> Buddhist and Pali University of SriLanka </h1>
<h3> Verification Adjestment Items 
<br />
<?php
    $dateObj = DateTime::createFromFormat('!m', $month);
    $monthName = $dateObj->format('F');   
?>
@switch($valueOfDateCategory)
    @case('VR')
        <span class="status">
            Year : {{$year}} &nbsp &nbsp &nbsp Month : {{$monthName}}
        </span>
        @break

    @case('VI')
        <span class="status">
            Year : {{$year}}
        </span>
        @break

    @default
        <span class="status">
            From : {{$fromDate}} &nbsp &nbsp &nbsp To : {{$toDate}}
        </span>
@endswitch
</h3>
<div class="col-md-12 text-right">
    <a href="{{url('/reports/consumables/Verficationadjestment-excel/-1/'.$year.'/'.$month.'/'.$valueOfDateCategory.'/'.$fromDate.'/'.$toDate)}}" class="btn btn-success"> Convert Into Excel</a>
</div>

<div class="row">
    <div class="col-md-12 p-2 text-white font-weight-bold m-5 bg-dark text-left" >
        Total Value of All Items : {{number_format(($verifiItem),2,'.',',')}}
    </div>
</div>
</div>