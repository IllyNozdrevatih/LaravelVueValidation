@extends('layouts.app')

@section('content')
        <!-- Title -->
                <h1 class="mt-4">{{ $article->title }}</h1>

                <p class="mt-3">{{ $article->getCategories() }}</p>
                <hr>
                <!-- Author -->
                <p class="lead">
                    by
                    <a href="#">{{ $article->user->name }}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p>{{ $article->updated_at }}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-fluid rounded" src="{{ asset('/storage/'.$article->image) }}" style="width: 900px;height: 300px;" alt="">

                <hr>

                <!-- Post Content -->
                <p>
                    {{ $article->description }}
                </p>

                <div class="card my-4">
                    <h5 class="card-header">Оставить коментарий:</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <input class="form-control" rows="3" id="content" name="content">
                        </div>
                        <button type="submit" class="btn btn-primary" id="sand_comment" >Отправить</button>
                    </div>
                </div>
                <div class="card p-3 mb-2" >
                    <h4 class="pb-2">Коментарии:</h4>
                    <div id="article_comments">
                        @foreach ( $article->comments->sortByDesc('created_at') as $comment)
                        <div class="media">
                            <div class="media-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mt-0">{{ $comment->user->email }}</h5>
                                    </div>
                                    @if (Auth::user()->id == $comment->user->id )
                                    {{ Form::open(['route'=> ['comments.delete',$comment->id],'method' => 'delete']) }}
                                        <div class="col text-right del_btn" >
                                            <button class="btn btn-danger" name="del">X</button>
                                        </div>
                                    {{ Form::close() }}
                                    @endif
                                </div>
                                {{ $comment->content }}
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
<script>
    $(function() {
        $('#sand_comment').click(function () {
            var content = $('#content').val();
            $.ajax({
                url:'{{ route('comments.store-get-comment',$article->id) }}',
                type:'GET',
                data:{
                    'content':content,
                    '_token':"{{ csrf_token() }}",
                },
                success:function (data) {
                    $('#content').val('');
                    $('#article_comments').prepend('<div class="media">'+
                        '<div class="media-body">'+
                        '<div class="row"><div class="col"><h5 class="mt-0">'+data[1]+'</h5></div></div>'+
                        data[0].content+'</div></div><hr>');
                }
            });
            return false;
        });
    });
</script>
@endsection


