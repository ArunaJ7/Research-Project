<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('content')

<div class="container">
    <div class="row content-container ">
        <div class="container">
            <h1 class="text-center">Update Department</h1>
            <br />
            <div class="row text-left">
                <div class="col-md-12">
                    <!-- Update form -->
                    <form method="POST" action="{{ url('/dept/updateData')}}">
                        {{ csrf_field() }}
                        {{-- @method('POST')  Use PUT for updating --> --}}

                        <input type="hidden" name="id" value="{{ $update_dept_data->id }}" />

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="dname">Select Department</label>
                            <div class="col-sm-9">
                                <select class="form-control formselect required" id="admindept" name="admindept" required>
                                    <option>Select Department</option>
                                    @foreach($departments as $sto_header)
                                    <option value="{{ $sto_header->id }}"
                                        @if($update_dept_data->admindept == $sto_header->id) selected @endif>
                                        {{ ucfirst($sto_header->dname) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="deptName">Division Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="deptName" placeholder="Enter Division Name" value="{{ $update_dept_data->deptName }}" required id="deptName">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="deptCode">Department Code</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="deptCode" maxlength="03" placeholder="Department Code" value="{{ $update_dept_data->deptCode }}" id="deptCode">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label class="col-sm-3" for="dpFA">Department FA</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="deptFA" placeholder="Department FA" value="{{ $update_dept_data->deptFA }}" id="deptFA">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection