@extends('layouts.mainlayout')
@section('title','Consumable Items Issued Details')
@section('content')

    <div class="row col-md-12" style="margin-left :-100px;">
        <div class="content-container">
        <h1> Buddhist and Pali University of SriLanka </h1>
        <div>
            <h3> Monthly Department Consummable Issues Summary</h3>

            <?php
            $dateObj = DateTime::createFromFormat('!m', $month);
            $monthName = $dateObj->format('F');   
            ?>
            @switch($radioy)
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
            &nbsp;
            <br/>
            <br/>

            <div class="col-md-12 text-center">
                <a href="{{url('/IssuesDepartmentMonthly/excel/'.($year==null ? '-1':$year).'/'.($month==null ? '-1':$month).'/'.($radioy==null ? '-1':$radioy).'/'.($fromDate==null ? '-1':$fromDate).'/'.($toDate==null ? '-1':$toDate))}}" class="btn btn-success"> Convert Into Excel</a>
            </div>
          
            <br>
            <div class="row" rel="table-content">
                <div class="col-md-12">
                    <table class="table table-striped ">

                        <thead class="thead-dark">
                            <tr>
                                <th></th>
                                @foreach($hdrs as $header)
                                    <th>{{$header->ch_ConDesc}}</th>
                                @endforeach
                                <th>Total</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            $total = 0;
                            $index = 0;
                            
                            ?>
                            @foreach($departments as $department)
                                <?php $subTotal = 0;  ?>
                                <tr>
                                    <td>{{$department->deptName}}</td>
                                    @foreach($hdrs as $header)
                                    
                                    
                                        <td>
                                            <?php
                                            if( count($costs) > $index && $costs[$index]->st_ConHdr == $header->ch_ConHdr && $costs[$index]->cihDept == $department->deptCode){
                                                echo printf("%.1f", $costs[$index]->cost);
                                                $subTotal += $costs[$index]->cost;
                                                $index += 1;
                                            }
                                            else{
                                                echo '0.00';
                                            }
                                            ?>
                                        </td>
                                    @endforeach
                                    <td align="right"><strong>{{number_format($subTotal,2)}}</strong></td>
                                </tr>
                                <?php $total += $subTotal;?>
                            @endforeach
                                <tr>
                                    <td colspan="{{$hdrsCount+1}}"><strong>Total :</strong></td>
                                    <td><h5><strong>{{number_format($total,2)}}</strong></h5></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
