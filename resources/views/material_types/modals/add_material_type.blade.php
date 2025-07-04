

<!-- Modal -->
<div class="modal fade" id="modal_add_material_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'store.materialtype', 'class' => '', 'id' => 'form_add_material_type')) }}


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

                                    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">
                                </div>

                            </div>

                            <div class="col-md-6">
                              @php($label = 'Board Rate')
                              @php($name = 'board_rate')
                                <div class="form-group">
                                    <label for="">{{$label}}</label>
                                    <span><i class="text-danger">*</i></span>
                                    <small id="{{$name}}_error" class="text-danger"></small>

                                    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">
                                </div>

                            </div>
                            <div class="col-md-12">
                                    <input type="checkbox" name="is_slab_rate" class="" value="1" onclick="checkSlabSection(event,this)">
                                    <label for="">Slab Rate for Material</label>
                                    <small id="is_slab_rate_error" class="text-danger"></small>

                                  
                            </div>

                            <div class="col-md-4 slab_section" style="display: none;">
                              @php($label = 'Slab Weight')
                              @php($name = 'slab_weight')
                                <div class="form-group">
                                    <label for="">{{$label}} (kg)</label>
                                    <span><i class="text-danger">*</i></span>
                                    <small id="{{$name}}_error" class="text-danger"></small>

                                    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">
                                </div>

                            </div>

                            <div class="col-md-4 slab_section" style="display: none;">
                              @php($label = 'Slab Rate')
                              @php($name = 'slab_rate')
                                <div class="form-group">
                                    <label for="">{{$label}}</label>
                                    <span><i class="text-danger">*</i></span>
                                    <small id="{{$name}}_error" class="text-danger"></small>

                                    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">
                                </div>

                            </div>

                            <div class="col-md-4 slab_section" style="display: none;">
                              @php($label = 'Weight Break')
                              @php($name = 'weight_break')
                                <div class="form-group">
                                    <label for="">{{$label}} (kg)</label>
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

<script>
   function checkSlabSection(event,obj)
    {
        var obj = $(obj);


		if(obj.prop('checked'))
		{
			$('.slab_section').show();
        }
        else{

            $('.slab_section').hide();
        }

    }

</script>