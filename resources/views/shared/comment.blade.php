
<div class="">
    @if( $comment->user_id == 0 )
       <p><b>Unkown User</b></p> 
    @else
        <p><b>{{ $comment->user->name }}</b></p>
    @endif
    <p>{{ $comment->content }}</p>
    <p>{{ $comment->created_at }}<a href="javascript:;" style="float:right" id="replyButton" data-comment-id="{{ $comment->id }}">Reply</a></p>


    
    <div class="reply" style="margin-left:30px">

        
        <div class="replyList" id="replyLists{{$comment->id}}">
			@if(count($comment->replys) > 0)
                <div class="" style="padding-top:10px;border-top:1px solid #e2e1e1">
                @foreach ($comment->replys as $reply)
                    <p>
                        <span>
                            <b>
                                @if( $comment->user_id == 0 )
                                   Unkown User
                                @else
                                    {{ $comment->user->name }}
                                @endif
                            </b>
                        </span>
                        <span> : {{ $reply->content }}</span>
                    </p>
                    <p style="color:gray;font-size:13px"> {{ $reply->created_at }}</p>
                @endforeach
                <a href="javascript:;" id="replyButton" data-comment-id="{{ $comment->id }}">Reply..</a>
                </div>
            @endif

        </div>

        <!-- AJAX  -->
        <form class="form-inline" id="replyForm{{$comment->id}}" style="display:none">
            <input type="hidden" name="comment_id" value="{{$comment->id}}">
            <input type="text" name="content" class="form-control">
            <a class="btn btn-default" id="replyAJAX" data-comment-id="{{$comment->id}}">Reply</a>
        </form>
    </div>
    <hr>
</div>