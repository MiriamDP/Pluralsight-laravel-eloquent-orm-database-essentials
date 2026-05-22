@auth
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Billing Code</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach (\App\Models\JobCode::all() as $job)
      <tr>
        <td>{{ $job->name }}</td>
        <td>{{ $job->billing_code }}</td>
        <td><a href="/admin/job?job={{ $job->id }}'">Edit</a></td>
      </tr>
    @endforeach
  </tbody>
</table>
@endauth
