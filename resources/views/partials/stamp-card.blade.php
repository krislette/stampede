@php
    $strColorClass = match ($stamp->stp_color) {
        'blue' => 'bg-blue-100 border-blue-300',
        'gray' => 'bg-gray-100 border-gray-300',
        'white' => 'bg-white border-gray-300',
        default => 'bg-white border-gray-300'
    };
@endphp

<div
    class="stamp-card {{ $strColorClass }} rounded-lg shadow-md p-6 border-2 border-dost-dark transform hover:scale-105 transition-transform duration-200">
    <div class="stamp-header mb-4">
        <div class="text-sm font-semibold text-dost-dark">
            To: {{ $stamp->stp_to }}
        </div>
        <div class="text-sm text-gray-600">
            From: {{ $stamp->stp_from }}
        </div>
    </div>

    <div class="stamp-message mb-4">
        <p class="text-dost-dark leading-relaxed">{{ $stamp->stp_message }}</p>
    </div>

    <div class="stamp-footer flex justify-between items-center text-xs text-gray-500">
        <span>{{ $stamp->created_at->format('M d, Y') }}</span>
        <div class="flex space-x-2">
            <a href="{{ route('edit-stamp', $stamp->stp_id) }}" class="text-dost-blue hover:underline">Edit</a>
            <button onclick="showDeleteModal({{ $stamp->stp_id }})" class="text-red-500 hover:underline">Delete</button>
        </div>
    </div>
</div>