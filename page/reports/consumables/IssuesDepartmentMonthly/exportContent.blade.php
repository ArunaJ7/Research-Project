<table>
    <thead>
        <th colspan="14" rowspan="2" align="center"><strong><h1>Buddhist and Pali University of SriLanka</h1>
        </strong>
        </th>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td> </td>
        </tr>
        <tr>
            <td colspan="14" rowspan="2" align="center" >
                <h3> Monthly Department Consummable Issues Details - </h3>
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
            </td>
        </tr>
        <tr>
            <td>   
            </td>
        </tr>
        <tr>
            <td align="left">
                
            </td>
        </tr>
    </tbody>
</table>

@php $totalPrice = 0 @endphp
<table>
    <thead class="thead-dark">
        <tr>
            <th></th>
            @foreach($hdrs as $header)
                <th>{{$header->ch_ConDesc}}</th>
            @endforeach
            <th>Total</th>
        </tr>
    </thead>
</table>
<table>
    <tbody>
        <?php
        $total = 0;
        $index = 0;
        ?>
        @foreach($departments as $department)
            <?php $subTotal = 0; ?>
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
