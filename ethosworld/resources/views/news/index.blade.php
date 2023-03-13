@extends('layout.master')

@section('content')
    <!-- Main content -->
    <div class="container">
        <h1>Berita</h1>
        <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah" class="fa fas-plus">Tambah
            Berita</button>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Action</th>
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
                            <img src="{{ asset('/images/news/' . $row->image) }}" alt="" style="width: 80px;">
                        </td>
                        <td>{{ $row->category->title }}</td>
                        <td>{{ $row->description }}</td>
                        <td>
                            <button type="button" class="btn btn-warning"
                                onclick="showNews({{ $row->id }})">Edit</button>

                            <form action="/news/{{ $row->id }}" method="post" class="d-inline">
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
    <!-- /.content -->

    {{-- modal tambah --}}
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah News</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah">
                        <div class="form-group">
                            <label class="form-label">Judul</label>
                            <input type="text" name="title" class="form-control" id="title"
                                placeholder="Masukan judul berita...">
                        </div>
                        <label class="form-label">Kategori</label>
                        <div class="form-group">
                            <select class="form-select" name="category_id" id="category_id">
                                <option selected value="">- Pilih Kategori Terkait -</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Gambar</label>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="description" class="form-control" id="description"
                                placeholder="Masukan deskripsi berita...">
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btnTambah" onclick="storeNews()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Berita</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-news-form">
                        <input type="hidden" id="id-edit" name="id-edit" value="{{$row->id}}">
                        <div class="form-group">
                            <label class="form-label">Judul</label>
                            <input type="text" name="title" class="form-control"
                                id="title-edit" placeholder="Masukan judul berita...">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="category_id" id="category-edit">
                                <option selected value="">- Pilih Kategori Terkait -</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $row->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Gambar</label>
                            <br>
                            <img src="#" alt="" style="width: 80px;" id="image-preview-edit">
                            <input type="file" name="image" class="form-control" id="image-edit">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="description" value="{{ $row->description }}"
                                class="form-control" id="description-edit" placeholder="Masukan deskripsi berita...">
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="updateNews()">Simpan</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>
        function storeNews() {
            let title = $('#title').val();
            let category_id = $('#category_id').val();
            let description = $('#description').val();
            let fileUpload = $("#image")[0];

            let data = new FormData();
            let file = fileUpload.files[0];
            data.append('title', title);
            data.append('category_id', category_id);
            data.append('description', description);
            data.append('image', file);

            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.jpeg)$/;
            if (regex.test(fileUpload.value.toLowerCase())) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "news",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(h) {
                        swal.fire("Sukses!", h.message, h.status);
                        // var table = $('#tabel').DataTable();
                        // table.ajax.reload(null, false);
                        $('#form-tambah')[0].reset();
                        $('#modalTambah').modal('hide');

                    }
                });
            }
            return false;
        }

        // Show data modal
        function showNews(id) { 
            $.ajax({
                type: "GET",
                url: "{{ route('news') }}" + "/" + id,
                success: function(response) {
                    $('#id-edit').val(response.id);
                    $('#title-edit').val(response.title);
                    $('#category-edit').val(response.category_id);
                    $('#description-edit').val(response.description);
                    // $('#image-preview-edit').attr('src', "{{ asset('/images/news/') }}" + response.image);
                    $('#modalEdit').modal('show');
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        //
        function updateNews() {
            let idEdit = $('#id-edit').val();

            let titleEdit = $('#title-edit').val();
            let categoryEdit = $('#category-edit').val();
            let descriptionEdit = $('#description-edit').val();

            let imageEdit = $("#image-edit")[0];
            let fileEdit = imageEdit.files[0];

            var dataEdit = new FormData();
            dataEdit.append('id',idEdit);
            dataEdit.append('title', titleEdit);
            dataEdit.append('category_id', categoryEdit);
            dataEdit.append('description', descriptionEdit);
            dataEdit.append('image', fileEdit);
            dataEdit.append('_method', 'PUT');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('news') }}" + "/" + idEdit,
                data: dataEdit,
                contentType: false,
                processData : false,
                success: function(response) {
                    swal.fire("Sukses!", response.message, response.status);
                    $('#edit-news-form')[0].reset();
                    $('#modalEdit').modal('hide');
                },
                error: function(response) {
                    console.log(response);  
                }
            });
        }
    </script>
@endsection