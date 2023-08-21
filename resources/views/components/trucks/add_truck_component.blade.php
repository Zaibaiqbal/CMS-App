<div class="row">
    <div class="col-md-6">
        @php($label = 'Plate Number')
        @php($name = 'plate_no')
        <div class="form-group">
            <label for="">{{$label}}</label>
            <span><i class="text-danger">*</i></span>
            <small id="{{$name}}_error" class="text-danger"></small>

            <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">
        </div>

    </div>
    <div class="col-md-6">
    @php($label = 'Company')
        @php($name = 'company')
        <div class="form-group">
            <label for="">{{$label}}</label>
            <span><i class="text-danger">*</i></span>
            <small id="{{$name}}_error" class="text-danger"></small>

            <input type="text" name="{{$name}}" class="form-control" placeholder="{{$label}}">
        </div>
    </div>
    <div class="col-md-6">
    @php($label = 'Model')
        @php($name = 'model')
        <div class="form-group">
            <label for="">{{$label}}</label>
            <span><i class="text-danger">*</i></span>
            <small id="{{$name}}_error" class="text-danger"></small>

            <input type="text" name="{{$name}}" class="form-control" placeholder="{{$label}}">
        </div>
    </div>

    <div class="col-md-6">
    @php($label = 'Color')
        @php($name = 'color')
        <div class="form-group">
            <label for="">{{$label}}</label>
            <small id="{{$name}}_error" class="text-danger"></small>

            <input type="text" name="{{$name}}" class="form-control" placeholder="{{$label}}">
        </div>
    </div>

    <div class="col-md-6">
    @php($label = 'Tare Weight')
        @php($name = 'tare_weight')
        <div class="form-group">
            <label for="">{{$label}}</label>
            <span><i class="text-danger">*</i></span>
            <small id="{{$name}}_error" class="text-danger"></small>

            <input type="text" name="{{$name}}" class="form-control" placeholder="{{$label}}">
        </div>
    </div>

    <div class="col-md-6">
        @php($label = 'VIN Number')
        @php($name = 'vin_no')
        <div class="form-group">
            <label for="">{{$label}}</label>
            <span><i class="text-danger"></i></span>
            <small id="{{$name}}_error" class="text-danger"></small>

            <input type="text" name="{{$name}}" class="form-control" placeholder="{{$label}}">
        </div>
    </div>
    
    <div class="col-md-12">
        @php($label = 'Description')
        @php($name = 'description')
        <div class="form-group">
            <label for="">{{$label}}</label>
            <textarea type="text" name="{{$name}}" class="form-control" cols="40" rows="3" placeholder="{{$label}}"></textarea>
        </div>
    </div>
    
</div>