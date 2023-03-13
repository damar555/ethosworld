@extends('layout.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">News</div>

                    <div class="card-body">
                        <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#add-news-modal">Add News</button>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td><img src="{{ asset('images/' . $item->image) }}" width="100"></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit-btn"
                                                data-id="{{ $item->id }}">Edit</button>
                                            <button class="btn btn-sm btn-danger delete-btn"
                                                data-id="{{ $item->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add News Modal -->
    <div class="modal fade" id="add-news-modal" tabindex="-1" role="dialog" aria-labelledby="add-news-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-news-modal-label">Add News</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="add-news-form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close<button type="button"
                                class="btn btn-primary" id="add-news-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit News Modal -->
    <div class="modal fade" id="edit-news-modal" tabindex="-1" role="dialog" aria-labelledby="edit-news-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-news-modal-label">Edit News</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-news-form">
                    <div class="modal-body">
                        <input type="hidden" id="edit-news-id" name="id">
                        <div class="form-group">
                            <label for="edit-title">Title</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-category_id">Category</label>
                            <select class="form-control" id="edit-category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-description">Description</label>
                            <textarea class="form-control" id="edit-description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit-image">Image</label>
                            <input type="file" class="form-control-file" id="edit-image" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="edit-news-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    //test
    $(document).ready(function() {
        // Add News Modal
        $('#add-news-btn').click(function() {
            var formData = new FormData($('#add-news-form')[0]);

            $.ajax({
                type: 'POST',
                url: '{{ route('test') }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#add-news-modal').modal('hide');
                    location.reload();
                },
                error: function(data) {
                    var errors = data.responseJSON.errors;
                    var errorMessage = '';

                    $.each(errors, function(key, value) {
                        errorMessage += '<p>' + value[0] + '</p>';
                    });

                    $('#add-news-form').prepend('<div class="alert alert-danger">' +
                        errorMessage + '</div>');   
                }
            });
        });

        // Edit News Modal
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');

            $.ajax({
                type: 'GET',
                url: '{{ route('news', ':id') }}'.replace(':id', id),
                success: function(data) {
                    $('#edit-news-id').val(data.id);
                    $('#edit-title').val(data.title);
                    $('#edit-category_id').val(data.category_id);
                    $('#edit-description').val(data.description);
                }
            });
        });
        $('#edit-news-btn').click(function() {  
            var id = $('#edit-news-id').val();
            var formData = new FormData($('#edit-news-form')[0]);
            formData.append('_method', 'PUT');

            $.ajax({
                type: 'POST',
                url: '{{ route('news', ':id') }}'.replace(':id', id),
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#edit-news-modal').modal('hide');
                    location.reload();
                },
                error: function(data) {
                    var errors = data.responseJSON.errors;
                    var errorMessage = '';

                    $.each(errors, function(key, value) {
                        errorMessage += '<p>' + value[0] + '</p>';
                    });

                    $('#edit-news-form').prepend('<div class="alert alert-danger">' +
                        errorMessage + '</div>');
                }
            });
        });

        // Delete News
        $(document).on('click', '.delete-btn', function() {
            var id = $(this).data('id');

            if (confirm('Are you sure you want to delete this news?')) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('news', ':id') }}'.replace(':id', id),
                    data: {
                        _method: 'DELETE'
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        });
    });
</script>
