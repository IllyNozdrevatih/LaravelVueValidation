@extends('layouts.app')

@section('content')
    <div id="validation">
        <form action="{{ route('articles.store') }}" @submit.prevent="onSubmit" @keydown="errors.clear($event.target.name)" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Title</label>
                <div class="col-10">
                    <input class="form-control" name="title" type="text" id="example-text-input" v-model="title">
                    <span class="text-danger" v-text="errors.get('title')"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleTextarea">Description</label>
                <textarea class="form-control" name="description" id="exampleTextarea" rows="3" v-model="description" ></textarea>
                <span class="text-danger" v-text="errors.get('description')"></span>
            </div>
            <input type="file" v-on:change="onFileChange" class="form-control">
            <input type="submit" value="Создать" class="btn btn-primary">
        </form>
    </div>
    <a href="{{ url()->previous() }}" class="h5 text-primary">Назад</a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <script src="{{asset('js/article-validate.js')}}"></script>
@endsection