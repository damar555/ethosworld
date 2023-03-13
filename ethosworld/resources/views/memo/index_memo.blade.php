@extends('layout.master')

@section('content')
    <!-- Main content -->
    <h1>Memo</h1>
    <div class="container">
        <button class="btn btn-success addItem" data-toggle="modal" data-target="#modalTambah">Add Memo</button>
        <div class="row">
            <table id="mytbl" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Description</th>
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
                            <td>{{ $row->from_who }}</td>
                            <td>{{ $row->to_who }}</td>
                            <td>{{ $row->subject }}</td>
                            <td>{{ $row->description }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>{{ $row->updated_at }}</td>
                            <td>
                                <!-- <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="show({{ $row->id }})">Edit</button> -->
                                <button type="button" class="btn btn-warning"
                                    onclick="show({{ $row->id }})">Edit</button>
                                    <button type="button" class="btn btn-danger" onclick="destroy({{ $row->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- modal tambah --}}
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Memo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title...">
                        </div>
                        <div class="mb-3">
                            <label for="from_who" class="form-label">From</label>
                            <input type="text" name="from_who" class="form-control" id="from_who" placeholder="From...">
                        </div>
                        <div class="mb-3">
                            <label for="to_who" class="form-label">To</label>
                            <input type="text" name="to_who" class="form-control" id="to_who" placeholder="To...">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" id="subject"
                                placeholder="Subject...">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Description...">
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="store()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

{{-- modal edit --}}
    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Categori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_edit" method="">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="{{ $row->id }}" id="id1" name="id1">
                        <div class="mb-3">
                            <label for="InputTitle" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="title1"
                                value="{{ $row->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="from" class="form-label">From</label>
                            <input type="text" name="from_who" class="form-control" id="from_who1"
                                value="{{ $row->from_who }}">
                        </div>
                        <div class="mb-3">
                            <label for="to" class="form-label">To</label>
                            <input type="text" name="to_who" class="form-control" id="to_who1"
                                value="{{ $row->to_who }}">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" id="subject1"
                                value="{{ $row->subject }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="textera" name="description" class="form-control" id="description1"
                                value="{{ $row->description }}">
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="update({{ $row->id }})">Save changes</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

<script>
    // $('.addItem').click(function(reload) {
    //     $('#form-tambah')[0].reset();
    // });

    function store() {
            if ($('#title').val() == "") {
                swal.fire("Peringatan!", "Judul tidak boleh kosong!", "warning");
                $("#title").focus();
            } else if ($('#from_who').val() == "") {
                swal.fire("Peringatan!", "From tidak boleh kosong!", "warning");
                $("#from_who").focus();
            } else if ($('#to_who').val() == "") {
                swal.fire("Peringatan!", "To tidak boleh kosong!", "warning");
                $("#to_who").focus();
            } else if ($('#subject').val() == "") {
                swal.fire("Peringatan!", "Subject berita tidak boleh kosong!", "warning");
                $("#subject").focus();
            } else if ($('#description').val() == "") {
                swal.fire("Peringatan!", "Deskripsi berita tidak boleh kosong!", "warning");
                $("#description").focus();
            } else {
                var data = $('#form-tambah').serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('memo') }}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    //dataType: "JSON",
                    success: function(h) {

                        $('#modalTambah').modal('hide');
                        var table = $('#mytbl').DataTable();
                        table.ajax.reload(null, false);
                        swal.fire("Sukses!", h.message, h.status);

                    }

                });
            }
        }
        function show(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('memo') }}" + "/" + id,
                success: function(response) {
                    $('#id-edit').val(response.id);
                    $('#title1').val(response.title);
                    $('#from_who1').val(response.from_who);
                    $('#to_who1').val(response.to_who);
                    $('#subject1').val(response.subject);
                    $('#description1').val(response.description);
                    $('#modalEdit').modal('show');
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        function update(id) { 
            if ($('#title1').val() == "") {
                swal.fire("Peringatan!", "Judul tidak boleh kosong!", "warning");
                $("#title1").focus();
            } else if ($('#from_who1').val() == "") {
                swal.fire("Peringatan!", "From tidak boleh kosong!", "warning");
                $("#from_who1").focus();
            } else if ($('#to_who1').val() == "") {
                swal.fire("Peringatan!", "To tidak boleh kosong!", "warning");
                $("#to_who1").focus();
            } else if ($('#subject1').val() == "") {
                swal.fire("Peringatan!", "Subject berita tidak boleh kosong!", "warning");
                $("#subject1").focus();
            } else if ($('#description1').val() == "") {
                swal.fire("Peringatan!", "Deskripsi berita tidak boleh kosong!", "warning");
                $("#description1").focus();
            } else {
                var data = $('#form-edit').serialize();
                $.ajax({
                    type: "get",
                    url: "{{ url('memo/update') }}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    //dataType: "JSON",
                    success: function(h) {
                        // var table = $('#mytbl').DataTable();
                        // table.ajax.reload(null, false);
                        swal.fire("Sukses!", h.message, h.status);
                        $('#modalEdit').modal('hide');
                    }

                });
            }
        }

    $(document).ready(function() {
        $('.addItem').click(function(reload) {
            $('#form-tambah')[0].reset();
        });
    });
</script>
@endsection
