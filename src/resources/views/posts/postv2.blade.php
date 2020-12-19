@php
    $replies = $post->replies;
    $count = count($replies)

    
@endphp

<div class="text-gray-700 mt-6">
    <div class="mx-4 w-auto p-4 rounded-t-lg bg-pink-600 text-white shadow z-0 relative" >
        <div class="w-full">
            <span class="text-xs font-bold">Posted at {{date_format(($post->created_at), "d/m/Y H:i")}}</span><br>
            <span class="text-sm font-semibold">by {{$post->user->name}}</span><br>
        </div>
    </div>
    <div class="mx-4 w-auto p-4 shadow z-20 relative">
        <div class="w-full">
            <span>{{$post->text}}</span>
        </div>
    </div>
    <div class="mx-4 w-auto p-4 rounded-b-lg bg-gray-50 shadow z-10 relative">
        <div class="w-full">
            <span class="text-xs font-bold"> {{ $count . ($count == 1 ? " Reply" : " Replies")}} </span><br>
        </div>

        <div class="w-full">
            @foreach ($replies as $reply)
                @include("posts.reply", ["depth" => 0, "reply"=>$reply])
            @endforeach
        </div>
    </div>
</div>