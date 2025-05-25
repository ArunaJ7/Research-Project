<div class="table-responsive">
    {{ $bincard_data->links('pagination::bootstrap-4') }}
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th> Date </th>
                <th> Type </th>
                <th> Reference </th>
                <th class="text-right"> Quantity </th>
                <th class="text-right"> Unit Price </th>
                <th class="text-right"> Value </th>
                <th  class="text-right"> Balance </th>
                <th> Remarks </th>
            </tr>
        </thead>

        <tbody>
            @php $totalBalance = 0 @endphp
            @foreach($bincard_data as $item)
            <tr>
                @php $totalBalance += ($item->binType == 'R' ? $item->binQty : (-1)*$item->binQty) ;
                $leftParanthesis = $item->binType != 'R' ? '(' : '';
                $rightParanthesis = $item->binType != 'R' ? ')' : '';
                @endphp
                <td> {{ $item->binDate }} </td>
                <td> {{ $item->binType }} </td>
                <td> {{ $item->binMSerial }} </td>
                <td class="text-right"> {{ $leftParanthesis.$item->binQty.$rightParanthesis }} </td>
                <td class="text-right"> {{ $item->binUnitPrice }} </td>
                <td class="text-right"> {{ $leftParanthesis.number_format(($item->binQty * $item->binUnitPrice),2,'.',',').$rightParanthesis}} </td>
                <td class="text-right"> {{ $item->totalBalance}}</td>
                <td> {{ $item->binRmks }} </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>