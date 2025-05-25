<!DOCTYPE html>
@extends('layouts.mainlayout')

@section('title','Academic Employees')

@section('content')
<div class="container">
  <div class="row">

    <div class="container" id="faccontainer">

    <h1> Academic Employee Details</h1>
        <div class="row">
                <div class="col-md-12">
               
                <form action="\saveacademicemp" method="POST"> 
                {{csrf_field()}}
                <div class="form-group form-row">
                <label class="col-sm-3" for="input-epfno">EPF No</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="epfno" placeholder="Enter EPF Number" required="required" id="epfno">

        
        
              </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-NIC">NIC</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="NIC" placeholder="Enter NIC" required="required" id="NIC">

        </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-title">Title</label>
                <div class="col-sm-9">
              <select class="form-control" name="selecttitle" id="selecttitle">
                  <option>
           Rev.
          </option>
                  <option>
            Mr.
          </option>
                  <option>
            Miss
          </option>
                  <option>
            Mrs.
          </option>
              </select>
              </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-surname">Surname</label>
                <div class="col-sm-9">
        
        <input value="" class="form-control" type="text" name="surname" placeholder="Enter the Surname" required="required" id="surname">
                </div>
              </div>
        
              </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-initials">Initials names</label>
                <div class="col-sm-9">
                <input value="" class="form-control" type="text" name="initials" placeholder="Enter Initial names" required="required" id="initials">
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-namesi">Names denoted by initials</label>
                <div class="col-sm-9">
                <input value="" class="form-control" type="text" name="namesi" placeholder="Enter Names denoted by Initials" required="required" id="namesi">
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-title">Gender</label>
                <div class="col-sm-9" style="align:left">
                <label class="radio-inline">
                <input type="radio" id="male" name="gender" value="male">Male
              </label>
              <label class="radio-inline">
            <input type="radio" id="female" name="gender" value="female">Female
            </label>
           
               
              </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-title">Lay/Monk</label>
                <div class="col-sm-9" style="align:left">
                <label class="radio-inline">
                <input type="radio" id="lay" name="laymonk" value="lay">Lay
            </label>
               <label class="radio-inline">
            <input type="radio" id="monk" name="laymonk" value="monk">Monk
            </label>
              </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-title">Academin/Non-Academic</label>
                <div class="col-sm-9" style="align:left">
                <label class="radio-inline">
                <input type="radio" id="academict" name="academict" value="academic">Academic
            </label>
               <label class="radio-inline">
            <input type="radio" id="nonacademic" name="academict" value="nonacademic">Non_Academic
            </label>
              </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-title">Research or Not</label>
                <div class="col-sm-9" style="align:left">
                <label class="radio-inline">
                <input type="radio" id="ryes" name="research" value="ryes">Research
            </label>
               <label class="radio-inline">
            <input type="radio" id="rno" name="research" value="rno">Not Research
            </label>
              </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-upfno">UPF No</label>
                <div class="col-sm-9">
                <input value="" class="form-control" type="text" name="upfno" placeholder="Enter UPF No" required="required" id="input-upfno">
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-etfno">ETF No</label>
                <div class="col-sm-9">
                <input value="" class="form-control" type="text" name="etfno" placeholder="Enter ETF No" required="required" id="input-address1">
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-address1">Addreass 1</label>
                <div class="col-sm-9">
                <input value="" class="form-control" type="text" name="address1" placeholder="Enter Address 1" required="required" id="input-address1">
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-namesi">Address 2</label>
                <div class="col-sm-9">
                <input value="" class="form-control" type="text" name="address2" placeholder="Enter address 2" required="required" id="input-address2">
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-namesi">Address 3</label>
                <div class="col-sm-9">
                <input value="" class="form-control" type="text" name="address3" placeholder="Enter Address 3" required="required" id="input-address3">
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-emptypt">Select Employee Type</label>
                <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Employee Type" id="emptypeSelect" name="emptypeSelect">
                  <option>
           type1
          </option>
                  <option>
                  type2
          </option>
                  <option>
                  type3
          </option>
                  <option>
                  type4
          </option>
              </select>


              
               </div>
               </div>
               <div class="form-group form-row">
                <label class="col-sm-3" for="input-empstatus">Select Employee Status</label>
                <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Employee Status" id="empstatusSelect" name="empstatusSelect">
                <option>
           status1
          </option>
                  <option>
                  status2
          </option>
                  <option>
                  status3
          </option>
                  <option>
                  status4
          </option>
                            
                        </select>
               </div>
               </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-dept">Select department</label>
                <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Department" id="deptSelect" name="deptSelect">
                <option value="0" disabled selected>Select Department*</option>
                            @foreach($dept as $depts)
                            <option  value="{{$depts->id}}">
                                {{ ucfirst($depts->dname) }}</option>
                            @endforeach
                        </select>
                
                         
                            
                      
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-desig">Select Designation</label>
                <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Designation" id="desigSelect" name="desigSelect">
                <option value="0" disabled selected>Select Designation*</option>
                            @foreach($desig as $desigs)
                            <option  value="{{$desigs->id}}">
                                {{ ucfirst($desigs->designation) }}</option>
                            @endforeach
                        </select>


               
                          
                            
                        
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-odesig">Select Other Designation</label>
                <div class="col-sm-9">
                <select class="form-control formselect required" placeholder="Select Designation" id="odesigSelect" name="odesigSelect">
                <option value="0" disabled selected>Select Designation*</option>
                            @foreach($desig as $desigs)
                            <option  value="{{$desigs->id}}">
                                {{ ucfirst($desigs->designation) }}</option>
                            @endforeach
                        </select>
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-grade">Select Grade</label>
                <div class="col-sm-9">
                


                <select class="form-control formselect required" placeholder="Select Grade" id="gradeSelect" name="gradeSelect">
                <option>
           grade1
          </option>
                  <option>
                  grade2
          </option>
                  <option>
                  grade3
          </option>
                  <option>
                  grade4
          </option>
                        </select>
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-dob">Date of Birth</label>
                <div class="col-sm-9">
                <input value="" class="form-control" type="date" name="dob" placeholder="default" required="required" id="input-dob">
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-doa">Date of Appointment</label>
                <div class="col-sm-9">
                <input value="" class="form-control" type="date" name="doa" placeholder="default" required="required" id="input-doa">
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-dos">Date of Assumed Duties</label>
                <div class="col-sm-9">
                <input value="" class="form-control" type="date" name="dos" placeholder="default" required="required" id="input-dos">
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-doc">Date of Confirmed</label>
                <div class="col-sm-9">
                <input value="" class="form-control" type="date" name="doc" placeholder="default" required="required" id="input-doc">
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-doi">Date of Incerment</label>
                <div class="col-sm-9">
                <input value="" class="form-control" type="date" name="doi" placeholder="default" required="required" id="input-doi">
               </div>
              </div>
              </br>
                <input type="submit" class="btn btn-primary" value="SAVE">
                <input type="button" class="btn btn-warning" value="CLEAR">
                </br> </br>     
                </form>
                <table class="table table-dark">
                <th>ID</th>
                <th>FACULTY NAME</th>
                <th>DEPARTMENT NAME</th>
                <th>IsActive</th>
                @foreach($empdata as $empdatas)
                <tr>
                <td> {{$empdatas->empepf}} </td>
                <td>  {{$empdatas->empNIC}} </td>
                <td>  {{$empdatas->empNames}} </td>
                <td>  {{$empdatas->IsActive}} </td>
                <td>
     
    <a href="/deleteemp/{{$empdatas->id}}" class="btn btn-danger">Delete</a>
    <a href="/updateemp/{{$empdatas->id}}" class="btn btn-warning">Update</a>
    </td>
                </tr></table>
                @endforeach       
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

h1{
    text-align: center;
}

</style>
@endsection