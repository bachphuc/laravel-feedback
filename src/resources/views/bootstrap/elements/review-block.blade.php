@push('styles')
<style>
    .d-rating-control{
        position: relative;
        user-select: none;
    }
    .d-rating-control input[type='radio']{
        opacity: 0;
        position: absolute;
        width: 1px;
        height: 1px;
    }
    .d-rating-star{
        font-size: 3em;
        color: orange;
        user-select: none;
        cursor: pointer;
        transition-duration: 0.5s;
    }
    .d-rating-control input:checked + label .d-rating-star{
        color: orange;
    }
    .d-rating-control input:checked + label ~ label .d-rating-star{
        color: #999;
    }
</style>
@endpush

@php
    $icon = isset($icon) ? $icon : '★';
@endphp
<div class="mt-4">
    @if(auth()->check())
    <form action="{{Feedback::route('reviews.store')}}" method="POST" enctype="multipart/form-data">
        <div class="section-title">
            <h4 class="mb-4">@lang('feedback::lang.submit_your_review')</h4>
        </div>
        {{csrf_field()}}
        <input type="hidden" name="item_type" value="{{$item->getType()}}">
        <input type="hidden" name="item_id" value="{{$item->id}}">
        <div>
            <label for="">@lang('feedback::lang.rating_about_this')</label>
            <div>
                <span class="d-rating-control">
                    @for($i = 0; $i < 5; $i++)
                    <input type="radio" name="rating" value="{{$i + 1}}" id="rating-value-{{$i+1}}" {{isset($myReview) && $myReview->rating == $i + 1 ? 'checked' : (!isset($myReview) && $i === 4 ? 'checked' : '')}} />
                    <label for="rating-value-{{$i+1}}">
                        <span class="d-rating-star">{!! $icon !!}</span>
                        {{-- other icon ★ ☆ ⛤ ♡ ♥ --}}
                    </label>
                    @endfor
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="d-review-title">@lang('feedback::lang.title_review')</label>
            <input name="title" id="d-review-title" type="text" class="form-control" required value="{{isset($myReview) ? $myReview->title : ''}}">
        </div>
        <div class="form-group">
            <label for="d-review-content">@lang('feedback::lang.write_review')</label>
            <textarea name="content" id="d-review-content" cols="30" rows="5" class="form-control" required>{{isset($myReview) ? $myReview->content : ''}}</textarea>
        </div>
        <div class="form-group">
            <label for="d-review-img">@lang('feedback::lang.review_image')</label>
            <input id="d-review-img" name="image" type="file" class="form-control-file" accept="image/.*">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">@lang('feedback::lang.submit_review')</button>
        </div>
    </form>
    @endif
    <div class="mt-4">
        <div class="section-title">
            <h4 class="text-capitalize">@lang('feedback::lang.reviews')</h4>
        </div>
        @if(isset($review) && size_of($review))
            @foreach($review->items as $item)
            <div class="p-2 mb-3 bg-light mt-3">
                <p><strong>{{$item->user->name}}</strong> {{$item->title}}</p>
                <p>{{$item->content}}</p>
                @if($item->hasImage())
                <div>
                    <img src="{{$item->getImage()}}" alt="" style="max-width: 200px;max-height: 200px;">
                </div>
                @endif
                <div>
                    <small>{{$item->created_at}}</small>
                </div>
            </div>
            @endforeach
        @else
        <p>{{feedback_trans('no_reviews')}}</p>
        @endif
    </div>
</div>