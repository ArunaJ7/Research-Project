<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Project Details')

@section('content')
<div class="container">
    <div class="row">

        <div class="container" id="faccontainer">

            <h1>Project Details</h1>
            <div class="row">
                <div class="col-md-12">

                    <form action=" {{ url('/save_project_details') }}" method="POST">
                        {{csrf_field()}}

                        <br> </br>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="proj_code">Project Code</label>
                            <div class="col-sm-9">

                                <input value="" type="text"  class="form-control"  name="proj_code" placeholder="Enter Project Code" required="required" id="proj_code">


                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="proj_desc">Project Description</label>
                            <div class="col-sm-9">

                                <input value="" class="form-control" type="text" name="proj_desc" placeholder="Enter Project Description" required="required" id="proj_desc">


                            </div>
                        </div>

                        </br>
                        <input type="submit" class="btn btn-primary" value="ADD">
                        <input type="button" class="btn btn-warning" value="CLEAR">
                        </br> </br>
                    </form>

                    <table class="table table-dark">
                       <!-- <th> Project ID</th> -->
                        <th> Project Code</th>
                        <th> Project Description</th>
                        @foreach($project as $updatedatarow)
                        <tr>
                           <!-- <td> {{$updatedatarow->id}} </td>-->
                            <td> {{$updatedatarow->projCode}} </td>
                            <td> {{$updatedatarow->projDesc}} </td>
                            <td>

                                <a href=" {{ url('/updateProjects/'.$updatedatarow->id)}}" class="btn btn-warning">Update</a>

                            </td>
                        </tr>
                        @endforeach

                </div>
            </div>
        </div>
    </div>
</div>