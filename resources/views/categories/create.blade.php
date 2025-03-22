@extends('layouts.app')

@section('title', 'カテゴリ新規作成 - Homero')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>カテゴリ新規作成</h4>
                </div>
                <div class="card-body">
                    <x-form-errors />

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <x-form-input name="name" label="カテゴリ名" :value="old('name')" required="true" />
                        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">登録</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">キャンセル</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
