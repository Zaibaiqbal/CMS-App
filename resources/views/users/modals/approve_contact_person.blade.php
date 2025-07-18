

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
                      <div class="col-md-12 mb-2">

                      @php($label = 'Client Group')
                      @php($name = 'client_group')
                      <label for="">{{$label}} <span class="text-danger">*</span></label>
                      <small class="text-danger" id="{{$name}}_error"></small>

                      @if($user_account->user->account_type == "Existing Account") 
                      <input type="text" name="{{$name}}" placeholder="{{$label}}" readonly value="{{$user_account->user->client->client_group}}"  class="form-control" id="">

                      @else

                      <select name="{{$name}}" id="" class="form-control fstdropdown-select">

                      @foreach($group_list as $rows)
                            <option value="{{$rows}}">{{$rows}}</option>
                        @endforeach
                      </select>
                      @endif
                      </div>
                      
                      <div class="col-md-6">
                          <div class="form-group">
                              @php($label = 'Title')
                              @php($name = 'title')
                              <label for="">{{$label}} <span class="text-danger">*</span> </label>
                              <small class="text-danger" id="{{$name}}_error"></small>
                              @if($user_account->user->account_type == "Existing Account") 
                             
                              <input type="text" name="{{$name}}" placeholder="{{$label}}" value="{{$user_account->account->title}}" readonly  class="form-control" id="">
                              @else
                              <input type="text" name="{{$name}}" placeholder="{{$label}}"  class="form-control" id="">

                              @endif
                          </div>

                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                              @php($label = 'Account No.')
                              @php($name = 'account_no')
                              <label for="">{{$label}} <span class="text-danger">*</span> </label>
                              <small class="text-danger" id="{{$name}}_error"></small>
                              @if($user_account->user->account_type == "Existing Account") 
                              <select name="{{$name}}" id="" class="form-control fstdropdown-select">
                               
                                <option value="{{$user_account->account->account_no}}">{{$user_account->account->account_no}}</option>

                              </select>
                              @else
                              <input type="text" name="{{$name}}" placeholder="{{$label}}"  class="form-control" id="">
                              @endif
                          </div>

                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                              @php($label = 'Note')
                              <label for="">{{$label}}  </label>
                              <small class="text-danger" id="{{$name}}_error"></small>
                            
                              <textarea name="" id="" class="form-control" cols="30" rows="3">{{$user_account->description}}</textarea>
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

setFstDropdown();

</script>
