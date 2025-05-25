@extends('layouts.mainlayout')

  
@section('title','Update Department')
@section('content')


<div class="container" id="container_department">
  
  <div class="row" style="align:center">
              
    <div class="col-md-12">
    
    
    <form  method="post" action="/updateempdata">
                    {{csrf_field()}}
                <br> <br> <br> 

                <div class="form-group form-row">
                <label class="col-sm-3" for="input-empid">Employee ID</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="empid" placeholder="Update Employee Name" name="empid" value="{{$singleuserdata->id}}" Readonly>
               </div>
              </div>
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-empid">EPF No</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="epfno" placeholder="Update EPF No" name="epfno" value="{{$singleuserdata->empepf}}" required>
               </div>
              </div>              
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-NIC">NIC</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="nic" placeholder="Update NIC" name="nic" value="{{$singleuserdata->empNIC}}" required>
             </div>
             </div>   
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-surname">Surname</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="surname" placeholder="Update Surname" name="surname" value="{{$singleuserdata->empSurname}}" required>
             </div>
             </div> 
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-initials">Initials</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="initials" placeholder="Update Initials" name="initials" value="{{$singleuserdata->empInitials}}" required>
             </div>
             </div> 
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-NIC">NIC</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="names" placeholder="Update Name Initials" name="names" value="{{$singleuserdata->empNames}}" required>
             </div>
             </div>  
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-title">Gender</label>
                <div class="col-sm-9" style="align:left">
                <label class="radio-inline">
                <input type="radio" id="male" name="gender" value="male"  {{ $singleuserdata->empGender == 'male' ? 'checked' : '' }}>Male
              </label>
              <label class="radio-inline">
            <input type="radio" id="female" name="gender" value="female" {{ $singleuserdata->empGender == 'female' ? 'checked' : '' }}>Female
            </label>
              </div>
              </div> 
              <div class="form-group form-row">
                <label class="col-sm-3" for="input-title">Academic or Not</label>
                <div class="col-sm-9" style="align:left">
                <label class="radio-inline">
                <input type="radio" id="academic" name="academic" value="Academic"  {{ $singleuserdata->empAcademic == 'academic' ? 'checked' : '' }}>Academic
              </label>
              <label class="radio-inline">
            <input type="radio" id="nonacademic" name="nonacademic" value="Non_Academic" {{ $singleuserdata->empAcademic == 'Non-Academic' ? 'checked' : '' }}>Non-Academic
            </label>
                       
              </div>
              </div>
             
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-address1">Address 1</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="address1" placeholder="Update Address 1" name="address1" value="{{$singleuserdata->empAddress1}}" required>
             </div>
             </div>
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-address1">Address 2</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="address2" placeholder="Update Address 2" name="address2" value="{{$singleuserdata->empAddress2}}" required>
             </div>
             </div>
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-address3">Address 3</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="address3" placeholder="Update Address 3" name="address1" value="{{$singleuserdata->empAddress3}}" required>
             </div>
             </div>
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-address3">Department</label>
                <div class="col-sm-9">

             <select class="form-control formselect required" placeholder="Select Department" id="departmentSelect" name="departmentSelect">
                      @foreach($dname as $dnames)
                      <option value="'{{ucfirst($dnames->id)}}'"  selected> {{ucfirst($dnames->dname)}}</option>
                      @endforeach
                      
                            @foreach($task as $tasks)
                            <option  value="{{$tasks->id}}">
                                {{ ucfirst($tasks->dname) }}</option>
                            @endforeach
                           
                        </select>
                        </div>   
                        </div>    
                        <div class="form-group form-row">
                <label class="col-sm-3" for="input-designation">Designation</label>
                <div class="col-sm-9">

             <select class="form-control formselect required" placeholder="Select Designation" id="designationSelect" name="designationSelect">
                      @foreach($desig as $desigs)
                      <option value="'{{ucfirst($desigs->id)}}'"  selected> {{ucfirst($desigs->designation)}}</option>
                      @endforeach
                      
                            @foreach($task2 as $task2s)
                            <option  value="{{$task2s->id}}">
                                {{ ucfirst($task2s->designation) }}</option>
                            @endforeach
                           
                        </select>
                        </div>   
                        </div>   
                        <div class="form-group form-row">
                <label class="col-sm-3" for="input-odesignation">Other Designation</label>
                <div class="col-sm-9">

             <select class="form-control formselect required" placeholder="Update Other Designation" id="odesignationSelect" name="odesignationSelect">
                      @foreach($desig as $desigs)
                      <option value="'{{ucfirst($desigs->id)}}'"  selected> {{ucfirst($desigs->designation)}}</option>
                      @endforeach
                      
                            @foreach($task2 as $task2s)
                            <option  value="{{$task2s->id}}">
                                {{ ucfirst($task2s->designation) }}</option>
                            @endforeach
                           
                        </select>
                        </div>   
                        </div>            
                        <div class="form-group form-row">
                <label class="col-sm-3" for="input-dob">Date of Birth</label>
                <div class="col-sm-9">
                <input type="date" class="form-control" id="dob" placeholder="Update Date of Birth" name="dob" value="{{$singleuserdata->empDtBirth}}" required>
             </div>
             </div>
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-doa">Date of Appointment</label>
                <div class="col-sm-9">
                <input type="date" class="form-control" id="doa" placeholder="Update Date of Appointment" name="doa" value="{{$singleuserdata->empDtAppt}}" required>
             </div>
             </div>
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-doi">Date of Increment</label>
                <div class="col-sm-9">
                <input type="date" class="form-control" id="doi" placeholder="Update Date of Increment" name="doi" value="{{$singleuserdata->empDtIncr}}" required>
             </div>
             </div>
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-dos">Date of duty Assumed</label>
                <div class="col-sm-9">
                <input type="date" class="form-control" id="dos" placeholder="Update Date of Duty Assumed" name="dos" value="{{$singleuserdata->empDtAssm}}" required>
             </div>
             </div>
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-doc">Date of Confirmation</label>
                <div class="col-sm-9">
                <input type="date" class="form-control" id="doc" placeholder="Update Date of Confirmation" name="doc" value="{{$singleuserdata->empDtConf}}" required>
             </div>
             </div>
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-upf">UPF No</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="upf" placeholder="Update UPF No" name="upf" value="{{$singleuserdata->empUPFNo}}" required>
             </div>
             </div>
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-upf">ETF No</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="etf" placeholder="Update ETF No" name="etf" value="{{$singleuserdata->empETFNo}}" required>
             </div>
                       
             </div>
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-upf"></label>
                <div class="col-sm-9">
                <button type="submit" class="btn btn-primary">Update</button>      
             </div>
                       
             </div>
             <div class="form-group form-row">
                <label class="col-sm-3" for="input-upf"></label>
             <div class="form-group form-row">
             <button type="text" class="btn btn-primary"></button>            
               </div>   </div> 
                </form>
    
    </div>

    

  </div>
  </div>

@endsection