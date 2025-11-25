<div class="p-6 bg-white rounded shadow-md" wire:poll.5s>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-green-100 p-4 rounded text-center shadow-sm">
            <h2 class="text-xl font-bold text-green-700">Completed Today</h2>
            <p class="text-3xl font-semibold">{{ $completedToday }}</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded text-center shadow-sm">
            <h2 class="text-xl font-bold text-yellow-700">Active Orders</h2>
            <p class="text-3xl font-semibold">{{ $activeCount }}</p>
        </div>
        <div class="bg-blue-100 p-4 rounded text-center shadow-sm">
            <h2 class="text-xl font-bold text-blue-700">Today's Value</h2>
            <p class="text-3xl font-semibold">₱{{ number_format($earningsToday, 2) }}</p>
        </div>
    </div>

    <h3 class="text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2">
        <x-ui.icon name="ps:truck" class="w-6 h-6"/>
        Active Deliveries
    </h3>

    <div class="space-y-4">
        @forelse($activeDeliveries as $delivery)
            <div class="border border-gray-200 p-5 rounded-xl shadow-sm bg-gray-50 hover:bg-white transition duration-200">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h4 class="font-bold text-lg text-gray-800">
                            Order #{{ $delivery->order->order_number ?? 'N/A' }}
                        </h4>
                        <span class="text-xs text-gray-500">Assigned: {{ $delivery->created_at->diffForHumans() }}</span>
                    </div>

                    <span class="px-3 py-1 text-sm font-medium rounded-full
                        {{ $delivery->status === 'Assigned' ? 'bg-yellow-200 text-yellow-800' : 'bg-blue-200 text-blue-800' }}">
                        {{ $delivery->status }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                    <p><strong class="text-gray-800">Customer:</strong> {{ $delivery->order->user->name ?? 'Guest' }}</p>
                    <p><strong class="text-gray-800">Contact:</strong> {{ $delivery->order->user->email ?? 'N/A' }}</p>

                    <p class="md:col-span-2"><strong class="text-gray-800">Address:</strong>
                        {{ $delivery->address ?? ($delivery->order->delivery->address ?? 'Address not provided') }}
                    </p>

                    <p><strong class="text-gray-800">Items:</strong> {{ $delivery->order->orderItems->count() }} items</p>
                    <p><strong class="text-gray-800">Total to Collect:</strong> ₱{{ number_format($delivery->order->total_amount, 2) }}</p>
                </div>

                <div class="mt-5 flex gap-3">
                    @if($delivery->status === 'Assigned')
                        <button
                            wire:click="markPickedUp({{ $delivery->id }})"
                            wire:loading.attr="disabled"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition flex-1 shadow-md">
                            Accept / Pick Up
                        </button>
                    @elseif($delivery->status === 'Picked Up')
                        <button
                            wire:click="markDelivered({{ $delivery->id }})"
                            wire:confirm="Are you sure this order has been delivered?"
                            wire:loading.attr="disabled"
                            class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition flex-1 shadow-md">
                            Mark as Delivered
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-10 bg-gray-50 rounded-lg border-dashed border-2 border-gray-300">
                <p class="text-gray-500 text-lg">No active deliveries assigned yet.</p>
                <p class="text-sm text-gray-400">Waiting for new orders...</p>
            </div>
        @endforelse
    </div>
</div>
