@extends('frontend.layouts.template')

@section('pageTitle','Product')

@push('customCss')

@endpush

@section('content')

    <!-- Product -->
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        Semua
                    </button>

                    @foreach($categories as $category)

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{strtolower(trim($category->name)).'-'.$category->id}}">
                        {{ucwords($category->name)}}
                    </button>

                    @endforeach
                </div>

                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Filter
                    </div>

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>

                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="keyword" value="{{@$filter->keyword}}" placeholder="Cari Produk">
                    </div>
                </div>

                <!-- Filter -->
                <div class="dis-none panel-filter w-full p-t-10">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Urutkan
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>'','price'=>@$filter->price,'label'=>@$filter->label,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->sort==''?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        Semua
                                    </a>
                                </li>


                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>'price-asc','price'=>@$filter->price,'label'=>@$filter->label,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->sort=='price-asc'?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        Harga: Rendah - Tinggi
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>'price-desc','price'=>@$filter->price,'label'=>@$filter->label,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->sort=='price-desc'?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        Harga: Tinggi - Rendah
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>'created_at-desc','price'=>@$filter->price,'label'=>@$filter->label,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->sort=='created_at-desc'?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        Waktu: Baru - Lama
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>'created_at-asc','price'=>@$filter->price,'label'=>@$filter->label,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->sort=='created_at-asc'?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        Waktu: Lama - Baru
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Harga
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>@$filter->sort,'price'=>'','label'=>@$filter->label,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->price==''?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        Semua
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>@$filter->sort,'price'=>'0-50000','label'=>@$filter->label,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->price=='0-50000'?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        < Rp. 50.000
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>@$filter->sort,'price'=>'50000-100000','label'=>@$filter->label,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->price=='50000-100000'?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        Rp. 50.000 - Rp. 100.000
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>@$filter->sort,'price'=>'100000-250000','label'=>@$filter->label,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->price=='100000-250000'?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        Rp. 100.000 - Rp. 250.000
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>@$filter->sort,'price'=>'250000-10000000','label'=>@$filter->label,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->price=='250000-10000000'?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        > Rp. 250.000
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col3 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Label
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>@$filter->sort,'price'=>@$filter->price,'label'=>'','category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->label==''?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        Semua
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>@$filter->sort,'price'=>@$filter->price,'label'=>1,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->label==1?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        Unggulan
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>@$filter->sort,'price'=>@$filter->price,'label'=>2,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->label==2?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        Terbaru
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>@$filter->sort,'price'=>@$filter->price,'label'=>3,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->label==3?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        Promo
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('product',['sort'=>@$filter->sort,'price'=>@$filter->price,'label'=>4,'category'=>@$filter->category,'subCategory'=>@$filter->subCategory,'keyword'=>@$filter->keyword])}}" class="{{@$filter->label==4?'filter-link-active':''}} filter-link stext-106 trans-04">
                                        Diskon
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col4 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Kategori
                            </div>

                            <div class="flex-w p-t-4 m-r--5">
                                <div class="rs1-select2 bor8 bg0" style="width: 200px">
                                    <select class="js-select2" name="category" onchange="getSubCat()">
                                        <option value="">Semua</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$category->id==@$filter->category?'selected':''}}>{{ucwords($category->name)}}</option>
                                        @endforeach
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                            <div class="flex-w p-t-4 m-r--5">
                                <div class="rs1-select2 bor8 bg0" style="width: 200px">
                                    <select class="js-select2" name="subCategory">
                                        <option value="">Semua</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row isotope-grid isotope">
                @foreach($products as $product)
                @php
                    $productCat = [];
                    foreach($product->subCategory as $subCategory){
                        array_push($productCat,strtolower(trim($subCategory->category->name)).'-'.$subCategory->category->id);
                    }
                @endphp
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{implode(' ',$productCat)}}">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0 label-new label-{{$product->label}}" data-label="{{\App\Util\Constant::PRODUCT_LABELS[$product->label]}}">
                            <img src="{{url('storage/'.json_decode($product->images)[0])}}" alt="{{ucwords($product->name)}}">

                            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" product-id="{{$product->id}}">
                                Lihat
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="{{route('productDetail',['id'=>$product->id])}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{ucwords($product->name)}}
                                </a>

                                <span class="stext-105 cl3">
									Rp. {{number_format($product->price)}}
								</span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="{{route('productDetail',['id'=> $product->id])}}" class="btn-addwish-b2 dis-block pos-relative" style="color:#999">
                                    <i class="fa fa-archive" style="margin-left: 2px"></i>{{number_format($product->stock)}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Load more -->
            <div class="flex-c-m flex-w w-full p-t-45">
                <a href="javascript:;" id="loadMore" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                    Load More
                </a>
            </div>
        </div>
    </div>

    @include('frontend.layouts.preview')

@endsection

@push('customJs')
    <script>
        var page = 1;
        var sort = '{{empty($filter->sort)?'':$filter->sort}}';
        var price = '{{empty($filter->price)?'':$filter->price}}';
        var label = '{{empty($filter->label)?'':$filter->label}}';
        var category = '{{empty($filter->category)?'':$filter->category}}';
        var subCategory = '{{empty($filter->subCategory)?'':$filter->subCategory}}';
        var keyword = '{{empty($filter->keyword)?'':$filter->keyword}}';

        @if(!empty($filter->category))
            $('[name=category]').change();
        @endif

        function preview(id) {
            $('.modal-loading').addClass('modal-loading-show');
            $('[name=previewColor]').empty();
            $('[name=previewSize]').empty();

            $.ajax({
                url: productUrl + '/preview/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function (product) {
                    $('[name=previewId]').val(product.id);
                    $('[name=previewMember]').val(product.member);
                    $('#previewName').html(product.name);
                    $('#previewPrice').html('Rp. ' + product.price);
                    $('#previewDescription').html(product.description);
                    $('[name=num-product]').attr('max',product.stock);
                    $('[name=privewSize]').empty();
                    $('[name=privewSize]').empty();

                    $('[name=previewSize]').append(
                        $("<option></option>")
                            .attr("value","")
                            .text('Pilih Ukuran')
                    );

                    $.each(product.size, function(productKeySize,productSize) {
                        var currentSize = $("<option></option>")
                            .attr("value",productSize)
                            .text(productSize);

                        $('[name=previewSize]').append(currentSize);
                    });

                    $('[name=previewColor]').append(
                        $("<option></option>")
                            .attr("value","")
                            .text('Pilih Warna')
                    );

                    $.each(product.color, function(productKeyColor,productColor) {
                        var currentColor = $("<option></option>")
                            .attr("value",productColor)
                            .text(productColor);

                        $('[name=previewColor]').append(currentColor);
                    });

                    $('.wrap-slick3').html('<div class="wrap-slick3-dots"></div><div class="wrap-slick3-arrows flex-sb-m flex-w"></div><div class="slick3 gallery-lb" id="previewImages"></div>');

                    $.each(product.images, function(productKeyImage,productImage) {
                        var currentImage= '<div class="item-slick3" data-thumb="'+productPath+'/'+productImage+'">\
                        <div class="wrap-pic-w pos-relative">\
                            <img src="'+productPath+'/'+productImage+'" alt="'+product.name+'">\
                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'+productPath+'/'+productImage+'">\
                                <i class="fa fa-expand"></i>\
                            </a>\
                        </div>\
                        </div>';

                        $('#previewImages').append(currentImage);
                    });

                    $('.wrap-slick3').each(function(){
                        $(this).find('.slick3').slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            fade: true,
                            infinite: true,
                            autoplay: false,
                            autoplaySpeed: 6000,

                            arrows: true,
                            appendArrows: $(this).find('.wrap-slick3-arrows'),
                            prevArrow:'<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                            nextArrow:'<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',

                            dots: true,
                            appendDots: $(this).find('.wrap-slick3-dots'),
                            dotsClass:'slick3-dots',
                            customPaging: function(slick, index) {
                                var portrait = $(slick.$slides[index]).data('thumb');
                                return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
                            },
                        });
                    });

                    $('#previewDetailId').attr('href',productUrl+'/'+product.id);

                    $('.modal-loading').removeClass('modal-loading-show');
                    $('.js-modal1').addClass('show-modal1');
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        
        function getSubCat() {
            if($('[name=category]').val() == '')return false;
            $('[name=subCategory]').empty();
            $.ajax({
                url: productUrl + '/category/' + $('[name=category]').val(),
                type: 'GET',
                dataType: 'JSON',
                success: function (subCat) {

                    $('[name=subCategory]').append(
                        $("<option></option>")
                            .attr("value","")
                            .text('Semua')
                    );

                    $.each(subCat, function(subCategoryKey,subCategoryItem) {
                        var currentSub = $("<option></option>")
                            .attr("value",subCategoryItem.id)
                            .text(subCategoryItem.name);

                        if(subCategory == subCategoryItem.id){
                            currentSub.attr('selected',true);
                        }

                        $('[name=subCategory]').append(currentSub);
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        $('[name=subCategory]').on('change',function () {
            category = $('[name=category]').val();
            subCategory = $('[name=subCategory]').val();
            location.href = productUrl+'?sort='+sort+'&price='+price+'&label='+label+'&category='+category+'&subCategory='+subCategory+'&keyword='+keyword;
        });

        $('[name=keyword]').on('keypress', function () {
            var keyword = $('[name=keyword]').val();
            location.href = productUrl+'?keyword='+keyword+'&sort='+sort+'&price='+price+'&label='+label+'&category='+category+'&subCategory='+subCategory;
        });
    </script>
@endpush