@extends('layouts.default')
@section('title', 'Admin Entries')
@section('content')

@php
  $userid = request()->get('user');
  $user = \App\Models\User::find($userid);
@endphp

<h2>Time Entries for {{ $user->name }}</h2>

@session('success')
  <p class="success">{{ $value }}</p>
@endsession

@foreach ($errors->all() as $error)
  <p class="error">{{ $error }}</p>
@endforeach

<table>
  <thead>
    <tr>
      <th>Job</th>
      <th>Date</th>
      <th>Hours</th>
      <th>Description</th>
      <th>Approval</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($user->entries as $entry)
      <tr>
        <td>{{ $entry->job->name }}</td>
        <td>{{ $entry->entry_date->format('m/d/Y') }}</td>
        <td>{{ $entry->hours }}</td>
        <td>{{ $entry->description }}</td>
        <td style="text-align: center">
          @foreach ($entry->approvals as $approval)
            <div>{{ $approval->approver->name }}</div>
          @endforeach
          @if ($entry->myApproval->isEmpty())
            <a href="/admin/entries/approve?id={{ $entry->id}}">Approve</a>
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<button type="button"
  style="margin-top:1em;"
  onclick="location.href='/admin'">Back to Admin</button>

@endsection
