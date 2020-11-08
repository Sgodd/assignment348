@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Posted by ') . $post->user->name }}</div>

                <div class="card-body">

                    {{ $post->text }}

                </div>


            </div>

            @foreach ($replies as $reply)
                <div class="card">
                    <div class="card-header">{{ __('Reply from ') . $reply->user->name }}</div>
                        <div class="card-body">
                            <p>{{ $reply->text }}</p>
                            @if (count($reply->replies)>0)
                                <a href={{ route('posts.show', ['id' => $reply->id])}} class="card-link"> See Replies </a>
                            @endif
                        </div>
                </div>
            @endforeach



        </div>
    </div>
</div>
@endsection
