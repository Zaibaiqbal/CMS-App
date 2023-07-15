

<!-- Modal -->
<div class="modal fade" id="modal_add_employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'store.employee', 'class' => '', 'id' => 'form_add_employee')) }}

      <div class="modal-body">
               
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    @php($label = 'CNIC')
                                    @php($name = 'cnic')
                                    <label for="exampleInputEmail1">{{$label}} </label>
                                    <input type="text" name="{{$name}}"  placeholder="00000-0000000-0" data-mask="00000-0000000-0" class="form-control" id="">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @php($label = 'Name')
                                    @php($name = 'name')
                                    <label for="exampleInputEmail1">{{$label}} </label>
                                    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">

                                </div>
                            </div>
                            <div class="col-md-6">

                                    @php($label = 'Father Name')
                                    @php($name = 'fname')
                                    <label for="exampleInputEmail1">{{$label}} </label>
                                    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">

                            </div>

                            <div class="col-md-6">

                                    @php($label = 'Contact')
                                    @php($name = 'contact_no')
                                    <label for="exampleInputEmail1">{{$label}} </label>
                                    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="0000-0000000" data-mask="0000-000000">


                            </div>
                            <div class="col-md-6">

                                @php($label = 'Email')
                                    @php($name = 'email')
                                    <label for="exampleInputEmail1">{{$label}} </label>
                                    <input type="email" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">


                            </div>
                            <div class="col-md-6">

                              @php($label = 'Password')
                                  @php($name = 'password')
                                  <label for="exampleInputEmail1">{{$label}} </label>
                                  <input type="password" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">


                              </div>

                              <div class="col-md-6">

                                  @php($label = 'Confirm Password')
                                  @php($name = 'confirm_password')
                                  <label for="exampleInputEmail1">{{$label}} </label>
                                  <input type="password" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">


                              </div>

                        
                    </div>

                    </div>
                    <!-- /.card-body -->

                
                </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="submitModalForm(event,this,'#form_add_employee','#modal_add_employee')">Submit</button>
      </div>
      {{ Form::close() }}


    </div>
  </div>
</div>

<script type="text/javascript">
$("input[type=cnic]").mask("00000-0000000-0");

</script>
