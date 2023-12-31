@if($posts->count())
    <x-post-featured-card :post="$posts->first()"/>

    @if($posts->count() > 1)
        <div class="lg:grid lg:grid-cols-6">
            @foreach($posts->skip(1) as $post)
                <x-post-card 
                    :post="$post" 
                    class="{{$loop->iteration < 3 ? 'col-span-3' : 'col-span-2'}}"
                />
            @endforeach
        </div>
    @endif

    <div class="lg:grid lg:grid-cols-3">
    </div>
@else
    <p>No posts yet. Check back later.</p>
@endif