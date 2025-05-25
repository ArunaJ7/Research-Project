<table>
    <thead>
        <th colspan="5" style="font-size: 18px;"><strong> Buddhist and Pali University of SriLanka</strong>
        </th>
    </thead>
    <tbody>
        <tr>
            <td> </td>
        </tr>
        <tr>
            <td colspan="5" style="font-size: 16px;">
                 Age Analysis - Consumable Items 
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">
                <u>{{isset($headers)? $headers->ch_ConDesc: ''}}</u>
            </td>
        </tr>
    </tbody>
</table>
@if ($conitems->isNotEmpty() && $conitems->count() > 0)
@php
    $totalPrice = 0;
    $totalQty = 0;
    $grandTotalPrice = 0;
    $newItemCode = true;
    $isfirstrow = true;
    $yearMap = []; /* 5 years to genarate*/
    $totalPrice = $totalQty = $grandTotalPrice = 0;
    $newItemCode = $isfirstrow = true;

    /* Convert the JSON string to an array*/
    $collectionArray = json_decode($conitems, true);

    /* Get the current year*/
    $currentYear = date('Y');

    /* Extract distinct years from the "binDate" field and filter those within the last 5 years*/
    $distinctYears = array_unique(
        array_map(function ($item) {
            return date('Y', strtotime($item['binDate']));
        }, $collectionArray),
    );

    /* Filter years within the last 5 years and add "other" for years more than 5 years ago*/
    $filteredYears = array_map(function ($year) use ($currentYear) {
                                    $yearDifference = $currentYear - $year;
                                    return $yearDifference < 5 ? $year : 'other' ; 
                                }, $distinctYears
                        ); 

    /* Sort the filtered years, keeping "other" at the end */
    uasort($filteredYears, function ($a, $b) { 
        return $a==='other' ? 1 : ($b==='other' ? -1 : $b - $a); 
    }); 

    /* Remove duplicated "other" entries */
    $filteredYears=array_values(array_unique($filteredYears)); 

    /* Fill year_map with default qty and price*/ 
    foreach ($filteredYears as $year) { 
        $year_map[]=['year'=> $year, 'qty' => 0, 'price' => 0];
    }
    @endphp

    <table class="table table-striped ">
        <thead >
            <tr>
                <th rowspan="2" style="text-align:left;background-color:#BDBDBD;border:1px solid;"><strong> Description</strong></th>
                <th rowspan="2" style="text-align:right;background-color:#BDBDBD;border:1px solid;"><strong> Total Quantity</strong></th>
                <th rowspan="2" style="text-align:right;background-color:#BDBDBD;border:1px solid;"><strong> Total Price</strong></th>
                @foreach ($year_map as $year)
                @if ($year['year'] == 'other')
                <th style="text-align:center;background-color:#BDBDBD;border:1px solid;" colspan="2"><strong> Before {{($currentYear-5)}}</strong></th>
                @else
                <th style="text-align:center;background-color:#BDBDBD;border:1px solid;" colspan="2"><strong> {{ $year['year'] }}</strong></th>
                @endif
                @endforeach
            </tr>
            <tr>
                @foreach ($year_map as $year)
                <th style="text-align:right;background-color:#BDBDBD;border:1px solid;"><strong> Qty</strong></th>
                <th style="text-align:right;background-color:#BDBDBD;border:1px solid;"><strong> Price</strong></th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @foreach ($conitems as $item)
            @php
                if (!isset($prevItemCode) || $prevItemCode != $item->binItemCode) {
                $newItemCode = true;
                } else {
                $newItemCode = false;
                }
                $prevItemCode = $item->binItemCode;
                @endphp

                @if ($newItemCode)
                    @if (!$isfirstrow)
                    <tr>
                        <td style="text-align:left">{{ $item_description }}</td>
                        <td style="text-align:right">{{ $totalQty }}</td>
                        <td style="text-align:right">{{ number_format($totalPrice, 2, '.', '') }}</td>
                        @foreach ($year_map as $key => $year)
                        <td style="text-align:right">{{ $year['qty'] }}</td>
                        <td style="text-align:right">{{ number_format($year['price'], 2, '.', '') }}</td>
                        @endforeach
                    </tr>
                        @php
                            $totalPrice = 0;
                            $totalQty = 0;
                            foreach ($year_map as $key => $year) {
                                $year_map[$key]['qty'] = 0;
                                $year_map[$key]['price'] = 0;
                            }
                        @endphp
                    @endif
                @endif

                @php
                    $itemCode = $item->binItemCode;
                    $totalQty += $item->binBalance;
                    $totalPrice += $item->binUnitPrice * $item->binBalance;
                    $grandTotalPrice += $item->binUnitPrice * $item->binBalance;
                    $item_description = $item->binItemCode . ' - ' . $item->st_ConIDesc;
                    $itemYear = date('Y', strtotime($item->binDate));

                    // get index of year on array what matched binDate
                    $index = array_search($itemYear, array_column($year_map, 'year'));

                    // If year not mathched index is false
                    if ($index === false) {
                        $index = count($year_map) - 1;
                    }

                    // Fill qty and price to matching year in array
                    $year_map[$index]['qty'] += $item->binBalance;
                    $year_map[$index]['price'] += $item->binBalance * $item->binUnitPrice;

                    $isfirstrow = false;
            @endphp 
            @endforeach

            <tr>
                <td style="text-align:left">{{ $item_description }}</td>
                <td style="text-align:right">{{ $totalQty }}</td>
                <td style="text-align:right">{{ number_format($totalPrice, 2, '.', '') }}</td>
                @foreach ($year_map as $key => $year)
                <td style="text-align:right">{{ $year['qty'] }}</td>
                <td style="text-align:right">{{ number_format($year['price'], 2, '.', '') }}</td>
                @endforeach
            </tr>

            <tr class="font-weight-bold">
                <td colspan="2" style="text-align:right"><strong>Total:</strong>
                </td>
                <td style="text-align:right;">
                    <strong>{{ number_format($grandTotalPrice, 2, '.', '') }}</strong>
                </td>
            </tr>

        </tbody>
    </table>
    @endif