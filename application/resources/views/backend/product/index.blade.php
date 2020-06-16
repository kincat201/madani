@extends('backend.layouts.template')

@section('pageTitle','Product')

@push('customCss')
    <link href="{{url('backend/assets/global/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a> <i class="fa fa-circle"></i></li>
                <li><span>Produk</span></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered margin-top-20">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-dark"></i> <span
                                class="caption-subject font-dark bold uppercase">Daftar Produk</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-12 col-lg-12" style="text-align: right;">
                                <a href="{{route('admin.product.export')}}" target="_blank" class="btn btn-success">Export</a>
                                <a href="{{ route('admin.product.get',['id'=>0]) }}" class="btn btn-primary">Tambah</a>
                            </div>
                        </div>
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td class="all">
                                        <input placeholder="Find Name" type="text" class="form-control" name="s_name" onchange="filter()">
                                    </td>
                                    <td class="all" >
                                        <input placeholder="Find Description" type="text" class="form-control" name="s_description" onchange="filter()">
                                    </td>
                                    <td>
                                        <select class="form-control" name="s_category" onchange="filter()">
                                            <option value="">Pilih Kategori</option>
                                            @foreach(\App\Helpers\SelectHelper::getCategoryList() as $value => $label)
                                                <option value="{{$value}}">{{$label}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="s_unit" onchange="filter()">
                                            <option value="">Pilih Unit</option>
                                            @foreach(\App\Helpers\SelectHelper::getUnitList() as $value => $label)
                                                <option value="{{$value}}">{{$label}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td></td>
                                    <td>
                                        <select class="form-control" name="s_status" onchange="filter()">
                                            <option value="">Pilih Status</option>
                                            @foreach(\App\Helpers\SelectHelper::getCommonStatus() as $value => $label)
                                                <option value="{{$value}}">{{$label}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="min-width: 100px;">Nama</th>
                                    <th style="min-width: 100px;">Deskripsi</th>
                                    <th style="min-width: 100px;">Kategori</th>
                                    <th style="min-width: 100px;">Unit</th>
                                    <th style="min-width: 100px;">Jumlah</th>
                                    <th style="min-width: 100px;">Status</th>
                                    <th style="min-width: 150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.part.modal')
@endsection 

@push('customJs')

<script src="{{url('backend/assets/global/datatable.js')}}"
    type="text/javascript"></script>
<script
    src="{{url('backend/assets/global/datatables/datatables.min.js')}}"
    type="text/javascript"></script>
<script
    src="{{url('backend/assets/global/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
    type="text/javascript"></script>
<script
    src="{{url('backend/assets/global/table-datatables-responsive.min.js')}}"
    type="text/javascript"></script>

<script type="text/javascript">
    var table = $('#myTable').DataTable({
        'processing'  : true,
        'serverSide'  : true,
        'ajax'        : {
            url: "{{ route('admin.product.data') }}",
            data: function (d) {
                d.name = $('[name=s_name]').val();
                d.description = $('[name=s_description]').val();
                d.category_id = $('[name=s_category]').val();
                d.unit_id = $('[name=s_unit]').val();
                d.status = $('[name=s_status]').val();
            }
        },
        'dataType'    : 'json',
        'searching'   : false,
        'paging'      : true,
        'lengthChange': true,
        'columns'     : [
            {data:'name', name: 'name'},
            {data:'description', name: 'description'},
            {data:'category_id', name: 'category_id'},
            {data:'unit_id', name: 'unit_id'},
            {data:'qty', name: 'qty'},
            {data:'status', name: 'status'},
            {data:'aksi', name: 'aksi', orderable: false, searchable: false},
        ],
        'info'        : true,
        'order'       : ['0','desc'],
        'autoWidth'   : false
    });

    function filter() {
        table.draw();
    }

    function addData() {
        $('#myModal').modal('show');
        $('#myModal form')[0].reset();
        $('[name=id]').val(0);
        $('[name=method]').val('ADD');
        $('.modal-title').text('Tambah Data');
    }

    function deleteData(id) {
        swal({
            title: "Yakin Hapus Data?",
            text : "Data akan dihapus permanen",
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
                $.ajax({
                    url: "{{ route('admin.product.delete',['id'=>'']) }}" + '/' + id,
                    type: "POST",
                    data: {
                        '_token': '{{csrf_token()}}' 
                    },
                    success: function(data) {
                        swal({
                            title: 'Berhasil Hapus Data!',
                            text: 'Data berhasil di hapus',
                            icon: 'success',
                            timer: '3000'
                        });
                        table.ajax.reload();
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
                swal('Data tidak jadi dihapus');
            }
        });
    }

    $('#submit').click(function(e){
      e.preventDefault();
      var id = $('#id').val();
      url = "{{route('admin.product.save')}}";
      
      $('.form-group').removeClass('has-error');
      $('.help-block-error').html('');

      $('#myModal').modal('hide');

      $.ajax({
        url:url,
        type:'POST',
          // data: $('#myModal form').serialize(),
        data: $('#myModal form').serialize(),
        success: function(data){
            if(data.status){
                table.ajax.reload();
                swal({
                    title: 'Berhasil Simpan Data',
                    text: data.message,
                    icon: 'success',
                    timer: '3000'
                });
            }else{
                swal({
                    title: 'Gagal Simpan Data',
                    text: data.message,
                    icon: 'error',
                    timer: '3000'
                });
                var error_arr = [];
                @foreach($model::FORM_VALIDATION as $field => $value)
                error_arr.push('{{ $field }}');
                @endforeach
                for(var i=0;i < error_arr.length;i++){
                    if(error_arr[i] in data.error){
                        $('#'+error_arr[i]).addClass('has-error');
                        $('#'+error_arr[i]+'_error').html(data.error[error_arr[i]]);
                    }
                }

                $('#myModal').modal('show');
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
    });

</script>

@endpush
