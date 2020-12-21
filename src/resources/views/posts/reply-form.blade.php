<div class="mt-4 flex items-center">
    <button class="reply-btn flex-none focus:outline-0 focus:outline-none accent-link hover:text-pink-600 ml-4">
        <svg width=20 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    </button>

    <form class="reply-form hidden flex-1 ml-4 self-center my-auto" method="POST" action="posts/reply">
        @csrf
        <input class="form-input w-full align-middle items-center rounded-lg shadow border-0" type="text" name="reply" id="{{"reply-".$post_id}}" placeholder="Write something here..." autocomplete="off">
        <input class="reply-id" type="hidden" name="reply_id" value="{{$post_id}}">
    </form>
</div>

