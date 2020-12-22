
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comment Create</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>
    <h1>Selected Post</h1>
    <ul>
        <li>Title: {{ $post->post_title}}</li>
        <li>IMAGE TO GO HERE</li>
        <li>{{$post->post_body}}</li>
        <li>Posted By: {{ $postedBy->first_name." ".$postedBy->last_name}}</li>
        <li>Tags:</li>
        @foreach ($tags as $tag) 
            {{ $tag->taggable->name }}</> 
        @endforeach
    </ul>

    @if ($isAdmin || (auth()->user()->id == $postedBy->id))
        <a href="{{ route('posts.edit', ['post'=>$post, 'tags'=>$tags]) }}">EDIT POST</a>
    @endif

    @if ($isAdmin || (auth()->user()->id == $postedBy->id))
        <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">DELETE</button>
        </form>
    @endif
    
    <div id="root">
        <ul v-for="comment in comments">
            <li>@{{ comment.comment_body }}</li>
            <li>Commented By: @{{ comment.user.first_name + " " + comment.user.last_name}}</li>
        </ul>

        <h2>New Comment</h2>
        Comment body: <input type="text" id="commentBody" v-model="newCommentBody"/>
        <input type="hidden" id="userId" v-model="newCommentUserId"/>
        <input type="hidden" id="postId" v-model="newCommentPostId"/>
        <button v-on:click="createComment">Create</button>
       
    </div>

    <script>

        var app = new Vue({
            el: "#root",
            data: {
                comments: [],
                newCommentBody: '',
                newCommentUserId: {!! json_encode(auth()->user()->id) !!},
                newCommentPostId: {!! json_encode($post->id) !!},
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
                       this.comments.push(response.data);
                       this.newCommentBody = '';
                       this.getComments();
                   }).catch(response => {
                       console.log(response);
                   })
                }
            },
            mounted(){
                this.getComments();
            }
        });
    </script>  
</body>
</html>
