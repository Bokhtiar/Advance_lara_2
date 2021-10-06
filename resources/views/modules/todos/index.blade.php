@extends('welcome')
@section('user_content')


<a href="{{ route('todos.create') }}">Todo Create</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Index</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
    </tr>
  </tbody>
</table>


@endsection
