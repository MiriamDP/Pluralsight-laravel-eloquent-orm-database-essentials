@extends('layouts.default')
@section('title', 'Admin')
@section('content')

<h2>Job Codes</h2>
@include('components/admin/jobs')

<h2>Users</h2>
@include('components/admin/users')

@endsection
