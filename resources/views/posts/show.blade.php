@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img class="w-100" src="/storage/{{ $post->image }}" alt="image">
        </div>

        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div>
                        <img src="{{ $post->user->profile->profileImage() }}" alt="profile" style="max-width:40px" class="rounded-circle w-100">
                    </div>
                    <div class="px-3">
                        <div class="fw-bold">
                            <a class="text-decoration-none" href="/profile/{{$post->user->id}}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>  |
                            <a href="#" class="text-decoration-none px-1">Follow</a>
                        </div>
                    </div>
                </div>

                <hr>

                <p>
                    <a class="text-decoration-none" href="/profile/{{$post->user->id}}">
                        <span class="fw-bold text-dark">{{ $post->user->username }}</span>
                    </a> 
                    {{ $post->caption }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
