@if(isset($review) && $review)
<span>
    <span>
        <span class="text-warning">★</span>
        <span>★</span>
        <span>★</span>
        <span>★</span>
        <span>★</span>
    </span>
    <span>(113 @lang('feedback::lang.reviews'))</span>
</span>
@else
<span>
    <span>
        <span class="text-muted">★</span>
        <span class="text-muted">★</span>
        <span class="text-muted">★</span>
        <span class="text-muted">★</span>
        <span class="text-muted">★</span>
    </span>
    <span>(0 @lang('feedback::lang.review'))</span>
</span>
@endif