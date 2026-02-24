@extends('layouts.app')
@section('content')
    <div class=" py-24 bg-[#FAFAFA]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                @livewire('user.order-successful')
            </div>
        </div>
    </div>
@endsection
