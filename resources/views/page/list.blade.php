@extends('layouts.app')
@section('title', '投稿画面')
@section('content')
<div class="container">
  <nav class="d-flex align-items-center">
    <div>
      <a class="btn btn-success" href="{{ route('regist') }}" role="button">新規登録</a>
    </div>

    <div class="search-box ps-5 d-flex " id="search-box">
      <div class="w-100 d-flex mb-3">
        <div class="me-4">
          <p class="text-center fw-bold">商品名</p>
          <input class="form-control justify-content-ceneter m-3" type="text" placeholder="キーワードを入力" name="name_search" id="name_search">
        </div>
        <div class="me-4">
          <p class="text-center fw-bold">メーカー選択</p>
          <select class="form-select justify-content-ceneter m-3" name="company_name_search" id="company_name_search">
            <option value="">全てのメーカを選択</option>
            @foreach ($companies as $company)
            <option name="company_name_search" value="{{ $company->company_name }}">{{ $company->company_name }}</option>
            @endforeach
          </select>
      </div>
    </div>
  
    <div class="w-100 d-flex">
      <div class="me-4">
        <p class="text-center fw-bold">価格</p>
        <input class="form-control justify-content-ceneter m-3"  type="number" step="10" placeholder="上限価格" name="max_price_search" id="max_price_search" min="0">
        
        <input class="form-control justify-content-ceneter m-3"  type="number" step="10" placeholder="下限価格" name="min_price_search" id="min_price_search" min="0">      
      </div>
      <div>
        <p class="text-center fw-bold">在庫数</p>
        <input class="form-control justify-content-ceneter m-3"  type="number" placeholder="上限在庫数" name="max_stock_search" id="max_stock_search" min="0">
        
        <input class="form-control justify-content-ceneter m-3"  type="number" placeholder="下限在庫数" name="min_stock_search" id="min_stock_search" min="0">      
      </div>
    </div>
  </div>



  </nav>
  @if (session('message'))
  <div class="alert alert-danger">
  {{ session('message') }}
  </div>
  @endif 

  <div class="row">
    <table class="table table-striped text-center table-bordered" >
      <thead>
        <tr>
          <th scope="col">ID @sortablelink('id', '↕︎')</th>
          <th scope="col">商品名 @sortablelink('name', '↕︎')</th>
          <th scope="col">商品画像</th>
          <th scope="col">価格 @sortablelink('price', '↕︎')</th>
          <th scope="col">在庫 @sortablelink('stock', '↕︎')</th>
          <th scope="col">メーカー名 @sortablelink('company_id', '↕︎')</th>
          <th scope="col">詳細</th>
          <th scope="col">削除</th>
        </tr>
      </thead>
      <tbody id="Content">
      @if ($products->count() === 0)
          <tr>
            <td colspan="8" class="text-center">商品が登録されていません</td>
          </tr>
        @else
        @foreach ($products as $product)
          <tr>
            <td class="align-middle table-striped">{{ $product->id }}</td>
            <td class="align-middle table-striped">{{ $product->name }}</td>
            
            <td class="align-middle table-striped">
              @if($product->img_path === '')
              <p class="mt-5 mb-5">※未登録</p>
              @else
              <img src="{{ asset($product->img_path) }}" alt="" width="100px" height="100px">
              @endif
            </td>
            
            <td class="align-middle table-striped">¥{{ $product->price }}</td>
            <td class="align-middle table-striped">{{ $product->stock }}</td>
            <td class="align-middle table-striped">{{ $product->company->company_name }}</td>
            <td class="align-middle table-striped">
              <a href="{{ route('product.show', $product->id) }}" class="btn btn-warning ">詳細</a>
            </td>
            <td class="align-middle table-striped">
              <form method="POST" action="{{ route('product.destroy', ['id' => $product->id]) }}">
                
                @method('DELETE')
                <button data-id="{{ $product->id }}" type="button" class="btn btn-danger deleteBtn">削除</button>
              </form>
            </td>
          </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>

<script src="{{ ('js/async.js') }}"></script>

@endsection