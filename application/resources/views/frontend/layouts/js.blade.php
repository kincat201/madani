<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#3d94fb",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#3d94fb",
                "warning": "#ffb822",
                "danger": "#fd27eb"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin:: Global Mandatory Vendors -->
<script src="{{ url('frontend/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/js-cookie/src/js.cookie.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/moment/min/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/tooltip.js/dist/umd/tooltip.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/sticky-js/dist/sticky.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/wnumb/wNumb.js') }}" type="text/javascript"></script>

<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<script src="{{ url('frontend/vendors/general/jquery-form/dist/jquery.form.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/bootstrap-datepicker/init.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/bootstrap-timepicker/init.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/bootstrap-switch/init.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/select2/dist/js/select2.full.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/ion-rangeslider/js/ion.rangeSlider.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/typeahead.js/dist/typeahead.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/handlebars/dist/handlebars.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/inputmask/dist/jquery.inputmask.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/nouislider/distribute/nouislider.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/owl.carousel/dist/owl.carousel.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/autosize/dist/autosize.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/clipboard/dist/clipboard.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/dropzone/dist/dropzone.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/summernote/dist/summernote.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/markdown/lib/markdown.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/bootstrap-markdown/init.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-notify/bootstrap-notify.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/bootstrap-notify/init.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/jquery-validation/dist/jquery.validate.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/jquery-validation/dist/additional-methods.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/jquery-validation/init.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/raphael/raphael.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/morris.js/morris.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/chart.js/dist/Chart.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/waypoints/lib/jquery.waypoints.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/counterup/jquery.counterup.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/es6-promise-polyfill/promise.min.js') }}" type="text/javascript"></script>
{{--<script src="{{ url('frontend/vendors/general/sweetalert2/dist/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/sweetalert2/init.js') }}" type="text/javascript"></script>--}}
<!-- Sweet Alert -->
<script src="{{url('backend/assets/global/sweetalert.min.js')}}"></script>
<!-- Sweet Alert -->
<script src="{{ url('frontend/vendors/general/jquery.repeater/src/lib.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/jquery.repeater/src/jquery.input.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/jquery.repeater/src/repeater.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/dompurify/dist/purify.js') }}" type="text/javascript"></script>

<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ url('frontend/demo/demo5/base/scripts.bundle.js') }}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="{{ url('frontend/vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/gmaps/gmaps.js') }}" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ url('frontend/app/custom/general/dashboard.js') }}" type="text/javascript"></script>

<!--end::Page Scripts -->

<!--begin::Global App Bundle(used by all pages) -->
<script src="{{ url('frontend/app/bundle/app.bundle.js') }}" type="text/javascript"></script>

<!--end::Global App Bundle -->

<script src="{{ url('frontend/vendors/custom/ion.calendar-2.0.2/js/ion.calendar.js') }}"></script>

<!-- Auto Numeric -->
<script src="{{url('backend/assets/global/autonumeric.min.js')}}"></script>
<!-- Auto Numeric -->

<script src="{{ url('frontend/app/custom/general/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>


<script>
    $(".datepickerinput").ionDatePicker({
        years: "{{ \Carbon\Carbon::now()->subYear(80)->format('Y').'-'.\Carbon\Carbon::now()->addYear(3)->format('Y') }}",                    // years diapason
        format: "YYYY-MM-DD",
    });

    $(".timepicker").timepicker({
        showMeridian : false,
        showSeconds: true
    });

    $(function() {
        var autonumericDecimalOptions = {
            digitGroupSeparator: '.',
            decimalPlacesOverride:0,
            decimalCharacter  : ',',
            allowDecimalPadding: false,
            unformatOnSubmit : true
        };

        new AutoNumeric.multiple('.autonumeric', autonumericDecimalOptions);
    });

    function saveProfile(){
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
                    url: "{{ route('pic.save.account') }}",
                    type: "POST",
                    data: new FormData($("#form_profile")[0]),
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
                                location.reload();
                            });
                        }else{
                            swal({
                                title: 'Gagal Simpan Data',
                                text: response.message,
                                icon: 'error',
                                timer: '3000'
                            });
                            var error_arr = ['name-profile','password-profile','newPassword-profile'];

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
