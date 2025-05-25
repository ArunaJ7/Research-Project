<div class="row">
    <div class="col-md-12">
        <h1> Buddhist and Pali University of SriLanka </h1>
        <div>
            <h3> Bin Card Details : {{$itemName.' ('.(($item && $item->st_ConIDesc)?$item->st_ConIDesc:'') .') '}}</h3>
            <h5 class="text-success font-weight-bold"> Balance (current) : {{$totalQty }}</h5>
            <h5 class="text-success font-weight-bold"> Total Value (current) : {{ number_format(($totalValue),2,'.',',')}}</h5>
            <div class="text-right mb-3">
            <a href="{{ url('/bincardexcel/'.$itemName)}}" class="btn btn-success"> Download as Excel</a>
            </div>
            <div class="row" rel="table-content">
                <div class="col-md-12">
                    @include('pages.reports.consumables.binCard.binCardIndividualContent')
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('[rel="content-container"]').on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            $.ajax({
                url: '{{url("/viewBinCardIndividualReport/".$itemName."/pagination/fetch_data")}}' + '?page=' + page,
                success: function(data) {
                    $('[rel="table-content"]').html(data);
                }
            });
        }
    });
</script>