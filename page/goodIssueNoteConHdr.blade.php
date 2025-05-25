<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Good Issue Note - Consumables')

@section('content')
<div class="container">
    <div class="row">
 
        <div class="container" id="GINcontainer">

            <br /><br /><br /><br /><br />

            <h1 style='text-align:center'> Good Issue Note Details </h1>
            <br /><br />
            <div class="row">
                <div class="col-md-12">

                    <form method="post" action="{{ url('/issueItem') }}">
                        {{csrf_field()}}

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-dept"> Department </label>
                            <div class="col-sm-9">
                                <select class="form-control formselect " placeholder="Select Department" id="deptSelect" name="deptSelect">
                                    <option value="0" disabled selected>Select Department*</option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->deptCode}}">
                                        {{ ucfirst($department->deptName.' - '.$department->deptCode) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-dept"> Employee </label>
                            <div class="col-sm-9">
                                <select class="form-control formselect " placeholder="Select Employee" id="empSelect" name="empSelect">
                                    <option value="0" disabled selected>Select Employee*</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->empepf}}">
                                        {{ ucfirst($employee->empepf.' - '.$employee->empSurname.' '.$employee->empInitials)  }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-dept"> Project </label>
                            <div class="col-sm-9">
                                <select class="form-control formselect " placeholder="Select Project" id="projSelect" name="projSelect">
                                    <option value="0" disabled selected>Select Project*</option>
                                    @foreach($projects as $project)
                                    <option value="{{$project->projCode}}">
                                        {{ ucfirst($project->projname) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-NIC"> Date </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="date" name="date" placeholder="Enter Date" id="date">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-NIC"> Issue No. </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" name="issueNo" placeholder="Enter Issue No." id="issueNo" required>
                            </div>
                        </div>
                        <div class="form-group">
                            @if(session()->has('errors'))
                            <label class="text-danger font-weight-bold p-3"> {{session()->get('errors') }}</label>
                            @elseif(session()->has('success'))
                            <label class="text-danger font-weight-bold p-3"> {{session()->get('success') }} </label>
                            @endif
                        </div>
                        <br />

                        <input type="submit" class="btn btn-info" value="Add GIN">

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection