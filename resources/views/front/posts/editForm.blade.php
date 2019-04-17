<form method="POST" action="{{ route('update.comment') }}">
    @method('POST')
    @csrf
    <input type="hidden" id="id" name="id" value="{{base64_encode($comment->id)}}">
    <div class='form-group'>
        <textarea class='form-control rounded-0' id='content' row='10' name='content' required>{{$comment->content}}</textarea>
    </div>
    <div class='form-group'>
        <button type='submit' class='btn btn-primary'>
            Edit
        </button>
    </div>
</form>