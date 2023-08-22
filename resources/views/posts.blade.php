@extends('layout')

@section('banner')
    <h1>My Blog</h1>
@endsection
@section('content')
    @foreach($posts as $post)
        <article>
            <h1>
                <a href="/posts/<?= $post->id; ?>">
                    <?= $post->title ;?>
                </a>
            </h1>

            <p>
                By <a href="authors/{{$post->author->id}}">{{  $post->author->name }}</a> in <a href="/categories/{{$post->category->slug}}">{{ $post->category->name }}</a>
            </p>

            <div>
                <?= $post->body; ?>
            </div>
        </article>
    @endforeach
@endsection