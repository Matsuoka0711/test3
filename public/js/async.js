$(document).ready(function () {

  function search() {
    var dataVal = {
      'name_search': $('#name_search').val(),
      'company_name_search': $('#company_name_search').val(),
      'max_price_search': $('#max_price_search').val(),
      'min_price_search': $('#min_price_search').val(),
      'max_stock_search': $('#max_stock_search').val(),
      'min_stock_search': $('#min_stock_search').val(),
    };

    $.ajax({
      type: 'get',
      url: '/test3/public/search',
      data: dataVal,
      dataType: 'json',

      success: function (data) {
        console.log('通信成功');
        console.log(data);
        $('#Content tr').hide();

        for (let i = 0; i < data.length; i++) {
          let product = data[i];
          let row = $('#Content tr:contains("' + product.price + '")');
          
          // 該当する行が存在する場合は表示にする
          if (row.length > 0) {
            row.show();
          }
        }
      },
      error: function () {
        alert('エラー');
      }
    });
  }
  // 各検索条件が変更された時のイベントリスナー
  $('#name_search, #company_name_search, #max_price_search, #min_price_search, #max_stock_search, #min_stock_search').on('input', search);
  $('#sort a').click(function() {
    search();
  });


  // 削除機能（非同期処理）
  $('.deleteBtn').click(function() {
    let result =  window.confirm('削除しますか？');
    if(result){
      let dataId = $(this).data('id'); // 押したボタンの data-id を取得
      let row = $(this).closest('tr'); // 削除する行を取得

      $.ajax({
        method: 'DELETE',
        type: 'DELETE',
        url: '/test3/public/delete/'+dataId+'',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){
          row.remove();
          alert('削除しました。');
        },
        error: function() {
          alert('エラー');
        }
      });
    }
    else{
      alert('キャンセルしました。');
      return false;
    }
  })
});