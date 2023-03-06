@extends('main')

@section('container')
<h1 class="text-center mb-4">Tambah Data News</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="/news" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Title</label>
                      <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Category</label>
                      <select class="form-select" name="category" aria-label="Default select example">
                        <option selected>- Pilih Kategori Terkait -</option>
                        <option value="Hiburan">Hiburan</option>
                        <option value="lainya">lainya</option>
                        <option value="Three">Three</option>
                      </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Image</label>
                        <input type="text" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
</div>