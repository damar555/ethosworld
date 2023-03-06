@extends('layout.template')

@section('content')
<div class="container">
    <a href="/news/create" class="btn btn-success">Add News</a>
    <div class="row">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $noRow = 1;
                @endphp
                @foreach ($data as $row)
                    <tr>
                        <th scope="row">{{ $noRow++ }}</th>
                        <td>{{ $row->title}}</td>
                        <td>{{ $row->category}}</td>
                        <td>{{ $row->description}}</td>
                        <td>
                            <a href="/news/{{$row->id}}/edit" class="btn btn-warning">Edit</a>
                            <form action="/news/{{$row->id}}"" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr> 
                @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection
    