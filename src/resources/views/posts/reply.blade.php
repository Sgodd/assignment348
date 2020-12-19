@php
    $replies = $reply->replies;
    $count = count($replies)
@endphp


<div class="border-l-2 w-full border-pink-600 mt-2 pl-4">
    <span class="font-bold text-sm">{{$reply->user->name}}</span>
    <span class="font-bold text-xs ml-4">{{ $count . ($count == 1 ? " Reply" : " Replies")}}</span><br>
    <span class="">{{$reply->text}}</span>

    @if ($depth < 3)
        @foreach ($replies as $reply)
            @include("posts.reply", ["depth" => 0, "reply"=>$reply])
        @endforeach
    @endif


</div>