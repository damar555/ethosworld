<div class="p2" id="form">
    <div class="form-group">
        <label for="name">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="title category">
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-close" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" onclick="store()">Create</button>
    </div>
</div>
<script>
     // Create New Category
     function store() { 
            if ($('#title').val() == "") {
                swal.fire("Peringatan!", "Title cannot be null!.", "warning");
                $("#title").focus();
            } else {
                var data =$("#title").serialize();
               // console.log(data)
                $.ajax({
                    type: "POST",
                    url: "category",
                    data: data,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    //dataType: "JSON",
                    success: function(h) {
                        $('#form').modal('hide');
                        swal.fire("Sukses!", h.message, h.status);
                    }
                            
                });
            }
        }
</script>