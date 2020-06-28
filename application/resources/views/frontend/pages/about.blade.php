@extends('frontend.layouts.template')

@php
    @$about = json_decode(@$CONF->aboutDetail);
@endphp

@section('pageTitle',ucwords(@$about->title))

@push('customCss')

@endpush

@section('content')

    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{url("storage/".@$about->banner)}}');">
        <h2 class="ltext-105 cl0 txt-center">
            {{ucwords(@$about->title)}}
        </h2>
    </section>

    <!-- Content page -->
    <section class="bg0 p-t-75 p-b-120">
        <div class="container">
            <div class="row p-b-148">
                <div class="col-md-7 col-lg-8">
                    <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                        <h3 class="mtext-111 cl2 p-b-16">
                            {{ucwords(@$about->header1)}}
                        </h3>

                        {!! @$about->content1 !!}
                    </div>
                </div>

                <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                    <div class="how-bor1 ">
                        <div class="hov-img0">
                            <img src="{{url('storage/'.@$about->image1)}}" alt="{{ucwords(@$about->header1)}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="order-md-2 col-md-7 col-lg-8 p-b-30">
                    <div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
                        <h3 class="mtext-111 cl2 p-b-16">
                            {{ucwords(@$about->header2)}}
                        </h3>

                        {!! @$about->content2 !!}
                    </div>
                </div>

                <div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
                    <div class="how-bor2">
                        <div class="hov-img0">
                            <img src="{{url('storage/'.@$about->image2)}}" alt="{{ucwords(@$about->header2)}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('customJs')
    
@endpush