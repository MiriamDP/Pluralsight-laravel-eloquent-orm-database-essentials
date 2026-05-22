@extends('layouts.default')
@section('title', 'Home')
@section('content')
  <p>Welcome to the time tracker, {{ Auth::user()->name }}.</p>

  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi laborum distinctio modi reprehenderit eveniet voluptatum dicta numquam aperiam molestiae rerum sed nisi necessitatibus minima similique aut, nobis, explicabo, veritatis expedita?</p>

  <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vero ut fugit, ullam hic debitis qui eligendi quia animi facere dicta nostrum incidunt perspiciatis voluptatem ducimus sapiente. Voluptatibus in ea praesentium.</p>
@endsection
