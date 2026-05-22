@extends('layouts.default')
@section('title', 'Settings')
@section('content')
@php
  $user = Auth::user();
@endphp

@if (Session::has('success'))
<p class="success">Settings Updated</p>
@endif

<form method="POST">
  @csrf
  <label>
    Name
    <input name="email" type="text" value="{{ $user->name }}" autofocus required>
  </label>
  <label>
    Email
    <input name="email" type="text" value="{{ $user->email }}" required>
  </label>
  <label>
    Password
    <input name="password" type="password">
  </label>
  <button type="submit">Save</button>
  @if (session('error'))
    <span class="error">{{ session('error') }}</span>
  @endif
</form>
@endsection
