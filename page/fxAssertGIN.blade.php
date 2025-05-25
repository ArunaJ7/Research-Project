<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title','GIN Fixed Assets')
@section('content')

<div class="container">
    <div class="row">
      <div class="container" id="faccontainer">
  
        <h1>Good Issue Note(GIN) - Fixed Asset Items</h1>
        <br/>

        <div class="row">
            <div class="col-md-12">
                <form action="/Stores/public/saveFxAstGin" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="GinNo">GIN No *</label>
                        <div class="col-sm-9">
                            <input value="" class="form-control" type="text" name="GinNo" placeholder="Enter GIN No" required="required" id="GinNo">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="GinSub">GIN Sub *</label>
                        <div class="col-sm-9">
                            <input value="" class="form-control" type="text" name="GinSub" placeholder="Enter GIN Sub" required="required" id="GinSub">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="GrnNo">GRN No *</label>
                        <div class="col-sm-7">
                            <input value="" class="form-control" type="text" name="GrnNo" placeholder="Enter GRN No" required="required" id="GrnNo">
                        </div>
                        <div class="col-sm-2">
                            <button type="button" name="filter" id="filter" class="btn btn-light">Filter</button>
                            <button type="button" name="reset" id="reset" class="btn btn-light">Reset</button>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier">GRN Sub *</label>
                        <div class="col-sm-9">
                            <input value="" class="form-control" type="text" name="GrnSub" placeholder="Enter GRN Sub" required="required" id="GrnSub">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="division">Division *</label>
                        <div class="col-sm-9">
                            <select class="form-control formselect required" placeholder="Select Division" id="division" name="division">
                                <option value="0" disabled selected>Select Division</option>
                                @foreach($division as $division)
                                <option  value="{{$division->id}}">
                                    {{ ucfirst($division->deptName) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="issueDate">Issue Date *</label>
                        <div class="col-sm-9">
                            <input value="" class="form-control" type="date" name="issueDate" placeholder="Enter Date" required="required" id="issueDate">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="employee">Employee</label>
                        <div class="col-sm-9">
                        <select class="form-control formselect required" placeholder="Select Employee" id="emp" name="emp">
                            <option value="0" disabled selected>Select Employee</option>
                            @foreach($employee as $employee)
                            <option  value="{{$employee->id}}">
                                {{ ucfirst($employee->fullName) }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="model">Model S/N</label>
                        <div class="col-sm-9">
                        <input value="" class="form-control" type="text" name="model" placeholder="Enter Model S/N" id="model">
                        </div>
                    </div>

		    <div class="form-group form-row">
                        <label class="col-sm-2" for="fx_image">Image of the fixed Asset</label>
                        <div class="col-sm-3">
                            <input type="file" name="fx_image" class="form-control">
                        </div>
                    </div>  

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="remarks">Remarks</label>
                        <div class="col-sm-9">
                            <input value="" class="form-control" type="text" name="remarks" placeholder="Enter Remarks" id="remarks">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="quantity"> Salvage Value </label>
                        <div class="col-sm-9">
                            <input value="" class="form-control" type="text" name="salvage" placeholder="Enter Salvage Value" id="salvage">
                        </div>
                    </div>

                    <br/>

                    <input type="submit" class="btn btn-primary" value="ISSUE">
                    <input type="reset" class="btn btn-warning" value="CLEAR">

                    <br/><br/>

                    <div class="form-group form-row">
                        <label class="col-sm-2" for="supplier"> Quantity </label>
                        <div class="col-sm-9">
                            <input value="" class="form-control" type="text" name="bulkQty" placeholder="Enter Quantity" id="bulkQty">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary" value="BULK ISSUE">

                    <br/><br/>

                    <div class="form-group">
                   	    <label for="req">* Required Feilds</label>
                    </div>

                </form>

                <br/>

                <table class="table table-dark">
                    <th>GIN No</th>
                    <th>Sub GIN No</th>
                    <th>Division</th>
                    <th>F/A Code</th>
                    <th>Employee</th>
                    <th>Issue Date</th>
                    <th>Image</th>

                    @foreach($fxGin as $fxGin)
                        <tr>
                            <td> {{$fxGin->fxGINNo}} </td>
                            <td> {{$fxGin->fxGINSub}} </td>
                            <td> {{$fxGin->deptName}} </td>
                            <td> {{$fxGin->fxCode}} </td>
                            <td> {{$fxGin->empTitle}} <?php echo('')?> {{$fxGin->empInitials}} <?php echo('')?> {{$fxGin->empSurname}}</td>
                            <td> {{$fxGin->fxIDate}} </td>
                            <td> <a href="/Stores/public/fx_image/{{$fxGin->fxPhoto}}"> VIEW  </td>
                        </tr>
                    @endforeach   
                </table>

                <br><br>
                    
            </div>
        </div>     
      </div>
    </div>
</div>      

<style>
    #faccontainer {
        text-align: left;
    }

    h1{
        text-align: center;
    }

</style>

@endsection