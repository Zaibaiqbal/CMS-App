

<!-- Modal -->
<div class="modal fade" id="modal_update_truck" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Fleet Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'update.clienttruck', 'class' => '', 'id' => 'form_update_truck_info')) }}


      <div class="modal-body">
               
        <div class="card">

          <div class="card-body">
            <div class="row">
              
              <div class="col-md-6">
                @php($label = 'Plate Number')
                @php($name = 'plate_no')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <span><i class="text-danger">*</i></span>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">
                  </div>

              </div>

              <div class="col-md-6">
                @php($label = 'Company')
                @php($name = 'company')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <span><i class="text-danger">*</i></span>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="text" name="{{$name}}" class="form-control" placeholder="{{$label}}">
                  </div>
              </div>

              <div class="col-md-6">
                @php($label = 'Model')
                @php($name = 'model')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <span><i class="text-danger">*</i></span>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="text" name="{{$name}}" class="form-control" placeholder="{{$label}}">
                  </div>
              </div>

              <div class="col-md-6">
                @php($label = 'Color')
                @php($name = 'color')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="text" name="{{$name}}" class="form-control" placeholder="{{$label}}">
                  </div>
              </div>

              <div class="col-md-6">
                @php($label = 'Tare Weight')
                @php($name = 'tare_weight')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <span><i class="text-danger">*</i></span>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="text" name="{{$name}}" class="form-control" placeholder="{{$label}}">
                  </div>
              </div>

              <div class="col-md-6">
                  @php($label = 'VIN Number')
                  @php($name = 'vin_no')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <span><i class="text-danger"></i></span>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="text" name="{{$name}}" class="form-control" placeholder="{{$label}}">
                  </div>
              </div>

              <div class="col-md-12">
                  @php($label = 'Description')
                  @php($name = 'description')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <textarea type="text" name="{{$name}}" class="form-control" cols="40" rows="3" placeholder="{{$label}}"></textarea>
                  </div>
              </div>
              
            </div>

          </div>
            <!-- /.card-body -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" onclick="submitModalForm(event,this,'#form_update_truck_info','#modal_update_truck')" class="btn btn-primary">Update</button>
      </div>
      {{ Form::close() }}

    </div>
  </div>
</div>