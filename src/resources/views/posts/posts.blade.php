@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <th>User ID</th>
                            <th>Post ID</th>
                            <th>Reply Id</th>
                            <th>Name</th>
                            <th>Body</th>
                            <th>Date</th>
                        </tr>

                        @foreach ($posts as $post)
                            <tr>
                                <th>{{ $post->user->id}}</th>
                                <th><a href={{ route('posts.show', ['id' => $post->id])}}> {{ $post->id}} </a></th>
                                <th>
                                    @if ($post->reply_id)
                                        <a href={{ route('posts.show', ['id' => $post->reply_id])}}> {{ $post->reply_id}} </a>
                                    @endif
                                </th>
                                <th>{{ $post->user->name}}</th>
                                <th>{{ $post->text}}</th>
                                <th>{{ $post->created_at}}</th>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
