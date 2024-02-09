@extends('layouts.master_front')

@section('content')
<div class="container">
    <div class="row page-layout">
        <div class="top-layout">
            <div class="form-group">
                <h4>مشاريعنا</h4>
                <hr class="line-isolate"/>
            </div>
            <div class="left-section d-flex">
                <div class="form-group" style="margin:auto 10px;">
                    <input type="text" placeholder="البحث فى المشاريع" class="form-control"/>
                </div>
                <div class="form-group" style="margin:auto 10px;">
                    <select class="form-control">
                        <option value="">الترتيب</option>
                        <option vlaue="20">20</option>
                        <option vlaue="40">40</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="cards d-flex">
            @foreach($projects as $project)
                <div class="card-hover">
                    <a href="{{ url('project/'.$project->slug) }}">
                        <div class="card-hover__content">
                            <h3 class="card-hover__title">
                               {{ $project->name }}
                            </h3>
                            <p class="card-hover__text">
                                {{ $project->short_description }}
                            </p>
                            <div class="lists-btns">
                                <a href="{{ url('project/'.$project->slug) }}" class="card-hover__link btn btn-warning btn-sm">
                                    <span style="color:#121212">طلب مشروع مماثل</span>
                                </a>
                            </div>
                        </div>
                        {{-- <div class="card-hover__extra">
                            <h4>Learn <span>now</span> and get <span>40%</span> discount!</h4>
                        </div> --}}
                        <img src="https://images.unsplash.com/photo-1586511925558-a4c6376fe65f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=60" alt="">
                        {{-- <img src="{{ upload_assets($project->image_info) }}" alt=""> --}}
                    </a>
                </div>
            @endforeach
            @if(!$projects)
                <div class="alert">
                    لايوجد مشاريع مضافة
                </div>
            @endif
            {!! $projects->links() !!}
        </div>
    </div>
</div>
@endsection

@section('after_header')
{{-- <svg id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 100" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(3, 18, 68, 1)" offset="0%"></stop><stop stop-color="rgba(3, 18, 68, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,40L48,45C96,50,192,60,288,56.7C384,53,480,37,576,40C672,43,768,67,864,71.7C960,77,1056,63,1152,48.3C1248,33,1344,17,1440,11.7C1536,7,1632,13,1728,28.3C1824,43,1920,67,2016,63.3C2112,60,2208,30,2304,18.3C2400,7,2496,13,2592,16.7C2688,20,2784,20,2880,21.7C2976,23,3072,27,3168,28.3C3264,30,3360,30,3456,36.7C3552,43,3648,57,3744,65C3840,73,3936,77,4032,65C4128,53,4224,27,4320,26.7C4416,27,4512,53,4608,55C4704,57,4800,33,4896,28.3C4992,23,5088,37,5184,35C5280,33,5376,17,5472,18.3C5568,20,5664,40,5760,51.7C5856,63,5952,67,6048,65C6144,63,6240,57,6336,60C6432,63,6528,77,6624,73.3C6720,70,6816,50,6864,40L6912,30L6912,100L6864,100C6816,100,6720,100,6624,100C6528,100,6432,100,6336,100C6240,100,6144,100,6048,100C5952,100,5856,100,5760,100C5664,100,5568,100,5472,100C5376,100,5280,100,5184,100C5088,100,4992,100,4896,100C4800,100,4704,100,4608,100C4512,100,4416,100,4320,100C4224,100,4128,100,4032,100C3936,100,3840,100,3744,100C3648,100,3552,100,3456,100C3360,100,3264,100,3168,100C3072,100,2976,100,2880,100C2784,100,2688,100,2592,100C2496,100,2400,100,2304,100C2208,100,2112,100,2016,100C1920,100,1824,100,1728,100C1632,100,1536,100,1440,100C1344,100,1248,100,1152,100C1056,100,960,100,864,100C768,100,672,100,576,100C480,100,384,100,288,100C192,100,96,100,48,100L0,100Z"></path><defs><linearGradient id="sw-gradient-1" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(3, 18, 68, 1)" offset="0%"></stop><stop stop-color="rgba(3, 18, 68, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 50px); opacity:0.9" fill="url(#sw-gradient-1)" d="M0,0L48,11.7C96,23,192,47,288,55C384,63,480,57,576,50C672,43,768,37,864,30C960,23,1056,17,1152,25C1248,33,1344,57,1440,56.7C1536,57,1632,33,1728,20C1824,7,1920,3,2016,1.7C2112,0,2208,0,2304,1.7C2400,3,2496,7,2592,11.7C2688,17,2784,23,2880,35C2976,47,3072,63,3168,66.7C3264,70,3360,60,3456,50C3552,40,3648,30,3744,36.7C3840,43,3936,67,4032,65C4128,63,4224,37,4320,28.3C4416,20,4512,30,4608,31.7C4704,33,4800,27,4896,25C4992,23,5088,27,5184,38.3C5280,50,5376,70,5472,76.7C5568,83,5664,77,5760,76.7C5856,77,5952,83,6048,80C6144,77,6240,63,6336,48.3C6432,33,6528,17,6624,15C6720,13,6816,27,6864,33.3L6912,40L6912,100L6864,100C6816,100,6720,100,6624,100C6528,100,6432,100,6336,100C6240,100,6144,100,6048,100C5952,100,5856,100,5760,100C5664,100,5568,100,5472,100C5376,100,5280,100,5184,100C5088,100,4992,100,4896,100C4800,100,4704,100,4608,100C4512,100,4416,100,4320,100C4224,100,4128,100,4032,100C3936,100,3840,100,3744,100C3648,100,3552,100,3456,100C3360,100,3264,100,3168,100C3072,100,2976,100,2880,100C2784,100,2688,100,2592,100C2496,100,2400,100,2304,100C2208,100,2112,100,2016,100C1920,100,1824,100,1728,100C1632,100,1536,100,1440,100C1344,100,1248,100,1152,100C1056,100,960,100,864,100C768,100,672,100,576,100C480,100,384,100,288,100C192,100,96,100,48,100L0,100Z"></path><defs><linearGradient id="sw-gradient-2" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(3, 18, 68, 1)" offset="0%"></stop><stop stop-color="rgba(3, 18, 68, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 100px); opacity:0.8" fill="url(#sw-gradient-2)" d="M0,80L48,70C96,60,192,40,288,40C384,40,480,60,576,60C672,60,768,40,864,30C960,20,1056,20,1152,23.3C1248,27,1344,33,1440,40C1536,47,1632,53,1728,51.7C1824,50,1920,40,2016,31.7C2112,23,2208,17,2304,15C2400,13,2496,17,2592,21.7C2688,27,2784,33,2880,45C2976,57,3072,73,3168,78.3C3264,83,3360,77,3456,66.7C3552,57,3648,43,3744,38.3C3840,33,3936,37,4032,46.7C4128,57,4224,73,4320,66.7C4416,60,4512,30,4608,23.3C4704,17,4800,33,4896,38.3C4992,43,5088,37,5184,35C5280,33,5376,37,5472,33.3C5568,30,5664,20,5760,13.3C5856,7,5952,3,6048,5C6144,7,6240,13,6336,20C6432,27,6528,33,6624,31.7C6720,30,6816,20,6864,15L6912,10L6912,100L6864,100C6816,100,6720,100,6624,100C6528,100,6432,100,6336,100C6240,100,6144,100,6048,100C5952,100,5856,100,5760,100C5664,100,5568,100,5472,100C5376,100,5280,100,5184,100C5088,100,4992,100,4896,100C4800,100,4704,100,4608,100C4512,100,4416,100,4320,100C4224,100,4128,100,4032,100C3936,100,3840,100,3744,100C3648,100,3552,100,3456,100C3360,100,3264,100,3168,100C3072,100,2976,100,2880,100C2784,100,2688,100,2592,100C2496,100,2400,100,2304,100C2208,100,2112,100,2016,100C1920,100,1824,100,1728,100C1632,100,1536,100,1440,100C1344,100,1248,100,1152,100C1056,100,960,100,864,100C768,100,672,100,576,100C480,100,384,100,288,100C192,100,96,100,48,100L0,100Z"></path></svg> --}}
@endsection

@push('style')
<style>

.ud-login{
    margin-top:2%;
}
.ud-login-wrapper{
    padding: 35px;
    box-shadow: 0px 0px 0px 0px !important;
}
.sticky .navbar-nav .nav-item a,
.sticky .navbar-btn .ud-main-btn.ud-login-btn{
    color:white;
}
.cards{
    display: flex!important;
    justify-content: flex-start;
    align-items: flex-end;
    flex-direction: row;
}
.page-layout{
    padding-top:6%;
    padding-bottom:10%;
}
.line-isolate{
    width: 50%;
    height: 0px;
    border: 2px solid #ff775e;
    margin-top: 7px;
    opacity: 1;
}
.top-layout{
    padding: 20px 10px;
    display: flex;
    justify-content: space-between;
}
.card-hover {
  width: 360px;
  height: 500px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 0 32px -10px rgba(0, 0, 0, 0.08);
}
.card-hover:has(.card-hover__link:hover) .card-hover__extra {
  transform: translateY(0);
  transition: transform 0.35s;
}
.card-hover:hover .card-hover__content {
  background-color: #031244;
  bottom: 100%;
  transform: translateY(100%);
  padding: 30px 16px;
  transition: all 0.35s cubic-bezier(0.1, 0.72, 0.4, 0.97);
}
.card-hover:hover .card-hover__link {
  opacity: 1;
  transform: translate(-50%, 0);
  transition: all 0.3s 0.35s cubic-bezier(0.1, 0.72, 0.4, 0.97);
}
.card-hover:hover img {
  transform: scale(1);
  transition: 0.35s 0.1s transform cubic-bezier(0.1, 0.72, 0.4, 0.97);
}
.card-hover__content {
  width: 100%;
  text-align: center;
  background-color: #4a2f76;
  padding: 0 30px 16px;
  position: absolute;
  bottom: 0;
  left: 0;
  transform: translateY(0);
  transition: all 0.35s 0.35s cubic-bezier(0.1, 0.72, 0.4, 0.97);
  will-change: bottom, background-color, transform, padding;
  z-index: 1;
}
.card-hover__content::before, .card-hover__content::after {
  content: "";
  width: 100%;
  height: 120px;
  background-color: inherit;
  position: absolute;
  left: 0;
  z-index: -1;
}
.card-hover__content::before {
  top: -80px;
  -webkit-clip-path: ellipse(60% 80px at bottom center);
          clip-path: ellipse(60% 80px at bottom center);
}
.card-hover__content::after {
  bottom: -80px;
  -webkit-clip-path: ellipse(60% 80px at top center);
          clip-path: ellipse(60% 80px at top center);
}
.card-hover__title {
  font-size: 1.5rem;
  margin-bottom: 1em;
  color:white;
}
.card-hover__title span {
  color: #2d7f0b;
}
.card-hover__text {
    font-size: 1rem;
    color: orange;
}
.card-hover__link {
  position: absolute;
  bottom: 1rem;
  left: 50%;
  transform: translate(-50%, 10%);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  text-decoration: none;
  color: #2d7f0b;
  opacity: 0;
  /* padding: 10px; */
  transition: all 0.35s;
}
.card-hover__link:hover svg {
  transform: translateX(4px);
}
.card-hover__link svg {
  width: 18px;
  margin-left: 4px;
  transition: transform 0.3s;
}
.card-hover__extra {
  height: 50%;
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  width: 100%;
  font-size: 1.5rem;
  text-align: center;
  background-color: #86b971;
  padding: 80px;
  bottom: 0;
  z-index: 0;
  color: #dee8c2;
  transform: translateY(100%);
  will-change: transform;
  transition: transform 0.35s;
}
.card-hover__extra span {
  color: #2d7f0b;
}
.card-hover img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  -o-object-fit: cover;
     object-fit: cover;
  -o-object-position: center;
     object-position: center;
  z-index: -1;
  transform: scale(1.2);
  transition: 0.35s 0.35s transform cubic-bezier(0.1, 0.72, 0.4, 0.97);
}

</style>
@endpush
