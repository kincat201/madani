<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="formData" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" id="id" value="0">
                    <input type="hidden" name="status" id="status">
                    <div class="form-group" id="remark">
                        <label class="control-label col-sm-4" for="remark">Keterangan</label>
                        <div class="col-sm-8">
                            <textarea name="remark" class="form-control"></textarea>
                            <div id="remark_error" class="help-block help-block-error"> </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="submit approveBtn" onclick="approve()" type="button" class="btn btn-primary">Setujui</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
        </div>

    </div>
</div>
<!-- End Modal -->

@push('customJs')
    <script>
        function approve(){
            $('.form-group').removeClass('has-error');
            $('.help-block-error').html('');

            $('#myModal').modal('hide');

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
                        url: "{{ route('admin.reservation.approve') }}",
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

                                error_arr.push('remark');
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
                }else{
                    swal('Data tidak jadi disimpan');
                }
            });
        }
    </script>
@endpush
