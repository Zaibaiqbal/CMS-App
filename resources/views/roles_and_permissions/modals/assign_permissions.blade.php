

<!-- Modal -->
<div class="modal fade" id="modal_assign_permissions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width:1102px !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Permissions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     

      <div class="modal-body">
               
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                        @foreach($modules as $rows)
                        @php($uniqid = uniqid())

                          @php($hasPermission = array())

                          @foreach($permission->getPermissionByModule($rows) as $key=>$row)
                            @php(array_push($hasPermission,$row->name))
                          @endforeach
                          @php($module_name = str_replace(' ','_',$rows))

                        <div class="col-md-4 mb-2">
                          <div id="accordion" role="tablist" aria-multiselectable="true">
                              <div class="accordion-panel">
                                <table class="table table-borderless font-size-sm mb-0">
                                  <thead class="bg-primary">
                                    <tr>
                                          <th class="text-left"> 
                                            <input class="{{$rows}}_module" @if(@count($hasPermission ?? []) > 0 && $role->hasAllPermissions($hasPermission)) checked @endif  style="border: 0px;" type="checkbox" onchange="assignModuleAllPermission(event,this,'{{Crypt::encrypt($role->id)}}','{{$rows}}','{{$uniqid}}')">&nbsp;{{$rows}}</th>
                                          
                                          <th class="d-none d-sm-table-cell text-right" ><a class="text-light" data-toggle="collapse" data-parent="#accordion" href="#{{$module_name}}_{{$uniqid}}" aria-expanded="true" aria-controls="{{$module_name}}_{{$uniqid}}" >
                                        <i class="fa fa-chevron-down"></i>
                                </a></th>


                                          
                                      </tr>
                                  </thead>
                                </table>
                                  
                                  <div id="{{$module_name}}_{{$uniqid}}" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                                      <div class="accordion-content accordion-desc">
                                        <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                                              <thead class="table-vcenter">
                                            <tr>
                                                  <th class="text-left">Permisson</th>
                                                  <th class="d-none d-sm-table-cell text-right" >Action</th>


                                                  
                                              </tr>
                                          </thead>
                                          <tbody>
                                          
                                              @foreach($permission->getPermissionByModule($rows) as $permissions)
                                              <tr>
                                                  
                                                  <td class="font-w600 font-size-sm">{{$permissions->name}}</td>
                                                  
                                                  
                                                <td class="text-right">
                                                  <div class="checkbox-fade fade-in-primary checkbox">
                                                                                        
                                                    <input type="checkbox" @if($role->hasPermissionTo($permissions)) checked @endif  onchange="assignPermission(event,'{{Crypt::encrypt($permissions->id)}}','{{Crypt::encrypt($role->id)}}')" class="permissions_list_{{$uniqid}}" id="example-switch-custom" name="example-switch-custom" >
                                                    <label class="custom-control-label" for="example-switch-custom"></label>
                                                  </div>

                                                  </td>

                                                  
                                                
                                              </tr>
                                              @endforeach
                                            
                                          </tbody>
                                        </table>
                                      </div>
                                  </div>
                              </div>
                              
                          </div>
                        
                        
                        </div>
                        @endforeach
                 

                        
                    </div>

                    </div>
                    <!-- /.card-body -->

                
                </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>


    </div>
  </div>
</div>

@include('roles_and_permissions.scripts.roles_permissions_script')