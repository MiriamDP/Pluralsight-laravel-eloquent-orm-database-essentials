@extends('layouts.default')
@section('title', 'Admin - User')
@section('content')
@php
  $user = \App\Models\User::find(request()->get('user'));
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
  <label>
    Admin
    <input type="checkbox" name="admin"
      {{ $user->isAdmin() ? 'checked' : '' }}
      {{ Auth::user()->id == $user->id ? 'disabled' : '' }}
      >

    {{-- <input name="admin" type="password"> --}}
  </label>

  <button type="submit">Save</button>
  <button type="button" onclick="location.href='/admin'">Cancel</button>
  @if (session('error'))
    <span class="error">{{ session('error') }}</span>
  @endif
</form>
@endsection
