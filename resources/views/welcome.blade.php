<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<br><br><br>
<br><br><br>
<br><br><br>
<table class="container">
    <thead>
    <tr>
        <th>EmployeeId</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Title</th>
        <th> Manager Id</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{$item->EmployeeId}}</td>
            <td>{{$item->FirstName}}</td>
            <td>{{$item->LastName}}</td>
            <td>{{$item->Title}}</td>
            <td><a href="{{$item->ManagerId}}"> {{$item->ManagerId}} </a></td>
        </tr>
    @endforeach
    </tbody>
</table>


<br><br><br>
<div class="container">
    <a href="/destroy"> Destroy table. </a>
</div>

