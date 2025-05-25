<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title','Fixed Assets')
@section('content')

<div class="container">
    <div class="row">
        <div class="content-container">

            <h1> Fixed Asset Item - {{ $gin->fxCode}}</h1>
            <br />

            <div class="row">
                <script type="text/javascript">
                    function onImageError(img){
                            img.src = "{{ asset('images/' . 'imageNotAvailable.png') }}";
                        }
                </script>
                <div class="col-md-12"><img width="100%" src="" id="display_image" alt="Not Found" onerror="onImageError(this);" />
                    <script>
                        @if("$gin->fxPhoto" != null)
                        document.getElementById('display_image').setAttribute("src", "{{ asset('storage/fx_image/' . $gin->fxPhoto) }}");
                        @else
                        document.getElementById('display_image').setAttribute("src", "{{ asset('images/' . 'imageNotAvailable.png') }}");
                        @endif
                        
                    </script>
                </div>
                <div class="col-md-12">

                    @include('layouts.messagePopup')
                    <br />
                </div>
            </div>
        </div>
    </div>
</div>


@endsection