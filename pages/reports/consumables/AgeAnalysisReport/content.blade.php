<h1> Buddhist and Pali University of SriLanka </h1>
<h3> Age Analysis - Consumable Items </h3>

<br />

<div class="col-md-12 text-right">
    <a href="{{ url('/reports/conItem/AgeAnalysisReport/exportToExcel/' . $headers->ch_ConHdr . '/' . $fromDate . '/' . $toDate) }}"
        class="btn btn-success">
        Download as Excel</a>
</div>

<div class="row text-left">
    <div class="col-md-6 pl-5">
        <div>{{ $headers->ch_ConDesc }}</div>
    </div>
</div>

<div class="col-md-12 pl-5   mt-3 text-left">
    <div class="table-responsive">

        @if ($conitems->isNotEmpty() && $conitems->count() > 0)
            @php
                $totalPrice = 0;
                $totalQty = 0;
                $grandTotalPrice = 0;
                $newItemCode = true;
                $isfirstrow = true;
                $yearMap = []; // 5 years to genarate
                $totalPrice = $totalQty = $grandTotalPrice = 0;
                $newItemCode = $isfirstrow = true;

                // Convert the JSON string to an array
                $collectionArray = json_decode($conitems, true);

                // Get the current year
                $currentYear = date('Y');

                // Extract distinct years from the "binDate" field and filter those within the last 5 years
                $distinctYears = array_unique(
                    array_map(function ($item) {
                        return date('Y', strtotime($item['binDate']));
                    }, $collectionArray),
                );

                // Filter years within the last 5 years and add "other" for years more than 5 years ago
                $filteredYears = array_map(function ($year) use ($currentYear) {
                    $yearDifference = $currentYear - $year;
                    return $yearDifference < 5 ? $year : 'other';
                }, $distinctYears);

                // Sort the filtered years, keeping "other" at the end
                uasort($filteredYears, function ($a, $b) {
                    return $a === 'other' ? 1 : ($b === 'other' ? -1 : $b - $a);
                });

                // Remove duplicated "other" entries
                $filteredYears = array_values(array_unique($filteredYears));

                // Fill year_map with default qty and price
                foreach ($filteredYears as $year) {
                    $year_map[] = ['year' => $year, 'qty' => 0, 'price' => 0];
                }
            @endphp

            <table class="table table-striped ">
                <thead class="thead-dark text-center">
                    <tr>
                        <th rowspan="2" class="text-nowrap text-left">Item Description</th>
                        <th rowspan="2" class="text-right">Total Quantity</th>
                        <th rowspan="2" class="text-right">Total Price</th>
                        @foreach ($year_map as $year)
                            @if ($year['year'] == 'other')
                                <th class="text-center" colspan="2">Before {{ $currentYear - 5 }}</th>
                            @else
                                <th class="text-center" colspan="2">{{ $year['year'] }}</th>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($year_map as $year)
                            <th class="text-right">Qty</th>
                            <th class="text-right">Price</th>
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
                                    <td class="text-left text-nowrap">{{ $item_description }}</td>
                                    <td class="text-right">{{ $totalQty }}</td>
                                    <td class="text-right">{{ number_format($totalPrice, 2, '.', '') }}</td>
                                    @foreach ($year_map as $key => $year)
                                        <td class="text-right">{{ $year['qty'] }}</td>
                                        <td class="text-right">{{ number_format($year['price'], 2, '.', '') }}</td>
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
                        <td class="text-left text-nowrap">{{ $item_description }}</td>
                        <td class="text-right">{{ $totalQty }}</td>
                        <td class="text-right">{{ number_format($totalPrice, 2, '.', '') }}</td>
                        @foreach ($year_map as $key => $year)
                            <td class="text-right">{{ $year['qty'] }}</td>
                            <td class="text-right">{{ number_format($year['price'], 2, '.', '') }}</td>
                        @endforeach
                    </tr>

                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-right"><strong>Total:</strong>
                        </td>
                        <td class="text-right;">
                            <strong>{{ number_format($grandTotalPrice, 2, '.', '') }}</strong>
                        </td>
                    </tr>

                </tbody>
            </table>
        @else
        <div class="alert alert-danger" role="alert">
            No data Found
          </div>
        @endif
    </div>
</div>
