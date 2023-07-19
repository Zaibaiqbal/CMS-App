

<!-- Modal -->
<div class="modal fade" id="modal_add_material_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Material Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'store.materialtype', 'class' => '', 'id' => 'form_add_material_type')) }}


      <div class="modal-body">
               
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                              @php($label = 'Material Type')
                              @php($name = 'type')
                                <div class="form-group">
                                    <label for="">{{$label}}</label>
                                    <span><i class="text-danger">*</i></span>
                                    <small id="{{$name}}_error" class="text-danger"></small>

                                    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">
                                </div>

                            </div>
                         
                        
                    </div>

                    </div>
                    <!-- /.card-body -->

                
                </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" onclick="submitModalForm(event,this,'#form_add_material_type','#modal_add_material_type')" class="btn btn-primary">Submit</button>
      </div>
      {{ Form::close() }}

    </div>
  </div>
</div>