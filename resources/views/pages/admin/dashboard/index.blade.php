@extends('layouts.admin')
@section('title', 'Dashboard')
@section('dashboard-active', 'active')
@section('breadcrumb')
    <div class="breadcrumb-wrapper mb-30">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <!-- ========== title-wrapper end ========== -->
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon purple">
                    <i class="lni lni-cup"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">Total Barang</h6>
                    {{-- <h3 class="text-bold mb-10">{{count($barang)}}</h3> --}}
                    <h3 class="text-bold mb-10">123</h3>
                </div>
            </div>
            <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon success">
                    <i class="lni lni-world"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">Jumlah Kategori</h6>
                    {{-- <h3 class="text-bold mb-10">{{count($kategori)}}</h3> --}}
                    <h3 class="text-bold mb-10">10</h3>
                </div>
            </div>
            <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->
@endsection
