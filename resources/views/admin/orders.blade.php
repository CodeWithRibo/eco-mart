@extends('layouts.admin-app')
@section('content')
    <div class=" py-24 bg-[#FAFAFA]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div class="p-6 text-gray-900 space-y-3">
                    <h1 class="text-4xl font-semibold">Orders Management</h1>
                    <p class="text-base text-gray-500">Manage orders, assign riders, and track deliveries</p>
                </div>

                <div class="p-6">
                    @livewire('admin.order')
                </div>
            </div>
        </div>
@endsection
