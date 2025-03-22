@props(['route', 'confirm-message' => '本当に削除しますか？', 'button-text' => '削除'])

<form action="{{ $route }}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">
        <i class="far fa-trash-alt"></i> {{ $button-text }}
    </button>
</form> 