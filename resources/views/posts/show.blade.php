<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Post</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/additionalStyle.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    
</head>
<body>
    <a href="{{ route('home') }}" class="btn btn-secondary custom-corner-button">Back</a>

    @if ($errors->any())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-danger">{{ __('Errors') }}</div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($errors->all() as $error)
                                    <li class="list-group-item list-group-item-light">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('message'))
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-success">{{ __('Success') }}</div>
                        <div class="card-body">
                            <ul class="list-group">
                                @if (session('message'))
                                    <li class="list-group-item list-group-item-light">{{ session('message') }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
        
    <div id="wrapper">
        <div id="first">
            <div class="card">
                <div class="card-header">{{ __('Selected Post:') }}</div>
                <div class="card-body">
                    <li class="list-group-item list-group-item-light">Title: {{ $post->post_title}}</li>
                    @if ($post->post_image !== null)
                        <li class="list-group-item list-group-item-light"><img src="{{ asset('storage/images/'.$post->post_image) }}" alt="post_image" class="display-image"/></li>
                    @endif
                    <li class="list-group-item list-group-item-light">{{$post->post_body}}</li>
                    <li class="list-group-item list-group-item-light">Posted By: {{ $postedBy->first_name." ".$postedBy->last_name}}</li>
                    <li class="list-group-item list-group-item-light">Tags:
                        @foreach ($tags as $tag) 
                            {{ $tag->taggable->name }}</> 
                        @endforeach
                    </li>
                    <div id="outer">
                        <div class="inner">
                            @if ($isAdmin || (auth()->user()->id == $postedBy->id))
                                <a href="{{ route('posts.edit', ['post'=>$post, 'tags'=>$tags]) }}" class="btn btn-secondary">EDIT</a>
                            @endif
                        </div>
                        
                        <div class="inner">
                            @if ($isAdmin || (auth()->user()->id == $postedBy->id))
                                <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light">DELETE</button>
                                </form>
                            @endif 
                        </div>
                    </div>
                </div>
            </div>        
        </div>
        <div id="second">
            <div class="card">
                <div class="card-header">{{ __('Comments:') }}</div>
                <div class="card-body">
                    <div id="root">
                        <div v-if="comments.length !== 0">
                            <ul v-for="comment in comments" class="list-group">
                                <li class="list-group-item list-group-item-light">
                                    <div class="comment-div">
                                        <div>@{{ comment.comment_body }}</div>
                                        <div>Commented By: @{{ comment.user.first_name + " " + comment.user.last_name}}</div>
                                    </div>
                                    <div class="comment-edit" v-if="comment.user_id == newCommentUserId || {!! json_encode(auth()->user()->id == 1) !!}">
                                        <a v-on:click="commentEditRoute(comment.id)"
                                            class="btn btn-secondary">EDIT</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div id="outer">
                            <div class="inner">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">New Comment:</span>
                                    </div>
                                    <input type="text" id="commentBody" v-model="newCommentBody" class="form-control"/>
                                </div>
                            </div>
                            <div class="inner">
                                <input type="hidden" id="userId" v-model="newCommentUserId"/>
                                <input type="hidden" id="postId" v-model="newCommentPostId"/>
                                <button v-on:click="createComment" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>
    
    <script>
        var app = new Vue({
            el: "#root",
            data: {
                comments: [],
                newCommentBody: '',
                newCommentUserId: {!! json_encode(auth()->user()->id) !!},
                newCommentPostId: {!! json_encode($post->id) !!}
            },
            methods: {
                getComments: function(e) {
                    axios.get("http://coddiscussionapp.test/api/comments/"+{!! json_encode($post->id) !!})
                    .then(response => {
                       this.comments = response.data;
                       console.log(this.comments)
                   }).catch(response => {
                       console.log(response);
                   })
                },
                createComment: function(e) {
                   axios.post("{{ route('api.comments.store') }}", {
                       comment_body: this.newCommentBody,
                       user_id: this.newCommentUserId,
                       post_id: this.newCommentPostId
                   }).then(response => {
                       this.newCommentBody = '';
                       this.getComments();
                   }).catch(response => {
                       console.log(response);
                   })
                },
                commentEditRoute: function (tagParam) {
                    route = "{{ route("comments.edit", ["comment" => "?tagReplace?"]) }}"
                    location.href = route.replace('?tagReplace?', tagParam)
                }
            },
            mounted(){
                this.getComments();
            }
        });
    </script> 
</body>
</html>
