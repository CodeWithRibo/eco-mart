@extends('layouts.admin-app')
@section('content')
    <div class=" py-24 bg-[#FAFAFA]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div class="p-6 text-gray-900 space-y-3">
                    <h1 class="text-4xl font-semibold">Inventory Management</h1>
                    <p class="text-base text-gray-500">Manage your product inventory and stock levels</p>
                </div>

                <x-ui.modal
                    id="add-product"
                    position="center"
                    heading="Adding Product"
                >
                  @livewire('admin.inventory.product-create')
                </x-ui.modal>

                <x-ui.modal
                    id="edit-product"
                    position="center"
                    heading="Edit Product"
                >
                    @livewire('admin.inventory.product-edit')
                </x-ui.modal>

                <x-ui.modal
                    id="delete-product"
                    position="center"
                    heading="Delete Product"
                >
                    @livewire('admin.inventory.product-delete')
                </x-ui.modal>

            </div>
            <div class="p-6">
                @livewire('admin.inventory.product-list')
            </div>
        </div>
    </div>
@endsection
