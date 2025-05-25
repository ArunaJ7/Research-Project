<h1> Buddhist and Pali University of SriLanka </h1>
<h3>Monthly Consummable Items Issued </h3>
<span class="status"> Department :{{$departmentDesc}}</span>

<?php
    $dateObj = DateTime::createFromFormat('!m', $month);
    $monthName = $dateObj->format('F');   
?>
@switch($valueOfDateCategory)
    @case('VR')
        <span class="status">
            Year : {{$year}} , Month : {{$monthName}}
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
<br /><br />
<div class="col-md-12 text-right">
    <a href="{{url('/reports/consumables/issuesDepartment-excel/'.$department.'/'.$maincategory.'/'.$subcategory
                .'/'.$year.'/'.$month.'/'.$valueOfDateCategory.'/'.$fromDate.'/'.$toDate)}}" class="btn btn-success"> Convert Into Excel</a> 
</div>
<div class="row">
    <div class="col-md-12 p-2 text-white font-weight-bold m-5 bg-dark text-left" >
        Total Issues Value of All Items : {{number_format(($stockItem),2,'.',',')}}
    </div>
</div>
</div>