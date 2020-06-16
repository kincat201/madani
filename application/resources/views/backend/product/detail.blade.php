@extends('backend.layouts.template')

@section('pageTitle','Detail Product')

@push('customCss')
    <style>
        .required-form:after { content:" *"; color:#ff3358 }
    </style>
@endpush

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a> <i class="fa fa-circle"></i></li>
                    <li><a href="{{route('admin.products')}}">Produk</a> <i class="fa fa-circle"></i></li>
                    <li><span>Detail Produk</span></li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <div class="row">
                <form href="#" id="formData" method="POST">

                    {{ csrf_field() }}

                    <input name="id" type="hidden" value="{{ @$model->id }}">

                    <div class="col-md-12">
                        <div class="portlet blue box margin-top-20">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-share "></i>
                                    <span class="caption-subject bold uppercase">Data Product</span>
                                </div>
                                <div class="actions">
                                    <button type="button" class="btn btn-primary" onclick="save()">Simpan</button>
                                    <a href="{{route('admin.products')}}" class="btn default" >Kembali</a>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @include('backend.product.detail-part.general')
                                    </div>
                                    <div class="col-md-6">
                                        @include('backend.product.detail-part.price')
                                    </div>
                                </div>
                                <div class="row">
                                    {{--<div class="col-md-6">
                                        @include('backend.pic.detail-part.member')
                                    </div>
                                    <div class="col-md-6">
                                        @include('backend.pic.detail-part.relation')
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!-- page content -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

@endsection

@push('customJs')
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>

    <script>

        function save(){
            $('.form-group').removeClass('has-error');
            $('.help-block-error').html('');

            swal({
                title: "Yakin Simpan Data?",
                text : "Data akan disimpan",
                icon: "warning",
                buttons: {
                    cancel:true,
                    confirm: {
                        text:'Simpan!',
                        closeModal: false,
                    },
                },
            })
                .then((process) => {
                    if(process){
                        $('.form-group').removeClass('has-error');
                        $('.help-block-error').html('');

                        $.ajax({
                            url: "{{ route('admin.product.save') }}",
                            type: "POST",
                            data: new FormData($("#formData")[0]),
                            processData: false,
                            contentType: false,
                            async:false,
                            success: function(response) {
                                if(response.status){
                                    swal({
                                        title: 'Berhasil Simpan Data',
                                        text: response.message,
                                        icon: 'success',
                                        timer: '3000'
                                    }).then((done)=>{
                                        location.href = '{{route("admin.products")}}';
                                    });
                                }else{
                                    swal({
                                        title: 'Gagal Simpan Data',
                                        text: response.message,
                                        icon: 'error',
                                        timer: '3000'
                                    });
                                    var error_arr = [];

                                    @foreach($model::FORM_VALIDATION as $validationKey => $validationVal)
                                    error_arr.push('{{ $validationKey }}');
                                    @endforeach

                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in response.error){
                                            $('#'+error_arr[i]).addClass('has-error');
                                            $('#'+error_arr[i]+'_error').html(response.error[error_arr[i]]);
                                        }
                                    }
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                swal({
                                    title: 'System Error',
                                    text: errorThrown,
                                    icon: 'error',
                                    timer: '3000'
                                });
                            }
                        });
                    }else{
                        swal('Data tidak jadi disimpan');
                    }
                });
        }
    </script>
@endpush
