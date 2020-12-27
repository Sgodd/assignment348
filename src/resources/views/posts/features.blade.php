@php
    
    $user = auth()->user();
    

    $likes = $post->likes;

    $liked = false;

    foreach ($likes as $like) {
        if ($like->user_id == $user->id and $like->post_id == $post->id) {
            $liked = true;
            break;
        }
    }

    
@endphp


<div class="mt-4 flex items-center space-x-4">
    
    <form class="like-form my-0" method="POST" action="toggleLike">
        @csrf
        <button type="submit" name="like-btn" class="@if ($liked)liked text-pink-600 @endif like-btn flex-none focus:outline-0 focus:outline-none accent-link hover:text-pink-600">
            <span class="inline like-count"> {{count($post->likes)}} </span>
            <svg class="inline align-text-top" width=20 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
            </svg>
            <input class="post-id" type="hidden" name="id" value={{$post->id}}>
        </button>
    </form>
    

    <button class="reply-btn flex-none focus:outline-0 focus:outline-none accent-link hover:text-pink-600">
        <svg width=20 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    </button>

    <form class="reply-form hidden flex-1 self-center my-auto" method="POST" action="posts/reply">
        @csrf
        <input class="form-input w-full align-middle items-center rounded-lg shadow border-0" type="text" name="reply" id="{{"reply-".$post->id}}" placeholder="Write something here..." autocomplete="off">
        <input class="reply-id" type="hidden" name="post_id" value="{{$post->id}}">
    </form>

    @if ($user->id == $post->user_id)
    
        <form class="my-0 edit-form" method="PUT" action="posts/edit">
            @csrf
            <input class="reply-id" type="hidden" name="post_id" value="{{$post->id}}">
            <input class="edit-value" type="hidden" name="text" value="">
            <button type="button" class="edit-btn flex-none focus:outline-0 focus:outline-none accent-link hover:text-pink-600">
                <svg width=20 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
        </form>

        <form class="my-0 delete-form" method="POST" action="posts/delete">
            @csrf
            <input class="reply-id" type="hidden" name="post_id" value="{{$post->id}}">
            <button class="delete-btn flex-none focus:outline-0 focus:outline-none accent-link hover:text-pink-600" type="submit">
                <svg width=20 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </button>
        </form>



    @endif
</div>

