@extends('layouts.rider-app')
@section('content')
    <div class=" py-24 bg-[#FAFAFA]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div class="p-6 text-gray-900 space-y-3">
                    <h1 class="text-4xl font-semibold">Rider Dashboard</h1>
                </div>
                <div class="p-6">
                    @livewire('rider.dashboard')
                </div>
            </div>
        </div>
@endsection
