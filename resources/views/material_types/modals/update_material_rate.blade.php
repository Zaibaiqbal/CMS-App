

<!-- Modal -->
<div class="modal fade" id="modal_update_material_rate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Material Rate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'update.materialrate', 'class' => '', 'id' => 'form_update_material_rate')) }}


      <div class="modal-body">
               
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                              @php($label = 'Select Material')
                              @php($name = 'material_type_id')
                                <div class="form-group">
                                    <label for="">{{$label}}</label>
                                    <span><i class="text-danger">*</i></span>
                                    <small id="{{$name}}_error" class="text-danger"></small>
                                        <select name="{{$name}}" id="" class="form-control fstdropdown-select">

                                            <option value="0">{{$label}}</option>

                                            @foreach($material_types_list as $rows)

                                            <option @if($material->material_type_id == $rows->id) selected value="{{$rows->id}}" @endif>{{$rows->name}}</option>

                                            @endforeach

                                        </select>
                                </div>

                            </div>


                            <div class="col-md-6">
                              @php($label = 'Select Client')
                              @php($name = 'client')
                                <div class="form-group">
                                    <label for="">{{$label}}</label>
                                    <span><i class="text-danger">*</i></span>
                                    <small id="{{$name}}_error" class="text-danger"></small>

                                    <select name="{{$name}}" id="" class="form-control fstdropdown-select">

                                    <option value="{{0}}">{{$label}}</option>

                                    @foreach($client_list as $rows)

                                    <option @if($material->client_id == $rows->id) selected value="{{$rows->id}}" @endif>{{$rows->name}}</option>

                                    @endforeach

                                    </select>
                                </div>

                            </div>


                            <div class="col-md-12">
                              @php($label = 'Rate')
                              @php($name = 'rate')
                                <div class="form-group">
                                    <label for="">{{$label}}</label>
                                    <span><i class="text-danger">*</i></span>
                                    <small id="{{$name}}_error" class="text-danger"></small>

                                    <input type="text" name="{{$name}}" value="{{$material->rate}}" class="form-control" id="" placeholder="{{$label}}">
                                </div>

                            </div>
                         
                        
                    </div>

                    </div>
                    <!-- /.card-body -->

                
                </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" name="material_rate" value="{{encrypt($material->id)}}">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" onclick="submitModalForm(event,this,'#form_update_material_rate','#modal_update_material_rate')" class="btn btn-primary">Update</button>
      </div>
      {{ Form::close() }}

    </div>
  </div>
</div>