

<!-- Modal -->
<div class="modal fade" id="modal_approve_contact_person" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'approve.cotactperson', 'class' => '', 'id' => 'form_approve_cotactperson')) }}

      <div class="modal-body">
               
                <div class="card">

                    <div class="card-body">
                      
                    <div class="row">
                      {{--
                      <div class="col-md-6">
                          <div class="form-group">
                              @php($label = 'Title')
                              @php($name = 'title')
                              <label for="">{{$label}} <span class="text-danger">*</span> </label>
                              <small class="text-danger" id="{{$name}}_error"></small>
                             
                              <input type="text" name="{{$name}}" placeholder="{{$label}}"  class="form-control" id="">
                              
                          </div>

                        </div>

                        --}}
                        <div class="col-md-12">
                          <div class="form-group">
                              @php($label = 'Account No.')
                              @php($name = 'account_no')
                              <label for="">{{$label}} <span class="text-danger">*</span> </label>
                              <small class="text-danger" id="{{$name}}_error"></small>
                              @if($user_account->user->account_type == "Existing Account") 
                              <select name="{{$name}}" id="" class="form-control">
                                @foreach($user_account->client->userAccounts as $rows)
                                <option value="{{$rows->account->account_no}}">{{$rows->account->account_no}}</option>

                                @endforeach

                              </select>
                              @else
                              <input type="text" name="{{$name}}" placeholder="{{$label}}"  class="form-control" id="">
                              @endif
                          </div>

                        </div>
                    </div>

                    </div>
                    <!-- /.card-body -->

                
                </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" value="{{encrypt($user_account->id)}}" name="user_account">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="submitModalForm(event,this,'#form_approve_cotactperson','#modal_approve_contact_person')">Submit</button>
      </div>
      {{ Form::close() }}


    </div>
  </div>
</div>

<script type="text/javascript">
$('.cnic').mask("00000-0000000-0");
$('.contact').mask("0000-0000000");


</script>
