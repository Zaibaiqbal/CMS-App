<script type="text/javascript">
  

    function autoSearchPlateNo(event,tag)
    {
        event.preventDefault();

        var route = "{{ route('searchplateno') }}";

        var formData = {}

        $('input.auto_search_plate_no').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: route,
                    type: "GET",
                    data: {
                        search: request.term,
                    },
                    contentType: "json",
                    success: function (data) {

                        var parsedData = JSON.parse(data);
                        if (parsedData.length === 0) {

                            $('.client_group').val('Cash Account');
                            $('.truck_id').val('');
                            $('.client_name').val('').attr('readonly',false);
                            $('input[name=user_id]').val('');
                            $('input[name=contact_no]').val('').attr('readonly',false);;

                        } else {

                        response($.map(JSON.parse(data), function (item) {
                            return {
                                label: item.identifier,
                                val2: item.plate_no,
                                val:    item.id,
                                label1: item.name,
                                val1:    item.user_id,
                                label2: item.contact,
                                label3: item.client_group,
                            }
                       
                        }))
                    }
                     
                    },
                    error: function (response) {
                        alert(response.responseText);
                    },
                    failure: function (response) {
                        console.log("fve");

                        alert(response.responseText);
                    }
                });
            },
            select: function (e, i) {
              
                $('.truck_id').val(i.item.val);
                $('.auto_search_plate_no').val(i.item.value);
                $('.plate_no').val(i.item.val2);
                $('.client_name').val(i.item.label1).attr('readonly',true);
                $('input[name=user_id]').val(i.item.val1);
                $('input[name=contact_no]').val(i.item.label2).attr('readonly',true);
                $('.client_group').val(i.item.label3);


                // getClientAccountList(i.item.val1);
            },
            open: function() {
        // Get the autocomplete list element
                var autocompleteList = $(this).autocomplete("widget");

                // Add custom CSS class to the list element
                autocompleteList.addClass("custom-autocomplete-list");
            },
            minLength: 1
        });
    }


    function autoSearchClientName(event,tag)
    {
        event.preventDefault();

        var route = "{{ route('searchclientbyname') }}";

        $('input.auto_search_client_name').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: route,
                    type: "GET",
                    data: {
                        search: request.term,
                    },
                    contentType: "json",
                    success: function (data) {

                        response($.map(JSON.parse(data), function (item) {
                            return {
                                label: item.client_name,
                                label1: item.contact_no,

                              
                            }
                        }))
                    },
                    error: function (response) {
                        alert(response.responseText);
                    },
                    failure: function (response) {
                        alert(response.responseText);
                    }
                });
            },
            select: function (e, i) {
              
                $('.auto_search_client_name').val(i.item.label).attr('readonly',true);
                $('.contact').val(i.item.label1).attr('readonly',true);
            },
            open: function() {
        // Get the autocomplete list element
                var autocompleteList = $(this).autocomplete("widget");

                // Add custom CSS class to the list element
                autocompleteList.addClass("custom-autocomplete-list");
            },
            minLength: 1
        });
    }

    function getClientAccountList(client_id)
    {
        var route = "{{url('getclientaccountlist')}}";

        $.get(route,{client_id:client_id},function(data)
        {
            $('.account_list').html(data);

            document.querySelector('.account_list').fstdropdown.rebind();


        });
    }

</script>