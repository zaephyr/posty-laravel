@extends("layouts.app")

@section('content')
    <div class="flex justify-center">
        <div class="w-2/3">
            <div class="p-6">
                <h1 class="text-2xl font-medium mb-1">{{ $user->username }}</h1>
                <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and recieved
                    {{ $user->receivedLikes->count() }} {{ Str::plural('like', $user->receivedLikes->count()) }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg">
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <x-post :post="$post" />
                    @endforeach

                    {{ $posts->links() }}
                @else
                    <p>{{ $user->username }} has no posts</p>
                @endif
            </div>

        </div>
    </div>
@endsection
