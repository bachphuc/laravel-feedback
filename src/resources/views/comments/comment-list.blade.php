@if(isset($comments))
@foreach($comments as $comment)
@include('feedback::comments.entry')
@endforeach
@else
<p>{{feedback_trans('no_comments')}}</p>
@endif