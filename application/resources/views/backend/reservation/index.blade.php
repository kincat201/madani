@extends('backend.layouts.template')

@section('pageTitle','PIC')

@push('customCss')
    <link href="{{url('backend/assets/global/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a> <i class="fa fa-circle"></i></li>
                <li><span>Reservation</span> <i class="fa fa-circle"></i></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered margin-top-20">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-dark"></i> <span
                                class="caption-subject font-dark bold uppercase">List Reservasi</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-12 col-lg-12" style="text-align: right;">
                                <a href="{{ route('admin.reservation.detail',['id'=>0]) }}" class="btn btn-primary">TAMBAH</a>
                                <a href="{{ route('admin.reservation.download') }}" target="_blank" class="btn btn-primary">EXPORT</a>
                            </div>
                        </div>
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td class="all">
                                        <input placeholder="Find Meeting" type="text" class="form-control" name="s_title" onchange="filter()">
                                    </td>
                                    <td></td>
                                    <td class="all">
                                        <input placeholder="Find Room" type="text" class="form-control" name="s_room" onchange="filter()">
                                    </td>
                                    <td class="all">
                                        <input placeholder="Find PIC" type="text" class="form-control" name="s_pic" onchange="filter()">
                                    </td>
                                    <td class="all">
                                        <input placeholder="Find Email" type="text" class="form-control" name="s_email" onchange="filter()">
                                    </td>
                                    <td class="all">
                                        <input placeholder="Find Phone" type="text" class="form-control" name="s_phone" onchange="filter()">
                                    </td>
                                    <td class="all">
                                        <input placeholder="Find Tanggal" type="text" class="form-control" name="s_reservationDate" onchange="filter()">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td class="all">
                                        <select class="form-control" name="s_status" onchange="filter()">
                                            <option value="">ALL</option>
                                            @foreach(\App\Util\Constant::RESERVATION_STATUS_LIST as $value => $label)
                                                <option value="{{$value}}">{{$label}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>No</th>
                                    <th style="min-width: 100px">Nama Meeting</th>
                                    <th style="min-width: 100px">Ruangan</th>
                                    <th style="min-width: 100px">Peserta</th>
                                    <th style="min-width: 100px">Pic</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th style="min-width: 100px">Tanggal</th>
                                    <th style="min-width: 70px">Periode</th>
                                    <th style="min-width: 70px">Konsumsi</th>
                                    <th style="min-width: 70px">Status</th>
                                    <th>Created</th>
                                    <th style="min-width: 150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@include('backend.reservation.modal-approve')

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
            url: "{{ route('admin.reservation.data') }}",
            data: function (d) {
                d.title = $('[name=s_title]').val();
                d.room = $('[name=s_room]').val();
                d.pic = $('[name=s_pic]').val();
                d.phone = $('[name=s_phone]').val();
                d.email = $('[name=s_email]').val();
                d.reservationDate = $('[name=s_reservationDate]').val();
                d.status = $('[name=s_status]').val();
            }
        },
        'dataType'    : 'json',
        'searching'   : false,
        'paging'      : true,
        'lengthChange': true,
        'columns'     : [
            {data:'id', name: 'id'},
            {data:'title', name: 'title'},
            {data:'room', name: 'room'},
            {data:'amount', name: 'amount'},
            {data:'pic', name: 'pic'},
            {data:'email', name: 'email'},
            {data:'phone', name: 'phone'},
            {data:'reservationDate', name: 'reservationDate'},
            {data:'periode', name: 'periode', orderable: false},
            {data:'food', name: 'food'},
            {data:'status', name: 'status'},
            {data:'created_at', name: 'created_at'},
            {data:'aksi', name: 'aksi', orderable: false, searchable: false},
        ],
        'order':[7,'desc'],
        'info'        : true,
        'autoWidth'   : false
    });

    function filter() {
        table.draw();
    }

    function setExportOption() {
        window.open('{{ route('admin.reservation.download') }}?recordDate='+$('[name=exportRecordDate]').val()+'&status='+$('[name=exportStatus]').val(),'_blank')
    }

    function approveData(id) {
        $('#myModal').modal('show');
        $('[name=id]').val(id);
        $('[name=status]').val('{{ \App\Util\Constant::RESERVATION_STATUS_APPROVED }}');
        $('#approveBtn').text('Setujui');
        $('.modal-title').text('Setujui Data');
    }

    function rejectData(id) {
        $('#myModal').modal('show');
        $('[name=id]').val(id);
        $('[name=status]').val('{{ \App\Util\Constant::RESERVATION_STATUS_REJECTED }}');
        $('#approveBtn').text('Tolak');
        $('.modal-title').text('Tolak Data');
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
                    url: "{{ route('admin.reservation.delete',['id'=>'']) }}" + '/' + id,
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
</script>
@endpush
