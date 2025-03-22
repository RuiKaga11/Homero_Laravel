@props(['user'])

@if(Auth::check() && Auth::id() !== $user->id)
    @if(Auth::user()->isFollowing($user))
        <form action="{{ route('users.unfollow', $user) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill">
                <i class="fas fa-user-minus"></i> フォロー中
            </button>
        </form>
    @else
        <form action="{{ route('users.follow', $user) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary rounded-pill">
                <i class="fas fa-user-plus"></i> フォローする
            </button>
        </form>
    @endif
@endif 