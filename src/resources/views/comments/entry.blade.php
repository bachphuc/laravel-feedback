<div class="p-2 mb-2 bg-light">
    <p><strong>{{$comment->user->name}}</strong> {{$comment->content}}</p>
    @if($comment->hasImage())
    <img style="max-width: 200px;max-height: 300px;" src="{{$comment->getImage()}}" />
    @endif
    <div><small class="text-muted">{{$comment->created_at}}</small></div>
</div>