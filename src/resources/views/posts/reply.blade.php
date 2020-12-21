@php
    $replies = $reply->replies;
    $count = count($replies)
@endphp


<div class="border-l-2 w-full border-pink-600 mt-2 pl-4 replyable" id="{{"post-".$reply->id}}">
    <span class="font-bold text-sm">{{$reply->user->name}}</span>
    <span class="text-xs font-bold reply-count">{{$count}}</span> {{($count == 1 ? " Reply" : " Replies")}}<span></span><br>
    <span class="">{{$reply->text}}</span>
    <hr class="my-2 border-gray-300">
    
    @include('posts.reply-form', ['post_id' => $reply->id])
    @if ($depth < 3)
        @foreach ($replies as $reply)
            @include("posts.reply", ["depth" => $depth+1, "reply"=>$reply])
        @endforeach
    @endif
</div>