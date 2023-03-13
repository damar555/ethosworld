{{-- @extends('layout.master')

@section('content')
<!-- Main content -->
  <div class="container">
    <div class="justify-content-center">
      <div class="card">
          <div class="card-body">
              <form action="/news/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                  @method('PUT')
                  @csrf
                  <div class="mb-3">
                    <label for="InputTitle" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="InputTitle" value="{{ $data->title }}">
                  </div>

                  <div class="mb-3">
                      <label for="InputCategory" class="form-label">Category</label>
                      <input type="text" name="category" class="form-control" id="InputCategory" value="{{ $data->category }}">
                  </div>

                  <div class="mb-3">
                      <label for="InputDescription" class="form-label">Description</label>
                      <input type="text" name="description" class="form-control" id="InputDescription" value="{{ $data->description }}">
                    </div>
                  
                  <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              
          </div>
      </div>
    </div>
  </div>
<!-- /.content -->
@endsection --}}
