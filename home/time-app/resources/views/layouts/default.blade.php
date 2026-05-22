<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Time Tracker - @yield("title")</title>
  <link href="{{ asset('style.scss') }}" rel="stylesheet">
</head>
<body>
  <header>
    <h1>Time Tracker - @yield('title')</h1>
    @include('components/nav')
  </header>
  <main>
    @yield('content')
  </main>
  <footer>
    &copy;{{ date('Y') }} All rights reserved.
  </footer>
</body>
</html>
