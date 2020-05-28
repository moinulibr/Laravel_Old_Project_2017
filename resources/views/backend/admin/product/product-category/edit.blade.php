

  <!-- The Edit  Modal -->
  <div class="modal" id="myEditModal">
    <div class="modal-dialog">
      <div class="modal-content modal-sm">
        <form action="" method="POST" id="editFormAction">
            @csrf
            @method('PUT')
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title" style="text-align:center">Edit This Account</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
            
                <div class="col-xl-12 col-lg-12 col-12 form-group">
                    <label class="col-xl-12 col-lg-12 col-12">Category Name:</label>
                    <input name="name" id="name" type="text" value="" placeholder="Category Name" class="col-xl-12 col-lg-12 col-12 form-control">
                    @if($errors->has('name'))
                    <span class="margin-left-33">
                    <strong style="color:red;">{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

            
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            <input type="submit" class="btn btn-info" value="Update">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
