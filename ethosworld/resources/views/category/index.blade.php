@extends('layout.master')

@section('content')
    <!-- Main content -->
    <h1>Categories</h1>
    <div class="container">
        {{-- <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah">Add News</a> --}}
        <button class="btn btn-success" onclick="create()">+ Add News</button>

        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Created_ad</th>
                    <th scope="col">Updated_ad</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    {{-- @php
                        $noRow = 1;
                    @endphp
                    @foreach ($data as $row)
                        <tr>
                            <th scope="row">{{ $noRow++ }}</th>
                            <td>{{ $row->title}}</td>
                            <td>{{ $row->created_at}}</td>
                            <td>{{ $row->updated_at}}</td>
                            <td>
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit{{$row->id}}">Edit</a>
                                <form action="/kategori/{{$row->id}}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr> 
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div> 
    <!-- /.content -->

    {{-- modal tambah --}}
    {{-- <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Tambah Kategori</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="/kategori" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
        
        </div> 
    
    </div> --}}
    
     {{-- modal edit --}}
    {{-- @foreach ($data as $d)
     <div class="modal fade" id="modal-edit{{$d->id}}">
         <div class="modal-dialog">
         <div class="modal-content">
         <div class="modal-header">
         <h4 class="modal-title">Edit Categori</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form action="/kategori/{{ $d->id }}" method="POST" enctype="multipart/form-data">
         <div class="modal-body">
                 @method('PUT')
                 @csrf
                 <div class="mb-3">
                   <label for="InputTitle" class="form-label">Title</label>
                   <input type="text" name="title" class="form-control" id="InputTitle" value="{{ $d->title }}">
                 </div>
    
                   <div class="modal-footer justify-content-between">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       <button type="submit" class="btn btn-primary">Save changes</button>
                     </div>
                 </div>
             </form>
         
         </div>
         
         </div> 
    @endforeach --}}

    {{-- new form modal --}}
    <div class="modal fade" id="form-modal">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="label-modal"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        {{-- <form action="/kategori" method="POST" enctype="multipart/form-data"> --}}
            <div class="modal-body">
                <div id="modal-page" class="p-2"></div>
                {{-- @csrf --}}
                {{-- <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div> --}}
            </div>
            {{-- <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div> --}}
        {{-- </form> --}}
        </div>
        
        </div> 
    
    </div>


    {{-- script --}}
    <script>
        $(document).ready(function () {
            
        });

        // Show Form Create
        function create() {
            $.get("{{url('category/create')}}", {},function(data, status) {
                $("#label-modal").html('Add Category');
                $("#modal-page").html(data);
                $("#form-modal").modal('show');
            });
        }

        // Create New Category
        function store() { 
            // var name = $("#title").val();
            // $.ajax({
            //     type: "post",
            //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            //     url: "{{ url('category') }}",
            //     data: "title="+title,
            //     success: function (data) {
            //         // $("#modal-page").html('');
            //         // // $("#form-data")[0].reset();
            //         // $(".btn-close").click();

            //     }
            // });
            if ($('#title').val() == "") {
                swal.fire("Peringatan!", "Title cannot be null!.", "warning");
                $("#nama").focus();
            } else {
                console.log("OKey");
            }
        }
    </script>
@endsection

    