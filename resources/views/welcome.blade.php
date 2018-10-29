@extends('layouts.app')
@section('title') Laravel RealTime with Pusher @stop
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($posts as $post)
                    <div class="card-body" style="background: #fff; margin-bottom: 20px">
                        <div class="card-title">
                            <img src="https://cdn4.iconfinder.com/data/icons/green-shopper/1068/user.png" style="width: 30px">
                            {{$post->user->name}}</div>

                        <div class="card-text">{{$post->content}}</div>
                        <a href="{{route('post',['post'=>$post->id])}}">read more >></a>
                        <hr>
                        <div class="card-text small">Post On : {{$post->created_at->toFormattedDateString()}}</div>
                    </div>
                    @endforeach
            </div>
        </div>
    </div>
@endsection
