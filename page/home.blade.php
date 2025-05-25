@extends('layouts.mainlayout')
@section('title','Home')
@section('content')
<br>
<br>

<!-- blink reorder level -->
<div class="p-2 mt-5 text-left border-danger border-left reorder ">
  <h3 class="mb-0">
    <a href="{{url('/mail')}}" class="font-weight-bold text-danger" style="
        transition: 1s;" id="blink">Check Reorder Levels >></a>
  </h3>
  <script type="text/javascript">
    var blink = document.getElementById('blink');
    setInterval(function() {
      blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
    }, 5000);
  </script>


</div>
<!-- blink reorder level -->
<div class="container">
  <div class="row">
    <div class="col-md-8 mt-3" id="container01">
      <h2>INVENTORY MANAGEMENT SYSTEM</h2>
      <div class="row" id="container03">
        <div class="col-md-6">
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Consumable Items</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Feature subtitle</h6> -->
              <p class="card-img">Products that consumers use recurrently, items which "get used up" or discarded.</p>
              <a href="/Stores/public/conheader" class="card-link">Header Details</a>
              <a href="/Stores/public/sto_con_items" class="card-link">Item Details</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Fixed Assets</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Feature subtitle</h6> -->
              <p class="card-text">Products which are purchased for long-term use and are not likely to be converted quickly into cash.</p>
              <a href="/Stores/public/fix_assert_header" class="card-link">Header Details</a>
              <a href="/Stores/public/fxItems" class="card-link">Item Details</a>
            </div>
          </div>


        </div>
      </div>
    </div>

    <div class="col-md-4 mt-3" id="container02">

      <!--<img class="card-img-top" src="images/img2.png" alt="Card image">-->
      <img class="card-img-top" src="images/inventory-management.png" alt="Card image">

    </div>

  </div>
</div>



@endsection