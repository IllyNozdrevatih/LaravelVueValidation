@extends('layouts.app')

@section('content')
            <h1 class="my-4">Главная</h1>
            @foreach( $articles as $article)
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">{{ $article->title }}</h2>
                        <p class="card-text">{{ str_limit($article->description,300) }}</p>
                        <a href="{{ 'articles/'.$article->id }}" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        Posted on {{ $article->created_at->format('M d Y') }} by
                        <a href="#">{{ $article->user->email }}</a>
                    </div>
                </div>
            @endforeach
@endsection

