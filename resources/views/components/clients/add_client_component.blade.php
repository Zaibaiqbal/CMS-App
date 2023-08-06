<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    @php($label = 'CNIC')
                                    @php($name = 'cnic')
                                    <label for="">{{$label}} <span class="text-danger">*</span> </label>
                                    <small class="text-danger" id="{{$name}}_error"></small>
                                    <input type="text" name="{{$name}}"  placeholder="00000-0000000-0" data-mask="00000-0000000-0" class="form-control cnic" id="">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @php($label = 'Name')
                                    @php($name = 'name')

                                    <label for="">{{$label}} <span class="text-danger">*</span> </label>
                                    <small class="text-danger" id="{{$name}}_error"></small>

                                    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">

                                </div>
                            </div>
                            {{--
                            <div class="col-md-6">

                                    @php($label = 'Father Name')
                                    @php($name = 'fname')
                                    <label for="">{{$label}} </label>
                                    <small class="text-danger" id="{{$name}}_error"></small>

                                    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">

                            </div>
                            --}}
                            <div class="col-md-6 mb-2">

                                    @php($label = 'Contact')
                                    @php($name = 'contact_no')
                                    <label for="">{{$label}} <span class="text-danger">*</span> </label>
                                    <small class="text-danger" id="{{$name}}_error"></small>

                                    <input type="text" name="{{$name}}" class="form-control contact" id="" placeholder="0000-0000000" data-mask="0000-000000">


                            </div>
                            <div class="col-md-6 mb-2">

                                @php($label = 'Email')
                                    @php($name = 'email')
                                    <label for="exampleInputEmail1">{{$label}} <span class="text-danger">*</span> </label>
                                    <small class="text-danger" id="{{$name}}_error"></small>

                                    <input type="email" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">


                            </div>
                        
                        
                    </div>
