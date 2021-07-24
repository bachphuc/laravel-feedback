<div>
    <p class="mt-2">{{$item->getTitle()}}</p>
    <div>
        <div>
            <form onsubmit="return commentFormSubmit(event)" action="{{Feedback::route('comments.store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="item_type" value="{{$item->getType()}}" />
                <input type="hidden" name="item_id" value="{{$item->getId()}}" />
                <div class="form-group">
                    <input name="content" class="form-control" type="text" placeholder="{{feedback_trans('input_comment')}}" required />
                </div>
                <div class="form-group">
                    <label for="comment-img">{{feedback_trans('image')}}</label>
                    <input class="form-control-file" id="comment-img" type="file" name="image" accept="image/*" />
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">{{feedback_trans('write_comment')}}</button>
                </div>
            </form>
        </div>
        <div class="mt-4" id="comment-list">
            @include('feedback::comments.comment-list')
        </div>
    </div>
</div>

<script>
    function commentFormSubmit(e){
        const f = e.target, r = new XMLHttpRequest(), l = document.getElementById('comment-list');
        r.onload = () => {
            if(r.readyState === 4 && r.status === 200){
                const n = document.createElement('div');
                n.innerHTML = r.responseText, l.childElementCount > 0 ? l.insertBefore(n.firstChild, l.firstChild) : l.appendChild(n.firstChild) , f.reset();
            }
        }, r.open(f.method, f.action), r.setRequestHeader('X-Requested-With', 'XMLHttpRequest'), r.send(new FormData(f)), e.preventDefault();
        return false;
    }

    window.addEventListener('load', () => {
        function loadComment(){
            const r = new XMLHttpRequest(), l = document.getElementById('comment-list');
            r.onload = () => {
                if(r.readyState === 4 && r.status === 200){
                    l.innerHTML = r.responseText;
                }
            }
            r.open('GET', '{!! Feedback::route('comments.index', ['item_type' => $item->getType(), 'item_id' => $item->id]) !!}'),r.setRequestHeader('X-Requested-With', 'XMLHttpRequest'), r.send();
        }

        loadComment();
    })
</script>