@auth
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Admin</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach (\App\Models\User::all() as $user)
      <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->info->admin == 1 ? 'Yes' : 'No' }}</td>
        <td>
          <a href="/admin/user?user={{ $user->id}}">Edit</a>
          |
          <a href="/admin/entries?user={{ $user->id}}">Entries</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endauth
