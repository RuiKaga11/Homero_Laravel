@extends('layouts.app')

@section('title', 'アカウント削除確認 - Homero')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-danger text-white">アカウント削除の確認</div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <h4 class="alert-heading">警告！</h4>
                    <p>アカウントを削除すると、全てのツイートやいいね情報などのデータが完全に削除されます。この操作は取り消せません。</p>
                </div>

                <form method="POST" action="{{ route('users.destroy', ['user' => Auth::id()]) }}">
                    @csrf
                    @method('DELETE')

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('users.show', Auth::id()) }}" class="btn btn-secondary">キャンセル</a>
                        <button type="submit" class="btn btn-danger">
                            アカウントを削除する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 