@extends('layout.master')

@section('content')
    <!-- Main content -->
    <div class="container">
        <h1>News</h1>
        {{-- <a href="/news/create" class="btn btn-success">Add News</a> --}}
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah">Add News</a>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $noRow = 1;
                    @endphp
                    @foreach ($news as $row)
                        <tr>
                            <th scope="row">{{ $noRow++ }}</th>
                            <td>{{ $row->title }}</td>
                            <td>
                                <img src="{{ asset('/images/news/'.$row->image) }}" alt="" style="width: 80px;">
                            </td>
                            <td>{{ $row->category->title }}</td>
                            <td>{{ $row->description }}</td>
                            <td>
                                {{-- <a href="/news/{{$row->id}}/edit" class="btn btn-warning">Edit</a> --}}
                                {{-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Edit</button> --}}
                                <a href="#" class="btn btn-warning open_modal" data-toggle="modal" data-target="#modal-edit{{$row->id}}">Edit</a>

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
                  <select class="form-select" name="category_id" aria-label="Default select example">
                    {{-- <option selected>- Pilih Kategori Terkait -</option>
                    <option value="Hiburan">Hiburan</option>
                    <option value="lainya">lainya</option>
                    <option value="Three">Three</option> --}}
                    @foreach($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->title}}</option>
                    @endforeach
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

    {{-- modal edit --}}
    @foreach ($news as $d)
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
                    <img src="{{ URL::asset('/images/news/'.$d->image)}}" style="width: 80px;" alt="">
                    <input type="file" name="image" class="form-control">
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

    <script>
        $(document).on('click','.open_modal',function(){
            var url = "domain.com/yoururl";
            var tour_id= $(this).val();
            $.get(url + '/' + tour_id, function (data) {
                //success data
                console.log(data);
                $('#tour_id').val(data.id);
                $('#name').val(data.name);
                $('#details').val(data.details);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            }) 
        });
    </script>
@endsection
    