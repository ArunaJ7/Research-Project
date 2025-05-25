<!DOCTYPE html>
@extends('layouts.mainlayout')



@section('content')
<html lang="en">
<head>
    
    <title>Document</title>
</head>
<body>
<table style="width:50%">
<div class="container">
    <div class="text-center">
    <br> <br> <br> <br> <br> <br> <br> <br> <br> 
   <h1> Faculty Details</h1>
        <div class="row" style="align:center">
                <div class="col-md-12">
               
                <form action="\savefaculty" method="POST"> 
                {{csrf_field()}}
                <input type="text" class="form-control" name="facultyname" placeholder="Enter the Faculty Name Here">
                
                </br>
                <input type="submit" class="btn btn-primary" value="SAVE">
                <input type="button" class="btn btn-warning" value="CLEAR">
                </br> </br>     
                </form>
                
           
                
    
</body>
</html>