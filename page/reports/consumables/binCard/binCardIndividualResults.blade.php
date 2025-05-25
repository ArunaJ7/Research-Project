@extends('layouts.mainlayout')

@section('title','Bin Card Details')

@section('content')
<div class="container">
    <div class="content-container" rel="content-container">
        @include('pages.reports.consumables.binCard.binCardIndividualPageContent')
    </div>
</div>
@endsection