@extends('layouts.layout')

@section('content')

    <div class="m-4 w-auto md:mx-auto md:w-3/5 p-4 rounded-lg shadow">
        <div class="m-4 w-auto p-4 pb-2 rounded-lg shadow">
            <form method="" action="{{-- route('post') --}}">
                <span class="text-gray-700 text-lg font-semibold">{{ __("Create a post!") }}</span>
                <hr class="my-2 border-gray-300">
                <textarea class="input-form my-2 rounded-lg w-full  bg-gray-50 border-gray-200" rows=7 name="body" id="body" placeholder="Write something here."></textarea>
                <div class="block md:inline-flex my-4 items-center justify-between">
                    <div class="block md:flex-none">
                        <label for="image" class="rounded-lg p-4 align-middle border-gray-200 bg-gray-50 border border-gray-100 hover:border-pink-700 cursor-pointer hover:bg-pink-600 hover:text-white transition duration-100 h-50">
                            Upload an Image
                            <input type="file" name="image" id="image" class="hidden" accept="image/x-png,image/gif,image/jpeg" onchange="onFileSelected(event)">
                        </label>
                    </div>
                    <div class="block text-center justify-center items-center md:ml-4 mt-6 md:mt-0">
                        <img class="rounded-lg max-w-1/4 mx-auto max-h-sm align-middle" id="imgpreview">
                    </div>
                </div>

                <hr class="my-2 border-gray-300">
                <button id="post" type="submit" disabled class="disabled:opacity-50 mx-auto mt-4 w-1/2 text-xl font-bold block p-3 bg-pink-600 rounded-lg text-white transition duration-200 ease-in-out ">Post</button>
            </form>
        </div>

        <div class="mx-4 w-auto p-4 pt-1 rounded-lg shadow">
            @foreach ($posts as $post)
                @include("posts.postv2", $post)
            @endforeach
        </div>
    </div>


    <script>
        // disables and enables the post button
        $("#post").attr('disabled', true);
        $("#body").on('keyup', function() {
            var post = $("#post")
            if (this.value.length > 0) {
                post.attr('disabled', false).addClass("hover:bg-pink-700")
            } else {
                post.attr('disabled', true).removeClass("hover:bg-pink-700");
            }
        });

        function onFileSelected(event) {
            var selectedFile = event.target.files[0];
            var reader = new FileReader();

            var imgtag = document.getElementById("imgpreview");
            imgtag.title = selectedFile.name;

            reader.onload = (event) => {
                imgtag.src = event.target.result;
            };

            reader.readAsDataURL(selectedFile);
            
        }
    </script>
@endsection
