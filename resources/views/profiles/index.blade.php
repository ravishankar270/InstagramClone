@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 p-5">
                <img src="{{ $user->profile->profileImage() }}" alt="logo of user" class="rounded-circle w-100">
            </div>
            <div class="col-9 pt-5">
                <div class='d-flex justify-content-between align-items'>
                <div class='d-flex align-items-center pb-4'>
                    <div class='h4'>{{ $user->Username }}</div>
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
                    @can('update', $user->profile)
                        <a href="/p/create">Add New Post</a>
                    @endcan
                </div>
                @can('update', $user->profile)
                    <a href="/p/{{ $user->id }}/edit">Edit Profile</a>
                @endcan
                <div class='d-flex'>
                    <div class='pr-5'><strong>{{ $postCount }}</strong>posts</div>
                    <div class='pr-5'><strong>{{ $followersCount }}</strong>Followers</div>
                    <div class='pr-5'><strong>{{ $followingCount }}</strong>Following</div>
                </div>
                <div class='pt-4 font-weight-bold'>{{ $user->profile->title }}</div>
                <div>{{ $user->profile->description }}</div>
                <div> <a href="#">{{ $user->profile->url }}</a></div>
            </div>
        </div>
        <div class="row pt-5">
            @foreach ($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href="/p/{{ $post->id }}">
                        <img class='w-100' src="/storage/{{ $post->image }}" alt="">
                    </a>
                </div>
            @endforeach

        </div>
    @endsection
