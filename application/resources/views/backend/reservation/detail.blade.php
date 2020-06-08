@extends('backend.layouts.template')

@section('pageTitle','Detail PIC')

@push('customCss')

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
                    <li><a href="{{route('admin.reservations')}}">Reservation</a> <i class="fa fa-circle"></i></li>
                    <li><span>Detail Reservasi</span></li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <div class="row">
                <form href="#" id="formData" method="POST">

                {{ csrf_field() }}

                <div class="portlet light bordered margin-top-20">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-dark"></i>
                            <span class="caption-subject font-dark bold uppercase">Data Reservasi</span>
                        </div>
                        <div class="actions">
                            <button type="button" class="btn btn-primary" onclick="save()">Simpan</button>
                            <a href="{{route('admin.reservations')}}" class="btn default" >Kembali</a>
                        </div>

                    </div>

                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Kode Reservasi</label>
                                    <input type="text" class="form-control" readonly name="id" value="{{ @$model->id }}">
                                    <div id="id_error" class="help-block help-block-error">Terisi Otomatis</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="userId">
                                    <label class="label-control">Pembuat</label>
                                    <input type="text" id="search_userId" autocomplete="off" name="search_userId" placeholder="Ketik nama/username user" value="{{ @$model->user->name }}" class="form-control" />
                                    <input type="hidden" name="userId" value="{{ @$model->userId }}" class="form-control" />
                                    <div id="userId_error" class="help-block help-block-error">Ketik nama atau username</div>
                                </div>
                            </div>
                        </div>
                        @if(!empty(@$model->id))
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label class="label-control">Email</label>
                                    <input type="text" readonly name="email" class="form-control" value="{{ @$model->user->email }}">
                                    <div id="phone_error" class="help-block help-block-error">Terisi Otomatis</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label class="label-control">Phone</label>
                                    <input type="text" readonly name="phone" class="form-control" value="{{ @$model->user->phone }}">
                                    <div id="phone_error" class="help-block help-block-error">Terisi Otomatis</div>
                                </div>
                            </div>
                        </div>
                        @endif
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
                                    <select class="form-control" name="room" onchange="filter()">
                                        <option value="">Pilih Ruangan</option>
                                        @foreach(\App\Util\Constant::ROOM_LIST as $value => $label)
                                            <option value="{{$value}}" {{ $value == @$model->room ? 'selected' : '' }}>{{$label}}</option>
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
                                    <input type="text" name="pic" class="form-control" value="{{ @$model->pic }}">
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" id="status">
                                    <label class="label-control">Status</label>
                                    <select class="form-control" name="status" onchange="filter()">
                                        <option value="">Pilih Status</option>
                                        @foreach(\App\Util\Constant::RESERVATION_STATUS_LIST as $value => $label)
                                            <option value="{{$value}}" {{ $value == @$model->status ? 'selected' : '' }}>{{$label}}</option>
                                        @endforeach
                                    </select>
                                    <div id="status_error" class="help-block help-block-error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="remark">
                                    <label class="label-control">Keterangan</label>
                                    <textarea name="remark" class="form-control"></textarea>
                                    <div id="remark_error" class="help-block help-block-error"> </div>
                                </div>
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
                        url: "{{ route('admin.reservation.save') }}",
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
                                    location.href = '{{route("admin.reservations")}}';
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

        $("[name=search_userId]").autocomplete({
            source: function(request, response) {

                // Suggest URL
                var suggestURL = " {{url('admin/userSearch/%QUERY')}}";
                suggestURL = suggestURL.replace('%QUERY', request.term);

                // JSONP Request
                $.ajax({
                    method: 'GET',
                    dataType: 'JSON',
                    // jsonpCallback: 'jsonCallback',
                    url: suggestURL,
                    success:function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.name,
                                value: item.id,
                                uid: item.id
                            }
                        }));
                    },
                });
            }
        });

        $( "[name=search_userId]").on( "autocompleteselect", function( event, ui ) {
            $("[name=userId]").val(ui.item.uid);
            $("[name=search_userId]").val(ui.item.label);
            event.preventDefault();
        } );
    </script>
@endpush
