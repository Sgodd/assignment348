@extends('layouts.layout')

@section('content')

    <div class="m-4 w-auto md:mx-auto md:w-3/5 p-4 rounded-lg shadow">
        <div class="m-4 w-auto p-4 pb-2 rounded-lg shadow">
            <form method="post" action="{{ route('posts.make') }}" enctype="multipart/form-data">
                @csrf 
                <span class="text-gray-700 text-lg font-semibold">{{ __("Create a post!") }}</span>
                <hr class="my-2 border-gray-300">
                <textarea class="input-form my-2 rounded-lg w-full  bg-gray-50 border-gray-200" rows=7 name="body" id="body" placeholder="Write something here."></textarea>
                <div class="block md:flex my-4 items-center">
                    <div class="block md:flex-none">
                        <label for="image" class="rounded-lg p-4 align-middle border-gray-200 bg-gray-50 border border-gray-100 hover:border-pink-700 cursor-pointer hover:bg-pink-600 hover:text-white transition duration-100 h-50">
                            Upload an Image
                            <input type="file" name="image" id="image" class="hidden" accept="image/x-png,image/gif,image/jpeg" onchange="onFileSelected(event)">
                        </label>
                    </div>
                    <div class="block md:flex-1 mt-6 md:mt-0 md:mx-auto">
                        <img class="rounded-lg max-w-1/4 mx-auto max-h-sm align-middle" id="imgpreview">
                    </div>
                </div>

                <hr class="my-2 mt-8 border-gray-300">
                <button id="post" type="submit" disabled class="disabled:opacity-50 mx-auto mt-4 w-1/2 text-xl font-bold block p-3 bg-pink-600 rounded-lg text-white transition duration-200 ease-in-out ">Post</button>
            </form>
        </div>

        <div class="mx-4 p-4 mb-4 justify-center align-middle">
            {{ $posts->onEachSide(1)->links() }}
        </div>

        <div class="mx-4 w-auto p-4 pt-1 rounded-lg shadow">
            @foreach ($posts as $post)
                @include("posts.postv2", $post)
            @endforeach
        </div>

        <div class="mx-4 mt-4 p-4 justify-center align-middle">
            {{ $posts->onEachSide(1)->links() }}
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


        // shows file preview of image selected
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

        // creates form to allow for a reply
        
        $(document).on("submit", ".like-form", function() {

            var form = $(this);
            var action = $(this).attr("action");
            var count = $($(this).find(".like-count")[0])

            var btn = $(this).children("button[name='like-btn']");
            var add = 1;
            

            if (btn.hasClass("liked")) {
                add = -1
                btn.removeClass("liked text-pink-600")
            } else {
                add = 1
                btn.addClass("liked text-pink-600")
            }

            count.html((+count.html()+add));


            $.ajax({
                "url":action,
                "method" : "post",
                "data": form.serialize(),
                "error":function(err) {
                    count.html((+count.html()-add));
                    if (add > 0) {
                        btn.removeClass("liked text-pink-600")
                    } else {
                        btn.addClass("text-pink-600");
                    }
                    
                }
            });

            return false;
        });

 
        // $(document).on("click", ".reply-btn", function() {
        //     $(this).siblings(".reply-form").removeClass("hidden");
        // });

        // $(document).on("click", ".delete-btn", function() {

        // });

        $(document).on("click", ".edit-btn", function() {
            var form = $(this).parent();

            var postText = form.parent().siblings(".post-text");
            postText.attr("contenteditable", true).focus();
            postText.addClass("bg-pink-100 border border-pink-600")

            var old = postText.html();

            postText.on("keydown", function(e) {

                if (e.which == 13 && !e.shiftKey) {
                 
                    postText.attr("contenteditable", false);
                    postText.off();

                    if (postText.html()) {
                        form.children('.edit-value').val(postText.html());
                        form.submit();
                        postText.removeClass("bg-pink-100 border border-pink-600")
                    } else {
                        postText.attr("contenteditable", false);
                        postText.off();
                        postText.html(old);
                        postText.removeClass("bg-pink-100 border border-pink-600")
                    }

                } else if (e.which == 27) {
                    postText.attr("contenteditable", false);
                    postText.off();
                    postText.html(old);

                    postText.removeClass("bg-pink-100 border border-pink-600")
                }
            });
        });

        $(document).on("submit", ".edit-form", function() {

            var form = $(this);
            var action = $(this).attr("action");

            $.ajax({
                "url":action,
                "method" : "put",
                "data": form.serialize(),
                "success": function(data) { 

                },
                "error":function(err) {
                    console.log(err.responseText);
                }
            });

            return false;

        });


        $(document).on("submit", ".delete-form", function() {
            var form = $(this);
            var post = $(this).closest(".replyable");
            var replyCount = post.parent().closest(".replyable").find('.reply-count')[0];

            if (!post.length) {
                post = $(this).closest(".post-body");
            }

            action = $(this).attr("action");
            $.ajax({
                "url":action,
                "method" : "post",
                "data": form.serialize(),
                "success": function(data) { 
                    post.remove();
                    $(replyCount).html(+$(replyCount).html()-1);
                },
                "error":function(err) {
                    console.log(err.responseText);
                }
            });

            return false;

        });

        $(document).on("submit", ".reply-form", function() {
            var form = $(this);
            var action = $(this).attr("action");

            var replyTo = $(this).closest(".replyable");
            var replyCount = replyTo.find('.reply-count')[0];

            if(!replyTo.length) {
                
                replyTo = $(this).parent().parent().siblings('.reply-section').children('.replyable');
                replyCount = replyTo.parent().find('.reply-count')[0];
            }

            $(replyCount).html(+$(replyCount).html()+1);

            $.ajax({
                "url":action,
                "method" : "post",
                "data": form.serialize(),
                "success": function(data) { 
                    replyTo.append(data);
                    form.addClass("hidden").children("input[type=text]").val("");
                    form.children("input[type=text]").attr('disabled', false);
                },
                "error":function(err) {
                    $(replyCount).html(+$(replyCount).html()-1);
                    form.children("input[type=text]").attr('disabled', false);
                    console.log(err.responseText);
                }
            })

            form.children("input[type=text]").attr('disabled', true);


            return false;
        });
        
    </script>
@endsection
