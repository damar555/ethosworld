@extends('layout.master')

@section('content')
    <!-- Main content -->
    <div class="container">
        <h1>Users</h1>
        <a href="/user/create" class="btn btn-success">Add News</a>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
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
                            <td>{{ $row->name}}</td>
                            <td>{{ $row->email}}</td>
                            <td>
                                {{-- <a href="/news/{{$row->id}}/edit" class="btn btn-warning">Edit</a> --}}
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Edit</button>
                                <form action="/news/{{$row->id}}" method="post" class="d-inline">
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
    <!-- /.content -->
@endsection
    