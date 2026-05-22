@extends('layouts.default')
@section('title', 'Admin - Job Code')
@section('content')
@php
  $job = \App\Models\JobCode::find(request()->get('job'));
@endphp

@if (Session::has('success'))
<p class="success">Settings Updated</p>
@endif

<form method="POST">
  @csrf
  <label>
    Name
    <input name="name" type="text" value="{{ $job->name }}" autofocus required>
  </label>
  <label>
    Email
    <input name="billing_code" type="text" value="{{ $job->billing_code }}" required>
  </label>

  <button type="submit">Save</button>
  <button type="button" onclick="location.href='/admin'">Cancel</button>
  @if (session('error'))
    <span class="error">{{ session('error') }}</span>
  @endif
</form>
@endsection
