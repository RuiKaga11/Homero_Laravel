@extends('layouts.app')

@section('title', 'カテゴリ管理 - Homero')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>カテゴリ管理
                    <a href="{{ route('categories.create') }}" class="btn btn-primary float-end">新規作成</a>
                    </h4>
                </div>
                <div class="card-body">
                    <x-alert />
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>カテゴリ名</th>
                                <th>作成日時</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">編集</a>
                                    <x-delete-button :route="route('categories.destroy', $category->id)" confirm-message="本当に削除しますか？関連するデータも削除される可能性があります" />
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
