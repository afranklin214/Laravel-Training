<div class="mb-2 mt-2">
    @auth
    <form action="{{ $route }}" method="POST">
        @csrf

        <div class="form-group">
        
            <textarea type="text" name="content" class="form-control"></textarea>
        </div>
    
        <button type="submit" class="btn btn-primary btn-block">Add comment</button>
    </form>
    <x-errors :errors="$errors->first('content')" />
@else
    <a href="{{ route('login') }}">Sign in </a>to post comments!
@endauth
</div>
<hr/>