@php
    $replies = $reply->replies;
    $count = count($replies)   
@endphp


<div class="border-l-2 w-full border-pink-600 mt-2 pl-4 replyable" id="{{"post-".$reply->id}}">
    @if (!$deleted) 
        <span class="font-bold text-sm">{{$reply->user->name}}</span>
        <span class="text-xs font-bold reply-count">{{$count}}</span> {{($count == 1 ? " Reply" : " Replies")}}<span></span><br>
        <span class="post-text block w-full">{!! $reply->text !!}</span>
    @else 
        <span class="font-bold text-sm text-gray-300"><i>deleted</i></span>
        <span class="text-xs font-bold reply-count">{{$count}}</span> {{($count == 1 ? " Reply" : " Replies")}}<span></span><br>
        <span class="text-gray-300"><i>deleted</i></span>
    @endif  

    <hr class="my-2 border-gray-300">
    
    @include('posts.features', ['post' => $reply])
    @if ($depth < 10)
        @foreach ($replies as $reply)
            @if ($reply->deleted_at == null)
                @include("posts.reply", ["depth" => $depth+1, "reply"=>$reply, "deleted"=>false])
            @else 
                @include("posts.reply", ["depth" => $depth+1, "reply"=>$reply, "deleted"=>true])
            @endif
        @endforeach
    @endif
</div>