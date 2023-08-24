

<!-- Modal -->
<div class="modal fade" id="modal_assign_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'assign.account', 'class' => '', 'id' => 'form_assign_account')) }}

      <div class="modal-body">
               
                <div class="card">

                    <div class="card-body">
                      
                    <div class="row">
                    <div class="col-md-6 mb-2">

                      @php($label = 'Select User')
                      @php($name = 'user')
                      <label for="">{{$label}} <span class="text-danger">*</span></label>
                      <small class="text-danger" id="{{$name}}_error"></small>

                      <select name="{{$name}}" id="" class="form-control fstdropdown-select">

                      @foreach($user_list as $rows)
                            <option value="{{$rows->id}}">{{$rows->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 mb-2">

                        @php($label = 'Select Account')
                        @php($name = 'account')
                        <label for="">{{$label}} <span class="text-danger">*</span></label>
                        <small class="text-danger" id="{{$name}}_error"></small>

                        <select name="{{$name}}" id="" class="form-control fstdropdown-select">

                        @foreach($account_list as $rows)
                            <option value="{{$rows->id}}">{{$rows->title}} - {{$rows->account_no}}</option>
                        @endforeach
                        </select>
                        </div>
                    
                        
                      
                    </div>

                    </div>
                    <!-- /.card-body -->

                
                </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="submitModalForm(event,this,'#form_assign_account','#modal_assign_account')">Submit</button>
      </div>
      {{ Form::close() }}


    </div>
  </div>
</div>

<script type="text/javascript">
$('.cnic').mask("00000-0000000-0");
$('.contact').mask("0000-0000000");

setFstDropdown();

</script>
