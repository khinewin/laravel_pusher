@extends('layouts.app')
@section('title') Laravel RealTime with Pusher @stop
@section('content')
    <div class="container" id="app">
        <div class="row justify-content-center">
            <div class="col-md-8">

                    <div class="card-body" style="background: #fff; margin-bottom: 20px">
                        <div class="card-title">
                            <img src="https://cdn4.iconfinder.com/data/icons/green-shopper/1068/user.png" style="width: 30px">
                            {{$post->user->name}}
                            <div class="card-text small">Post On : {{$post->created_at->toFormattedDateString()}}</div>

                        </div>

                        <div class="card-text" style="margin-bottom: 30px">{{$post->content}}</div>
                        <div class="card-footer">
                            Comments
                            <div v-if="checkLogin">
                                <textarea v-model="comment_prop.comment_body" style="margin-bottom: 10px" class="form-control" placeholder="Leave Your Comments"></textarea>
                                <button @click.prevent="postComment()" type="submit" class="btn btn-primary">Save Comment</button>
                            </div>
                            <div v-else>
                                <div class="alert alert-warning">You should login to comment, <a href="/login">Login Now</a></div>
                            </div>
                            <div class="card-body" style="margin-top: 20px; background: #fff" v-for="comment in comments">
                                <div class="card-title small">
                                    <img src="https://cdn4.iconfinder.com/data/icons/green-shopper/1068/user.png" style="width: 30px">
                                    @{{comment.user.name}}
                                </div>
                                <div class="card-title small">@{{ comment.comment_body }}</div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    const app=new Vue({
        el : "#app",
        data: {
            checkLogin: {!! Auth::check() ? Auth::User()->id : 'null' !!},

            post : {!! $post->toJson() !!},
            comments : {},
            comment_prop: {
                user_id: {!! Auth::check() ? Auth::User()->id : 'null' !!},
                post_id : {!! $post->id !!},
                comment_body : ''
            }
        },
        created(){

            this.getComment();
            this.listen();
        },
        methods: {
            getComment(){
                axios.get('../api/posts/'+this.post.id+'/comments').then(doc=>{
                    this.comments=doc.data;
                }).catch(err=>{console.log(err)});
            },
          postComment(){
              axios.post('../api/comments',{
                  user_id : this.comment_prop.user_id,
                  post_id: this.comment_prop.post_id,
                  comment_body :this.comment_prop.comment_body
              }).then(doc=>{
                 // this.comments.unshift(doc.data);
                  this.comment_prop.comment_body='';
              }).catch(err=>{
                  console.log(err)
              })
          },
            listen(){
             /*   Echo.channel('post.'+this.post.id)
                    .listen('NewComment', (comment) => {
                        this.comments.unshift(comment);
                    }) */
                Echo.private('post.'+this.post.id)
                    .listen('NewComment', (comment) => {
                        this.comments.unshift(comment);
                    })
            }
        }
    })
</script>
@stop