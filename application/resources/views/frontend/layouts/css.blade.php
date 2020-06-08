<!--begin::Fonts -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
	WebFont.load({
		google: {"families":["Poppins:300,400,500,600,700"]},
		active: function() {
			sessionStorage.fonts = true;
		}
	});
</script>

<!--end::Fonts -->

<!--begin::Page Vendors Styles(used by this page) -->
<link href="{{ url('frontend/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />

<!--end::Page Vendors Styles -->

<!--begin:: Global Mandatory Vendors -->
<link href="{{ url('frontend/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />

<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<link href="{{ url('frontend/vendors/general/tether/dist/css/tether.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/select2/dist/css/select2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/ion-rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/nouislider/distribute/nouislider.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/owl.carousel/dist/assets/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/owl.carousel/dist/assets/owl.theme.default.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/summernote/dist/summernote.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/animate.css/animate.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/general/socicon/css/socicon.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/vendors/custom/vendors/fontawesome5/css/all.min.css') }}" rel="stylesheet" type="text/css" />

<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Styles(used by all pages) -->
<link href="{{ url('frontend/demo/demo5/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('frontend/custom/css/custom.css') }}" rel="stylesheet" type="text/css" />
<link href="{{url('frontend/vendors/custom/ion.calendar-2.0.2/css/ion.calendar.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ url('frontend/assets/vendors/general/select2/dist/css/select2.css') }}" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles -->

<!--begin::Layout Skins(used by all pages) -->

<!--end::Layout Skins -->
<link rel="shortcut icon" href="{{ url('storage/'.$CONF->icon) }}" />
