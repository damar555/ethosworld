@extends('layout.master')

@section('content')
    <!-- Main content -->
    <h1>Categories</h1>
    <div class="container">
        <button class="btn btn-success" onclick="create()">+ Add News</button>
        <!-- <button type="button" class="btn btn-success btnTambah" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus"></i> Tambah</button> -->
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
                @php
                    $noRow = 1;
                @endphp
                @foreach ($data as $row)
                    <tr>
                        <th scope="row">{{ $noRow++ }}</th>
                        <td>{{ $row->title }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>{{ $row->updated_at }}</td>
                        <td>
                            <a href="#" class="btn btn-warning" data-toggle="modal"
                                data-target="#modal-edit{{ $row->id }}">Edit</a>
                            <form action="/category/{{ $row->id }}" method="post" class="d-inline">
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

    {{-- new form modal --}}
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="label-modal"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modal-page" class="p-2"></div>
                </div>
            </div>

        </div>

    </div>
    <div id="modalTambah" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="formTambah">
                    <div class="modal-header">
                        <h4 class="modal-title" id="titleLabel">Add</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" maxlength="50"
                                placeholder="Masukan Nama" required>
                            <p class="text-danger"></p>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" id="btnSimpan" class="btn btn-info">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>

    </div>

    {{-- script --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.btnTambah').click(function(reload) {
                $('#formTambah')[0].reset();
            });

        });
        // Show Form Create
        function create() {
            $.get("{{ url('category/create') }}", {}, function(data, status) {
                $("#label-modal").html('Add Category');
                $("#modal-page").html(data);
                $("#modalTambah").modal('show');
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
