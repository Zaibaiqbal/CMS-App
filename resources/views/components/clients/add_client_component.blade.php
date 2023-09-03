<div class="row">
    
    <div class="col-md-6">
        <div class="form-group">
            @php($label = 'Name')
            @php($name = 'name')

            <label for="">{{$label}} <span class="text-danger">*</span> </label>
            <small class="text-danger" id="{{$name}}_error"></small>

            <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">

        </div>
    </div>
 
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

    <div class="col-md-6 mb-2">

    @php($label = 'Address')
    @php($name = 'address')
    <label >{{$label}} <span class="text-danger">*</span> </label>
    <small class="text-danger" id="{{$name}}_error"></small>

    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">


    </div>

    <div class="col-md-4 mb-2">

    @php($label = 'City')
    @php($name = 'city')
    <label >{{$label}} <span class="text-danger">*</span> </label>
    <small class="text-danger" id="{{$name}}_error"></small>

    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">


    </div>

    <div class="col-md-4 mb-2">

    @php($label = 'Province')
    @php($name = 'province')
    <label >{{$label}} <span class="text-danger"></span> </label>
    <small class="text-danger" id="{{$name}}_error"></small>

    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">


    </div>

    <div class="col-md-4 mb-2">

    @php($label = 'Postal code')
    @php($name = 'postal_code')
    <label >{{$label}} <span class="text-danger"></span> </label>
    <small class="text-danger" id="{{$name}}_error"></small>

    <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">


    </div>
                        
</div>
