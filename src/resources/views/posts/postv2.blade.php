@php
    $replies = $post->replies;
    $count = count($replies)

    
@endphp

<div class="post-body text-gray-700 mt-6" id="{{"post-".$post->id}}"">
    <div class="mx-4 w-auto p-4 rounded-t-lg bg-pink-600 text-white shadow z-0 relative" >
        <div class="w-full inline-block items-center">

            <div class="inline-block align-middle">
                @if ($post->user->image_id) 
                    <img class="mx-auto shadow h-auto w-12 bg-gray-50 rounded-full" src="{{asset("storage/".$post->user->image->path)}}" alt="">
                @else 
                    <img class="mx-auto shadow h-auto w-12 bg-gray-50 rounded-full" src="{{asset("storage/profiles/default.png")}}" alt="">
                @endif
            </div>
            <div class="ml-2 inline-block align-middle">
                <span class="text-xs font-bold">Posted at {{date_format(($post->created_at), "d/m/Y H:i")}}</span><br>
                <span class="text-sm font-semibold">by {{$post->user->name}}</span><br>
            </div>
            
        </div>
    </div>
    <div class="mx-4 w-auto p-4 shadow z-20 relative">
        <span class="post-text w-full block">{!! $post->text !!}</span>
        @if ($post->image_id)
            <img class="mx-auto shadow h-auto max-w-full p-4 bg-gray-50 shadow my-4" src="{{asset("storage/".$post->image->path)}}" alt="">
        @endif
        <hr class="my-2 border-gray-300">
  
        @include('posts.features', ['post' => $post])
    </div>
    <div class="mx-4 w-auto p-4 rounded-b-lg bg-gray-50 shadow z-10 relative reply-section">

        <div class="w-full replyable">
            <div class="w-full">
                <span class="text-xs font-bold reply-count">{{$count}}</span> {{($count == 1 ? " Reply" : " Replies")}}<span></span><br>
            </div>
            @foreach ($replies as $reply)
                @if ($reply->deleted_at == null)
                    @include("posts.reply", ["depth" => 0, "reply"=>$reply, "deleted"=>false])
                @else 
                    @include("posts.reply", ["depth" => 0, "reply"=>$reply, "deleted"=>true])
                @endif
            @endforeach
        </div>
    </div>
</div>