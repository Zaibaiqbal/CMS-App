<div class="modal fade" id="md_import_trucks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
{{ Form::open(array('route' => 'import.trucks', 'id' => 'form_import_trucks', 'class' => 'cls_from', 'enctype' => 'multipart/form-data')) }}

  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Trucks Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body ">
        <div class="row">
         
            
          <div class="col-sm-12 col-lg-12" id="file">
                <label class="font-weight-bold col-form-label"> File <i style = "color:red;">*</i></label>
                <small class="text-danger" id="file_error"></small>


            <div class="input-group mb-3">

              <input type="file" name="file" class="form-control">
            </div>
          </div>

       
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      <button onclick="importData(event,'#form_import_trucks','Csv uploaded succssfully.')" type="submit"  class="btn btn-primary" >Submit</button>

      </div>
    </div>
  </div>
  {{ Form::close() }}
</div>
