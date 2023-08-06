

<!-- Modal -->
<div class="modal fade" id="modal_approve_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'approve.user', 'class' => '', 'id' => 'form_approve_user')) }}

      <div class="modal-body">
               
                <div class="card">

                    <div class="card-body">
                      
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    @php($label = 'Account No.')
                                    @php($name = 'account_no')
                                    <label for="">{{$label}} <span class="text-danger">*</span> </label>
                                    <small class="text-danger" id="{{$name}}_error"></small>
                                    <input type="text" name="{{$name}}" placeholder="{{$label}}"  class="form-control" id="">
                                </div>

                            </div>
                        
                            

                        
                    </div>

                    </div>
                    <!-- /.card-body -->

                
                </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" value="{{encrypt($user->id)}}" name="user">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="submitModalForm(event,this,'#form_approve_user','#modal_approve_user')">Submit</button>
      </div>
      {{ Form::close() }}


    </div>
  </div>
</div>

<script type="text/javascript">
$('.cnic').mask("00000-0000000-0");
$('.contact').mask("0000-0000000");


</script>
