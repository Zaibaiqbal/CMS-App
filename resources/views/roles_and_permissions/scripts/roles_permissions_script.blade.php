<script type="text/javascript">
    function assignPermission(event,permission,role)
    {
        var token  =  "{{Session::token()}}";
                
        var formdata = {'role':role,'permission':permission,'_token':token};



        $.post("{{route('assign.permissions')}}", formdata, function(result)
        {
            if(result.status)
            {
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.success(result.message);
            }
            else
            {
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.warning(result.message);
            }



        });
    }
    function assignModuleAllPermission(event,obj,role,module_name)
    {
        var token  =  "{{Session::token()}}";

                

        var flag = false;

        if($(obj).prop('checked'))
        {
            flag = true;
        }
        var formdata = {'role':role,'module':module_name,'flag':flag,'_token':token};


        $.post("{{route('assign.module.permissions')}}", formdata, function(result)
        {
            if(result.status)
            {
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.success(result.message);
            }
            else
            {
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.warning(result.message);
            }



        });
    }
  </script>
      