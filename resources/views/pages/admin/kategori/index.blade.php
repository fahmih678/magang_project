@extends('layouts.admin')
@section('title', 'Kategori')
@section('kategori-active', 'active')
@section('breadcrumb')
    <div class="breadcrumb-wrapper mb-30">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Kategori
                </li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <livewire:admin.kategori.kategori-index></livewire:admin.kategori.kategori-index>
@endsection
@push('addon-style')
    @livewireStyles
@endpush
@push('addon-script')
    @livewireScripts
    {{-- script LiveAlert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
@endpush
