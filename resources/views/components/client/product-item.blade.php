<!-- resources/views/components/product-item.blade.php -->

<div class="col-md-6 col-lg-4 col-xl-3">
    <div class="card product-item" style="width: 17rem;">
<a class="product-item-image">
    <img src="{{config('cloudinary.base_url').$product->anh_sp ?? config('cloudinary.default_image')}}" class="card-img-top img-fluid" alt="{{$product->slug}}">
</a>
        <div class="card-body product-item-title">
          <h5 class="card-title">{{$product->ten_sp}}</h5>
        </div>
        <div class="text-center">
            @if ($product->giakm_sp)
                <div>
                    <span><del>{{ \App\Helpers\ParseVND::formatCurrency($product->gia_sp) }}</del></span>
                    <span><strong class="text-danger text-xl fw-bold fs-5">{{ \App\Helpers\ParseVND::formatCurrency($product->giakm_sp) }}</strong></span>
                </div>
        @else
            <div><strong>{{ \App\Helpers\ParseVND::formatCurrency($product->gia_sp) }}</strong></div>
        @endif   
        </div>
        <div class="card-body d-flex gap-2 justify-content-evenly">
          <a href="#" class="product-item-add">
            Thêm giỏ hàng
          </a>
          <a href="#" class="card-link product-item-detail">Chi tiết</a>
        </div>
        @if ($product->giakm_sp)
            <div class="product-item-sale">
                <img class="img-fluid" src="{{asset('client/img/sale.png')}}" alt="">
            </div>
        @endif
        @if ($product->noibat_sp)
            <div class="product-item-hot">
                <img class="img-fluid" src="{{asset('client/img/hot.png')}}" alt="">
            </div>
        @endif
      </div>
</div>
