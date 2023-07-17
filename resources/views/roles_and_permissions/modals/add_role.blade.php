

<!-- Modal -->
<div class="modal fade" id="modal_add_role" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      {{ Form::open(array('route' => 'store.role', 'class' => '', 'id' => 'form_add_role')) }}

      <div class="modal-body">
               
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @php($name = 'name')
                                @php($label = 'Role Name')
                                <div class="form-group">
                                    <label for="">{{$label}}<span class="text-danger">*</span> </label>

                                    <small class="text-danger" id="{{$name}}_error"></small>

                                    <input type="text" class="form-control" name="{{$name}}" placeholder="{{$label}}">
                                </div>

                            </div>
                 

                        
                    </div>

                    </div>
                    <!-- /.card-body -->

                
                </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="submitModalForm(event,this,'#form_add_role','#modal_add_role')">Submit</button>
      </div>

      {{ Form::close() }}

    </div>
  </div>
</div>