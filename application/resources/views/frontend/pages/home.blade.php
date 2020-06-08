@extends('frontend.layouts.template')

@section('pageTitle','Beranda')

@push('customCss')

@endpush

@section('breadcrumb')
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            Sistem Informasi Reservasi Ruangan </h3>
        <span class="kt-subheader__separator kt-hidden"></span>
        <div class="kt-subheader__breadcrumbs">
        </div>
    </div>
@endsection

@section('content')

    <!-- begin:: Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title kt-font-primary">
                            Daftar Reservasi
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-actions">
                            <a href="{{ route('reservation.detail',['id'=>0]) }}" class="btn btn-outline-brand btn-bold btn-sm">Tambah Reservasi</a>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Meeting</th>
                            <th>Ruangan</th>
                            <th>Peserta</th>
                            <th>PIC</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Konsumsi</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $dataKey => $dataVal)
                            <tr>
                                <td>{{ $dataKey+1 }}</td>
                                <td>{{ $dataVal->title }}</td>
                                <td>{{ \App\Util\Constant::ROOM_LIST[$dataVal->room] }}</td>
                                <td>{{ $dataVal->amount }}</td>
                                <td>{{ $dataVal->pic }}</td>
                                <td>{{ $dataVal->reservationDate }}</td>
                                <td>{{ \Carbon\Carbon::parse($dataVal->reservationTimeFrom)->format('H:i').' - ' . \Carbon\Carbon::parse($dataVal->reservationTimeTo)->format('H:i') }}</td>
                                <td><label class="text-{{ \App\Util\Constant::FOOD_LABEL_LIST[$dataVal->food] }}">{{\App\Util\Constant::FOOD_LIST[$dataVal->food]}}</label></td>
                                <td><label class="text-{{ \App\Util\Constant::RESERVATION_STATUS_LABEL_LIST[$dataVal->status] }}">{{\App\Util\Constant::RESERVATION_STATUS_LIST[$dataVal->status]}}</label></td>
                                <td>{{ $dataVal->remark }}</td>
                                <td>
                                    @if(@\Auth::user()->id == $dataVal->userId)
                                    <a href="{{ route('reservation.detail',['id'=>$dataVal->id]) }}" class="btn btn-info btn-xs">Detail</a>
                                    <a onclick="deleteData('{{ $dataVal->id }}')" class="btn btn-warning btn-xs">Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->

@endsection

@push('customJs')
    <!--begin::Page Vendors(used by this page) -->
    <script src="{{ url('frontend/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->
    <script>
        "use strict";
        var KTDatatablesBasicScrollable = function() {

            var initTable1 = function() {
                var table = $('#kt_table_1');

                // begin first table
                table.DataTable({
                    scrollY: '100vh',
                    scrollX: true,
                    scrollCollapse: true,
                    columnDefs: [
                        {
                            targets: -1,
                            orderable: false,
                        },
                    ],
                });
            };

            return {

                //main function to initiate the module
                init: function() {
                    initTable1();
                },

            };

        }();

        jQuery(document).ready(function() {
            KTDatatablesBasicScrollable.init();
        });

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
                            url: "{{ route('reservation.delete',['id'=>'']) }}" + '/' + id,
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
                                }).then((after)=>{
                                    location.reload();
                                });
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
    <!--end::Page Scripts -->

@endpush
