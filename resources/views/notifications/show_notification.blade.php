@if(@count($notify_list) > 0)
     
	@foreach($notify_list as $rows)

	@if($rows->params > 0)

		@php($route = route($rows->route,['id' => encrypt($rows->params)]))
	@else
		@if(!empty(trim($rows->route)))
		@php($route = url($rows->route))
		@else
		@php($notify_route = "#")
		@endif
	@endif
    <a href="{{$route}}" class="text-dark" onclick="seenNotification(event,this,'{{encrypt($rows->id)}}')">

    <div class="media">

        <div class="media-body">
                <p class="notification-msg">{{$rows->message}}</p>
                <span class="notification-time">{{$rows->created_at->diffForHumans()}}</span>
        </div>

    </div>
    </a>

	@endforeach
	
	
	
@else
<a href="#" class="navi-item" >
    <div class="navi-link mb-4" style="clear:both;">
	        <div class="navi-icon mr-2" style="float:left !important; width: 20px;">
	            <i class="flaticon-chat-1 text-success"></i>
	        </div>
	        <div class="navi-text" style="float:right !important; width:90%;">
	            <div class="font-weight-bold">No record found.</div>
	        </div>
	    </div>
</a>
@endif