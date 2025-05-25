
<h2> Buddhist and Pali University of SriLanka </h2>
<h3> Monthly Consumable Received Item Lists <br>
<?php
    $dateObj = DateTime::createFromFormat('!m', $month);
    $monthName = $dateObj->format('F');   
?>
    @switch($valueOfDateCategory)
        @case('VR')
            <span class="status">
                Year : {{$year}} , Month : {{$month}}
            </span>
            @break

        @case('VI')
            <span class="status">
                Year : {{$year}}
            </span>
            @break

        @default
            <span class="status">
                From : {{$fromDate}}  To : {{$toDate}}
            </span>
    @endswitch
</h3>
<br />
<div class="col-md-12 text-right">
<a href="{{url('/ReceivedMonthly/view/excel/'.$ItemNo.'/'.$year.'/'.$month.'/'.$valueOfDateCategory.'/'.$fromDate.'/'.$toDate)}}" class="btn btn-success"> Convert Into Excel</a>
</div>
<div class="row">
    <div class="col-md-12 p-2 text-white font-weight-bold m-5 bg-dark text-left" >
        Total Received Value of All Items : {{number_format(($receivedItem),2,'.',',')}}
    </div>
</div>
</div>