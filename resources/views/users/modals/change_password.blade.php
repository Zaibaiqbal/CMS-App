

<!-- Modal -->
<div class="modal fade" id="modal_change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Fleet Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'change.password', 'class' => '', 'id' => 'form_change_password')) }}


      <div class="modal-body">
               
        <div class="card">

          <div class="card-body">
            <div class="row">
              
                <div class="col-md-12">
                                <div class="form-group">
                                    @php($label = 'Old Password')
                                    @php($name = 'old_password')
                                    <label for="">{{$label}} <span class="text-danger">*</span> </label>
                                    <small class="text-danger" id="{{$name}}_error"></small>
                                    <input type="password" name="{{$name}}"  placeholder="{{$label}}"  class="form-control" id="">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @php($label = 'New Password')
                                    @php($name = 'new_password')

                                    <label for="">{{$label}} <span class="text-danger">*</span> </label>
                                    <small class="text-danger" id="{{$name}}_error"></small>

                                    <input type="password" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">

                                </div>
                            </div>

                              <div class="col-md-6">

                                  @php($label = 'Confirm Password')
                                  @php($name = 'confirm_password')
                                  <label for="exampleInputEmail1">{{$label}} </label>
                                  <small class="text-danger" id="{{$name}}_error"></small>

                                  <input type="password" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">


                              </div>

              
            </div>

          </div>
            <!-- /.card-body -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" onclick="submitModalForm(event,this,'#form_change_password','#modal_change_password')" class="btn btn-primary">Submit</button>
      </div>
      {{ Form::close() }}

    </div>
  </div>
</div>