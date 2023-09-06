@extends('layouts.app')

@section('page_script')



<script type="text/javascript">
  
$('.cnic').mask("00000-0000000-0");
$('.contact').mask("0000-0000000");

</script>

@endsection

@section('content')

           <!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->

<div id="pcoded" class="pcoded">

  <div class="pcoded-container">
  
    <div class="pcoded-main-container">

      <div class="pcoded-wrapper">
        <div class="pcoded-content">
          <div class="pcoded-inner-content">

            <!-- Main-body start -->
            <div class="main-body">
              <div class="page-wrapper">
                  
                <div class="page-header m-t-30">
                  <div class="row align-items-end">
                    
                  
                  </div>
                </div>
                  <!-- Page body start -->
                <div class="page-body">
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-sm-12 col-md-6">
                        <!-- Register your self card start -->
                        <div class="card">
                            <div class="card-header text-center p-2">
                                <h3>Register Here</h3>
                                <img alt="Logo" class=" mt-2" src="{{asset('logos/logo.png')}}" width="13%" />
                            </div>
                            <div class="card-block">
                                <div class="j-wrapper j-wrapper-640 p-0">
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                    <form method="POST" action="{{ route('user.register') }}" class="j-pro" id="form_register_user" novalidate="" >
                                      @csrf  
                                      <div class="j-content">

                                            <!-- start name -->
                                            <div>
                                                <label class="j-label">Name  <small class="text-danger" id="name_error"></small></label>
                                               
                                                <div class="j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="name">
                                                          <i class="icofont icofont-ui-user"></i>
                                                      </label>
                                                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name" required autocomplete="name" autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end name -->
                                            <!-- start email -->
                                            <div>
                                                <div>
                                                    <label class="j-label">Email   <small class="text-danger" id="email_error"></small></label>
                                                  

                                                </div>
                                                <div class="j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="email">
                                                            <i class="icofont icofont-envelope"></i>
                                                        </label>

                                                        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end email -->
                                         <!-- start email -->
                                         <div>
                                                <div>
                                                    <label class="j-label">Contact        <small class="text-danger" id="contact_error"></small></label>
                                             

                                                </div>
                                                <div class="j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-right" >
                                                            <i class="fa fa-mobile"></i>
                                                        </label>

                                                        <input  type="text" placeholder="00000000000"  class="form-control @error('contact') is-invalid @enderror contact" name="contact" value="{{ old('contact') }}" required >
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end email -->
                                            <!-- start password -->
                                            {{--
                                            <div>
                                                <div>
                                                    <label class="j-label ">Password</label>

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="password">
                                                          <i class="icofont icofont-lock"></i>
                                                      </label>
                                                      <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end password -->

                                              <!-- start password -->
                                              <div>
                                                <div>
                                                    <label class="j-label ">Confirm Password</label>
                                                    @error('password_confirmation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                  </div>
                                                <div class="j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="password">
                                                            <i class="icofont icofont-lock"></i>
                                                        </label>
                                                        <input id="password" type="password" placeholder="Confirm Password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end password -->

                                            --}}
                                            <!-- start response from server -->
                                            <div class="j-response"></div>
                                            <!-- end response from server -->
                                        </div>
                                        <!-- end /.content -->
                                        <div class="j-footer">
                                          <center>
                                            <button type="submit" onclick="submitModalForm(event,this,'#form_register_user','')"class="btn btn-primary">Register</button>
                                            </center>

                                          </div>
                                        <!-- end /.footer -->
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Register your self card end -->
                    </div>
                    <div class="col-md-3"></div>

                  </div>
                </div>
                <!-- Page body end -->
              </div>
            </div>
            <!-- Main-body end -->
            <div id="styleSelector">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
