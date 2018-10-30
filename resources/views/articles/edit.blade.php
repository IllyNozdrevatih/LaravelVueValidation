@extends('layouts.app')

@section('content')
         {{ Form::open(['route' => ['articles.update',$article] , 'method' => 'put', 'files' => true]) }}
            <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Title</label>
                <div class="col-10">
                    <input class="form-control" name="title" type="text" id="example-text-input" value="{{ $article->title }}">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleTextarea">Description</label>
                <textarea class="form-control" name="description" id="exampleTextarea" rows="3">{{ $article->description }}</textarea>
            </div>
            <div class="form-group">
                <div><label for="exampleTextarea">Image</label></div>
                <input name="image" type="file" id="example-text-input" value="{{ $article->image }}">
            </div>
            @foreach( $categories as $category)
                <input type="checkbox" name="categories[]" value={{$category->id}} @if(count($article->categories->whereIn('id',$category->id))) checked @endif>{{ $category->name }}
            @endforeach
            <input type="submit" value="Создать" class="btn btn-primary" >
            <input type="hidden" name="_method" value="put">
        {{ Form::close() }}
         <a href="{{ url()->previous() }}" class="h5 text-primary">Назад</a>
@endsection