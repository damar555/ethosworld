@extends('layouts.master')

@section('content')
    @extends('layouts.content')
    <!-- Main content -->
    @section('main-content')
        <h1>News</h1>
        <div class="container">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah">Add News</a>
            <div class="row">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Image</th>
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
                                <td>
                                    <img src="{{ asset('foto/'.$row->image) }}" alt="" style="width: 80px;">
                                </td>
                                <td>{{ $row->description}}</td>
                                <td>
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit{{$row->id}}">Edit</a>
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
        {{-- modal tambah --}}
        <div class="modal fade" id="modal-tambah">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Tambah News</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="/news" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Title</label>
                      <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <label for="exampleInputPassword1" class="form-label">Category</label>
                    <div class="mb-3">
                      <select class="form-select" name="category" aria-label="Default select example">
                        <option selected>- Pilih Kategori Terkait -</option>
                        <option value="Hiburan">Hiburan</option>
                        <option value="lainya">lainya</option>
                        <option value="Three">Three</option>
                      </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
            
            </div> 
        
        </div>

    @endsection
    <!-- /.modal edit -->
     {{-- modal edit --}}
     @foreach ($data as $d)
     <div class="modal fade" id="modal-edit{{$d->id}}">
         <div class="modal-dialog">
         <div class="modal-content">
         <div class="modal-header">
         <h4 class="modal-title">Edit News</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form action="/news/{{ $d->id }}" method="POST" enctype="multipart/form-data">
         <div class="modal-body">
                 @method('PUT')
                 @csrf
                 <div class="mb-3">
                   <label for="InputTitle" class="form-label">Title</label>
                   <input type="text" name="title" class="form-control" id="InputTitle" value="{{ $d->title }}">
                 </div>

                 <div class="mb-3">
                     <label for="InputCategory" class="form-label">Category</label>
                     <input type="text" name="category" class="form-control" id="InputCategory" value="{{ $d->category }}">
                 </div>

                 <div class="mb-3">
                     <label for="InputDescription" class="form-label">Description</label>
                     <input type="text" name="description" class="form-control" id="InputDescription" value="{{ $d->description }}">
                   </div>
                 
                   <div class="modal-footer justify-content-between">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       <button type="submit" class="btn btn-primary">Save changes</button>
                     </div>
                 </div>
             </form>
         
         </div>
         
         </div> 
         @endforeach
@endsection
{{-- @extends('layouts.master')

@section('content')
    @extends('layouts.content')
    <!-- Main content -->
    @section('main-content')
        <h1>Newsssssshbhh</h1>
        <div class="container">
            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Add News</a>
            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">coba</a>
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

        <!-- Button trigger modal -->
        
  
  <!-- Modal -->
    @endsection
    <!-- /.content -->
@endsection --}}
    