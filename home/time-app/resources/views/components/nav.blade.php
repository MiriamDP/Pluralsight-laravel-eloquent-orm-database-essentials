@auth
  <nav>
    <ul>
      <li @class(['active' => URL::current() == route('home')])>
        <a href="/">Home</a>
      </li>
      <li @class(['active' => URL::current() == route('entries')])>
        <a href="/entries">Time Entry</a>
      </li>
      <li @class(['active' => URL::current() == route('settings')])>
        <a href="/settings">Settings</a>
      </li>
      @if(Auth::user() && Auth::user()->info->admin)
      <li @class(['active' => URL::current() == route('admin')])>
        <a href="/admin">Admin</a>
      </li>
      @endif
      <li class="logout">
        <a href="/logout">Logout</a>
      </li>
    </ul>
  </nav>
@endauth
