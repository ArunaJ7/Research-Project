<h1> Buddhist and Pali University of SriLanka </h1>
<h3> Stock Value - Consumable Items </h3>

<br />

<div class="col-md-12 text-right">
    
    <a href="{{ url('/reports/conItem/StockReport/exportToExcelAll')}}" class="btn btn-success"> Download as Excel</a>
</div>
<div class="row">
    <div class="col-md-12 p-2 text-white font-weight-bold m-5 bg-dark text-left" >
        Total Stock Value of All Items : {{number_format(($total),2,'.',',')}}
    </div>
</div>
</div>