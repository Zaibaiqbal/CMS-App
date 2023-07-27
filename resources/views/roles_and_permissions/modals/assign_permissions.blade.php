

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
                    <div class="col-md-4 mb-2">

                        <div class="sparkline7-list shadow-reset mg-t-30">
                            <div class="sparkline8-hd">
                                <div class="main-spark7-hd">
                                    <h4 class="text-secondary">{{$rows}} </h4>
                                    <div class="sparkline8-outline-icon">
                                        <!-- <span class="sparkline7-collapse-link"><i class="fa fa-chevron-down"></i></span> -->
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline7-graph project-details-price-hd"  style="background-color: #cecaca;">
                                <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0  table-vcenter text-center table-sm">
                                         <thead class="table-vcenter">
                                    <tr>
                                        <th class="text-center">Permisson</th>
                                        <th class="d-none d-sm-table-cell text-center" >Action</th>


                                        
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach($permission->getPermissionByModule($rows) as $permissions)
                                    @php($uniqid = uniqid())
                                    <tr>
                                        
                                        <td class="font-w600 font-size-sm">{{$permissions->name}}</td>
                                        
                                        
                                       <td class="text-center">
                                       <div class="checkbox-fade fade-in-primary checkbox">
                                                                               
                                                <input type="checkbox" @if($role->hasPermissionTo($permissions)) checked @endif  onchange="assignPermission(event,'{{Crypt::encrypt($permissions->id)}}','{{Crypt::encrypt($role->id)}}')" class="" id="example-switch-custom{{$uniqid}}" name="example-switch-custom{{$uniqid}}" >
                                                <label class="custom-control-label" for="example-switch-custom{{$uniqid}}"></label>
                                              </div>

                                        </td>

                                        
                                       
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                                    </table>
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