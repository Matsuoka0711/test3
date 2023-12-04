@extends('layouts.app')

@section('content')
<div class="container">
    <a class="btn btn-secondary mb-3 me-3" href="{{ route('list') }}" role="button">戻る</a>
    <a class="btn btn-warning mb-3" href="{{ route('show.update', $product->id) }}">編集</a>
    
    <table class="table table-striped text-center table-bordered">
        <tr>
            <th class="p-4 w-25">ID</th>
            <td class="p-4 text-sm-start">{{ $product->id }}</td>
        </tr>
        <tr>
            <th class="p-4">商品名</th>
            <td class="p-4 text-sm-start">{{ $product->name }}</td>
        </tr>
        <tr>
            <td class="p-4 align-middle">商品画像</td>
            <td class="d-flex align-middle table-striped justify-content-start">
                @if($product->img_path === '')
                <p class="mt-5 mb-5">※画像がありません</p>
                @else
                <img src="{{ asset($product->img_path) }}" alt="" width="100px" height="100px">
                @endif
              </td>
        </tr>
        <tr>
            <th class="p-4">商品価格</th>
            <td class="p-4 text-sm-start">¥{{ $product->price }}</td>
        </tr>
        <tr>
            <th class="p-4">在庫数</th>
            <td class="p-4 text-sm-start">{{ $product->stock }}</td>
        </tr>
        <tr>
            <th class="p-4">メーカー名</th>
            <td class="p-4 text-sm-start">{{ $product->company->company_name }}</td>
        </tr>
        <tr>
            <th class="p-4">コメント</th>
            <td class="p-4 text-sm-start">{{ $product->comment }}</td>
        </tr>
    </table>

</div>
@endsection