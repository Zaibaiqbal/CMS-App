

<!-- Modal -->
<div class="modal fade" id="modal_update_material_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'update.materialtype', 'class' => '', 'id' => 'form_update_material_type')) }}


      <div class="modal-body">
               
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                              @php($label = 'Name')
                              @php($name = 'type')
                                <div class="form-group">
                                    <label for="">{{$label}}</label>
                                    <span><i class="text-danger">*</i></span>
                                    <small id="{{$name}}_error" class="text-danger"></small>

                                    <input type="text" value="{{$material_type->name}}" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">
                                </div>

                            </div>

                            <div class="col-md-6">
                              @php($label = 'Board Rate')
                              @php($name = 'board_rate')
                                <div class="form-group">
                                    <label for="">{{$label}}</label>
                                    <span><i class="text-danger">*</i></span>
                                    <small id="{{$name}}_error" class="text-danger"></small>

                                    <input type="text" value="{{$material_type->board_rate}}" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">
                                </div>

                            </div>
                        
                    </div>

                    </div>
                    <!-- /.card-body -->

                
                </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" name="material_type_id" value="{{$material_type->id}}">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" onclick="submitModalForm(event,this,'#form_update_material_type','#modal_update_material_type')" class="btn btn-primary">Update</button>
      </div>
      {{ Form::close() }}

    </div>
  </div>
</div>