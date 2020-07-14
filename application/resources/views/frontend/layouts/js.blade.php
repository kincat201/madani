	
	<script src="{{url('frontend/vendor/jquery/jquery-3.2.1.min.js')}}"></script>

	<script src="{{url('frontend/vendor/animsition/js/animsition.min.js')}}"></script>

	<script src="{{url('frontend/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{url('frontend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

	<script src="{{url('frontend/vendor/select2/select2.min.js')}}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>

	<script src="{{url('frontend/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{url('frontend/vendor/daterangepicker/daterangepicker.js')}}"></script>

	<script src="{{url('frontend/vendor/slick/slick.min.js')}}"></script>
	<script src="{{url('frontend/js/slick-custom.js')}}"></script>

	<script src="{{url('frontend/vendor/parallax100/parallax100.js')}}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>

	<script src="{{url('frontend/vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>

	<script src="{{url('frontend/vendor/isotope/isotope.pkgd.min.js')}}"></script>

	<script src="{{url('frontend/vendor/sweetalert/sweetalert.min.js')}}"></script>
	<script>
		/*$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});*/

		/*---------------------------------------------*/

		/*$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});*/
	</script>

	<script src="{{url('frontend/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>

	<script>
        var productUrl = "{{url('product')}}";
        var productPath = "{{url('storage')}}";
        var priceTypes = {!! json_encode(\App\Util\Constant::PRODUCT_TYPE_PRICE_LIST) !!};
        var productList = [];
        var countCart = 0;
        @foreach(Session::get('carts') as $cart)
			productList.push({{$cart['product']}});
			countCart++;
		@endforeach
	</script>

	<script src="{{url('frontend/js/main.js')}}"></script>

	<script type="text/javascript">
		@if(session('error'))
        swal({
            title: 'System Error!',
            text: '{!! session('error') !!}',
            icon: "error",
        });
		@endif

		@if(session('success'))
        swal({
            title: '{!! session('success') !!}',
            text: '{!! session('message') !!}',
            icon: "success",
        });
		@endif

        function checkOut(){
            $('.js-modal3').addClass('show-modal1');
        }

        function setCheckOut() {
            swal({
                title: "Yakin Pesan?",
                text : "Data keranjang belanja akan dihilangkan setelah dipesan",
                icon: "warning",
                buttons: {
                    cancel:true,
                    confirm: {
                        text:'Pesan!',
                        closeModal: false,
                    },
                },
            })
            .then((process) => {
                if(process){
                    var totalCart = '{{ number_format(\Session::get('totalCart')) }}';
                    var carts = [];

                    @foreach(\Session::get('carts') as $cart)
                        carts.push({
                            name:'{{ $cart['name'] }}',
                            price:'{{ number_format($cart['price']) }}',
                            qty:'{{ $cart['qty'] }}',
                        });
                    @endforeach
                    var validateOrder = [];
                    var name = $('.js-modal3 [name=name]').val();
                    var email = $('.js-modal3 [name=email]').val();
                    var phone = $('.js-modal3 [name=phone]').val();
                    var address = $('.js-modal3 [name=address]').val();

                    if( name == ''){
                        validateOrder.push('nama lengkap');
                    }
                    if(email == ''){
                        validateOrder.push('alamat email');
                    }
                    if(phone == ''){
                        validateOrder.push('nomor telepon');
                    }

                    if(validateOrder.length>0){
                        return swal({
                            title: 'Periksa data pemesan',
                            icon: "error",
                            text: validateOrder.join(', ') + ' harus diisi'
                        });
                    }

                    var textOrder = '';
                    textOrder += 'Assalamualaikum%2C%20saya%20ingin%20melakukan%20pemesanan%3A%0A%0A';
                    textOrder += 'Nama%20%3A%20'+name+'%0A';
                    textOrder += 'Email%20%3A%20'+email+'%0A';
                    textOrder += 'Telepon%20%3A%20'+phone+'%0A';
                    textOrder += address ? 'Alamat%20%3A%20'+address+'%0A%0A' : '';
                    textOrder += '%0AItem%20sebagai%20berikut%20%3A%0A';
                    carts.map(cart=>{
                        textOrder += cart.name.replace(' ','%20') + '%20%28'+cart.qty+'%20x%20'+cart.price+'%29%0A';
                    });
                    textOrder += '%0ATotal%20%3A%20'+totalCart;

                    swal({
                        title:'Berhasil Melakukan Pemesanan',
                        text: 'Silahkan lanjutkan pemesanan via Whatsapp, terima kasih!',
                        icon: "success",
                    }).then((next)=>{
                        window.open('https://api.whatsapp.com/send?phone={{ $CONF->whatsapp }}&text='+textOrder, '_blank');
                        window.location = '{{ route('emptyCart') }}';
                    })
                }else{
                    swal('Tidak jadi dipesan!');
                }
            });
        }

		function addCart(type){
	        $('.modal-loading').addClass('modal-loading-show');
	        var product='';var qty='';var size='';var color = '';
	        if(type == 1){
	            $('.js-modal1').removeClass('show-modal1');
	            product = $('[name=previewId]').val();
	            qty = $('[name=previewQty]').val();
	            size = $('[name=previewSize]').val();
	        }else if(type == 2){
	            product = $('[name=productId]').val();
	            qty = $('[name=productQty]').val();
	            size = $('[name=productSize]').val();
	        }
	        $.ajax({
	            url : '{{route("addCart")}}',
	            type: "POST",
	            dataType: "JSON",
	            data: {
	                    product:product,
	                    qty:qty,
	                    size:size,
	                    _token: '{{ csrf_token() }}'
	                },
	            success: function(response)
	            {
	                if(response.status)
	                {
	                    swal({
	                        title:'Berhasil Tambah Produk',
	                        text: response.message,
	                        icon: "success",
	                    })
                    	updateCart(response.data);
	        			$('.modal-loading').removeClass('modal-loading-show');
                    }else{ 
	                    swal({
	                        title: 'Gagal Tambah Produk',
	                        icon: "error",
	                        text: response.message
	                    });
	        			$('.modal-loading').removeClass('modal-loading-show');
	                }
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                swal({
	                    title: 'system error!',
	                    text: errorThrown,
	                    icon: "error",
	                });
	        		$('.modal-loading').removeClass('modal-loading-show');
	            }
	        });
	    }

	    function setPrice(type){
            if(type == 1){
                var price = JSON.parse($('[name=previewSize]').val()).price;
                $('#previewPrice').html('Rp. ' + parseInt(price,0).toLocaleString('us-US'));
            }
        }

	    function updateCart(data){

		    if(data.totalCount == 1)$('#cartItems').html('');

	    	var item = '<li class="header-cart-item flex-w flex-t m-b-12 cartItem'+data.product+'" id="cartItem'+data.product+'">\
    			<a href="javascript:;" onclick="removeCart('+data.product+')" title="Hapus Item" alt="Hapus Item">\
					<div class="header-cart-item-img">\
						<img src="'+data.image+'" alt="'+data.name+'">\
					</div>\
				</a>\
				<div class="header-cart-item-txt p-t-8">\
					<a href="'+data.detail+'" class="header-cart-item-name m-b-18 hov-cl1 trans-04">\
						'+data.name+'\
					</a>\
					<span class="header-cart-item-info">\
						'+data.qty+' x Rp. '+data.price+'\
					</span>\
				</div>\
			</li>';
			$('#cartItems').append(item);

	    	$('#cartCount').attr('data-notify',data.totalCount);
	    	$('.cartTotal').html('Total: Rp. '+data.totalNow);
	    }

	    function removeCart(product){
	    	swal({
                title: "Yakin Hapus Item Ini?",
                text : "Data item cart ini akan dihilangkan",
                icon: "warning",
                buttons: {
                    cancel:true,
                    confirm: {
                        text:'Hapus!',
                        closeModal: false,
                    },
                  },
                })
            .then((process) => {
                if(process){
                	$('.modal-loading').addClass('modal-loading-show');
                	$.ajax({
                        url : '{{ route("removeCart") }}',
                        type: "POST",
                        dataType: "JSON",
                        data: {
                                product:product,
                                _token: '{{ csrf_token() }}',
                            },
                        success: function(response)
                        {
                            if(response.status) 
                            {
                            	swal({
                                    title:'Berhasil Hapus Produk',
                                    text: response.message,
                                    icon: "success",
                                });

                                $('.cartItem'+response.product).remove();
                                $('#cartCount').attr('data-notify',response.totalCount);
	    						$('.cartTotal').html('Total: Rp. '+response.totalNow);
	    						$('.modal-loading').removeClass('modal-loading-show');
	    						countCart = response.totalCount;
	    						var index = productList.indexOf(product);
	    						if(index !== -1) productList.splice(index,1);
                            }else{ 
                                swal({
                                    title: 'Gagal Hapus Produk',
                                    icon: "error",
                                    text: response.message
                                });
                                $('.modal-loading').removeClass('modal-loading-show');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal({
                                title: 'system error!',
                                text: errorThrown,
                                icon: "error",
                            });
                            $('.modal-loading').removeClass('modal-loading-show');
                        }
                    });
                }else{
                    swal('Data produk tidak jadi dihapus');
                }
            });
	    }

        function WayBill(){
	        if($('[name=waybill]').val() == ''){
                swal({
                    title: 'Periksa Nomor Resi',
                    icon: "error",
                    text: 'Nomor resi tidak boleh kosong!',
                });
			}
            swal({
                title: "Yakin Lacak Pengiriman?",
                text : "Pastikan memasukan nomor resi yang benar!",
                icon: "warning",
                buttons: {
                    cancel:true,
                    confirm: {
                        text:'Lacak!',
                        closeModal: false,
                    },
                },
            })
			.then((process) => {
                if(process){
                    $('.modal-loading').addClass('modal-loading-show');
                    $.ajax({
                        url : '{{ url("getWaybill") }}',
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            waybill:$('[name=waybill]').val(),
                            courier:'jne',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response)
                        {
                            if(response.status)
                            {
                                $('.modal-loading').removeClass('modal-loading-show');
                                swal({
                                    title: 'Berhasil Lacak Pengiriman',
                                    icon: "success",
                                    text: 'Data pengiriman ditemukan',
									timer: '2000',
                                }).then((done) => {
                                	$('.js-modal2').addClass('show-modal1');
									$('#waybillId').html('Nomor Resi : '+response.data.summary.waybill_number);
									$('#waybillStatus').html(response.data.summary.status);
                                	$('#waybillCourier').html(response.data.summary.courier_name);
									$('#waybillService').html(response.data.summary.service_code);
									$('#waybillDate').html(response.data.summary.waybill_date);
									$('#waybillShipper').html(response.data.summary.shipper_name);
									$('#waybillReceiver').html(response.data.summary.receiver_name);
									$('#waybillOrigin').html(response.data.summary.origin);
									$('#waybillDestination').html(response.data.summary.destination);
								});
                            }else{
                                swal({
                                    title: 'Gagal Lacak Pengiriman',
                                    icon: "error",
                                    text: response.message
                                });
                                $('.modal-loading').removeClass('modal-loading-show');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal({
                                title: 'Gagal Lacak Pengiriman',
                                icon: "error",
                                text: 'Resi yang Anda masukkan salah atau belum terdaftar.',
                            });
                            $('.modal-loading').removeClass('modal-loading-show');
                        }
                    });
                }else{
                    swal('Tidak jadi lacak pengiriman');
        		}
        	});
        }
	</script>
