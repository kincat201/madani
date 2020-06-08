@extends('frontend.layouts.template')

@section('pageTitle','Profil')

@push('customCss')

@endpush

@section('breadcrumb')
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            Tambah Reservasi </h3>
        <span class="kt-subheader__separator kt-hidden"></span>
        <div class="kt-subheader__breadcrumbs">
            <a href="{{ route('home') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
            <span class="kt-subheader__breadcrumbs-separator"></span>
                Reservasi  </a>
        </div>
    </div>
@endsection

@section('content')

    <!-- begin:: Content -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">

        <!--Begin::Dashboard 5-->

        <!--Begin::Section-->
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title kt-font-primary">
                                Reservasi
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-actions">
                                <button type="button" class="btn btn-outline-brand btn-bold btn-sm" onclick="save()">Simpan</button>
                                <a href="{{ route('home') }}" class="btn btn-outline-warning btn-bold btn-sm" >Batal</a>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <form href="#" id="formData" method="POST">

                            {{ csrf_field() }}

                            <div class="portlet light bordered margin-top-20">
                                <div class="portlet-body form">
                                    <input type="hidden" name="id" value="{{ @$model->id }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="title">
                                                <label class="label-control">Kegiatan</label>
                                                <input type="text" name="title" class="form-control" value="{{ @$model->title }}">
                                                <div id="title_error" class="help-block help-block-error"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="room">
                                                <label class="label-control">Ruangan</label>
                                                <select class="form-control" name="room">
                                                    <option value="">Pilih Ruangan</option>
                                                    @foreach(\App\Util\Constant::ROOM_LIST as $value => $label)
                                                        @if($value != \App\Util\Constant::ROOM_SMALL)
                                                        <option value="{{$value}}" {{ $value == @$model->room ? 'selected' : '' }}>{{$label}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <div id="room_error" class="help-block help-block-error"> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="amount">
                                                <label class="label-control">Jumlah Peserta</label>
                                                <input type="number" name="amount" class="form-control" value="{{ @$model->amount }}">
                                                <div id="amount_error" class="help-block help-block-error"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="food">
                                                <label class="label-control">Konsumsi</label>
                                                <select class="form-control" name="food">
                                                    @foreach(\App\Util\Constant::FOOD_LIST as $value => $label)
                                                        <option value="{{$value}}" {{ $value == @$model->food ? 'selected' : '' }}>{{$label}}</option>
                                                    @endforeach
                                                </select>
                                                <div id="food_error" class="help-block help-block-error"> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="pic">
                                                <label class="label-control">PIC</label>
                                                <input type="text" name="pic" class="form-control" value="{{ empty(@$model->pic) ? \Auth::user()->name : @$model->pic }}">
                                                <div id="pic_error" class="help-block help-block-error"> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="reservationDate">
                                                <label class="label-control">Tanggal</label>
                                                <input type="text" name="reservationDate" class="form-control datepickerinput" value="{{ @$model->reservationDate }}">
                                                <div id="reservationDate_error" class="help-block help-block-error"> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="reservationTimeFrom">
                                                <label class="label-control">Waktu Mulai</label>
                                                <input type="text" name="reservationTimeFrom" class="form-control timepicker" value="{{ @$model->reservationTimeFrom }}">
                                                <div id="reservationTimeFrom_error" class="help-block help-block-error"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="reservationTimeTo">
                                                <label class="label-control">Waktu Akhir</label>
                                                <input type="text" name="reservationTimeTo" class="form-control timepicker" value="{{ @$model->reservationTimeTo }}">
                                                <div id="reservationTimeTo_error" class="help-block help-block-error"> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--End::Section-->

        <!--End::Dashboard 5-->
    </div>

    <!-- end:: Content -->

@endsection

@push('customJs')
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
                        url: "{{ route('reservation.save') }}",
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
                                    location.href = '{{route("home")}}';
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
