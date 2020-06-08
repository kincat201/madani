@extends('backend.layouts.template')

@section('pageTitle','Pengaturan Tentang')

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
                    <li><a href="{{route('admin.dashboard')}}">Beranda</a> <i class="fa fa-circle"></i></li>
                    <li><span>Pengaturan Tentang</span></li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="portlet light bordered margin-top-20">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-share font-dark"></i>
                                <span
                                        class="caption-subject font-dark bold uppercase">Pengaturan Tentang
                                    </span>
                            </div>
                            <div class="actions">

                            </div>

                        </div>

                        <div class="portlet-body form">
                            <form action="javascript:;" id="formSetting" enctype="multipart/form-data">
                                <input type="hidden" name="idSetting" value="1">
                                {{csrf_field()}}
                                @php
                                    $i = 0;
                                    @$about = json_decode($model->aboutDetail);
                                @endphp
                                @foreach($model::ABOUT_FIELD as $keyField => $field)
                                    @if($i%2==0)
                                        <div class="row">
                                            @endif
                                            <div class="col-md-{{ $field=='texteditor'?'12':'6' }}">
                                                <div class="form-group" id="{{$keyField}}">
                                                    <label class="control-label">{{$model::ABOUT_LABEL[$keyField]}}</label>
                                                    @if($field == 'text')
                                                        <input type="{{$field}}" name="{{$keyField}}" class="form-control" value="{{@$about->$keyField}}" placeholder="{{$model::ABOUT_LABEL[$keyField]}}">
                                                    @elseif($field=='date')
                                                        <input type="text" name="{{$keyField}}" class="form-control datepickerinput" maxlength="" value="{{@$about->$keyField}}" placeholder="{{$model::ABOUT_LABEL[$keyField]}}">
                                                    @elseif($field == 'image')
                                                        <input type="file" name="{{$keyField}}" class="form-control" value="{{@$about->$keyField}}" {{!empty($model->id)?(in_array($keyField,$model::FORM_DISABLED)?'disabled':''):''}} placeholder="{{$model::ABOUT_LABEL[$keyField]}}">
                                                        <br>
                                                        <a href="{{url('storage/'.@$model->$keyField)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$model->$keyField)}}" width="100" height="100"></a>

                                                    @elseif($field == 'file')
                                                        <input type="{{$field}}" name="{{$keyField}}" class="form-control" value="{{@$about->$keyField}}" placeholder="{{$model::ABOUT_LABEL[$keyField]}}">
                                                        <br>
                                                        @if(!empty(@$model->id))
                                                            <a href="{{url('storage/'.@$model->$keyField)}}" target="_blank" title="preview">Lihat File</a>
                                                        @endif
                                                    @elseif($field == 'select')

                                                        <select class="form-control" name="{{$keyField}}">
                                                            @foreach(\App\Helpers\SelectHelper::getSelectList($model::ABOUT_SELECT_LIST[$keyField]) as $key => $val)
                                                                <option value="{{ $key }}">{{ $val }}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif($field == 'texteditor')
                                                        <textarea class="form-control summernote" id="{{$keyField}}" name="{{$keyField}}">{{@$about->$keyField}}</textarea>
                                                    @else
                                                        <textarea class="form-control" name="{{$keyField}}">{{@$about->$keyField}}</textarea>
                                                    @endif
                                                    <div class="help-block">{{ in_array($keyField,$model::ABOUT_HELP_LIST)? $model::ABOUT_LABEL_LIST[$keyField]:''}}</div>
                                                    <div id="{{$keyField}}_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                            @if(($i+1)%2==0)
                                        </div>
                                    @endif
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                                <hr>
                            </form>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9 text-right">
                                    <button type="button" class="btn btn-primary" onclick="save()">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page content -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

@endsection

@push('customJs')
    <script type="text/javascript">
        function save(){
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
                        url: "{{ route('about.save') }}",
                        type: "POST",
                        data: new FormData($("#formSetting")[0]),
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
                                    if(done){
                                        location.reload();
                                    }

                                    setTimeout(function(){ location.reload() }, 3000);
                                });
                            }else{
                                swal({
                                    title: 'Gagal Simpan Data',
                                    text: response.message,
                                    icon: 'error',
                                    timer: '3000'
                                });
                                var error_arr = [];

                                @foreach($model::FORM_VALIDATION_ABOUT as $key => $val)
                                error_arr.push('{{$key}}');
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
