<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Consumer Items Details')

@section('content')
<div class="container">
    <div class="row">

        <div class="container" id="faccontainer">

            <h1> Consumer Items Details</h1>
            <div class="row">
                <div class="col-md-12">

                    <form action="{{ url('/updateconitems') }}" method="POST">
                        {{csrf_field()}}

                        <br> </br>

                        <div class="form-group form-row">
                            <label for="rid" class="col-sm-3">ID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="sid" placeholder="Edit  ID" name="sid" value="{{$singleuserdata->id}}" Readonly>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="header">Header</label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" placeholder="Select consumable Header" id="header" name="header" required="required">
                                    @foreach($sheader as $sto_header)
                                    <option value="{{ucfirst($sto_header->ch_ConHdr)}}" selected>
                                        {{ucfirst($sto_header->full_desc)}}
                                    </option>
                                    @endforeach
                                    @foreach($Header as $hdr_select)
                                    <option value="{{$hdr_select->ch_ConHdr}}">
                                        {{ ucfirst($hdr_select->full_desc) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-st_ConItem">Item no</label>
                            <div class="col-sm-9">

                                <input value="{{$singleuserdata->st_ConItem}}" class="form-control" type="text" name="st_ConItem" placeholder="Enter Item number" required="required" id="st_ConItem">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-st_ConIDesc">Description</label>
                            <div class="col-sm-9">

                                <input value="{{$singleuserdata->st_ConIDesc}}" class="form-control" type="text" name="st_ConIDesc" placeholder="Enter Description" required="required" id="st_ConIDesc">


                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-st_ConROL">Reorder</label>
                            <div class="col-sm-9">
                                <input value="{{$singleuserdata->st_ConROL}}" class="form-control" type="text" name="st_ConROL" placeholder="Enter Reorder" required="required" id="st_ConROL">
                            </div>
                        </div>
                        </br>
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                        </br> </br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #faccontainer {
        text-align: left;
        /* margin-top: 100px;
    margin-bottom: 80px; */
    }

    h1 {
        text-align: center;
    }
</style>
@endsection


</body>

</html>