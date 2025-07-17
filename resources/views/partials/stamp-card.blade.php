@php
    $strColorClass = match ($stamp->stp_color) {
        'sunrays' => 'bg-yellow-100 border-yellow-300',
        'lime' => 'bg-lime-100 border-lime-300',
        'blaze' => 'bg-orange-100 border-orange-300',
        'hotpink' => 'bg-pink-100 border-pink-300',
        'skyblue' => 'bg-sky-100 border-sky-300',
        'white' => 'bg-white border-gray-300',
        default => 'bg-white border-gray-300'
    };
@endphp

<div class="flex flex-col p-3 transition-transform duration-200 transform border-2 bg-dost-light h-80 border-dost-dark hover:scale-105">
    <!-- Header with network logo and date -->
    <div class="flex items-center justify-between mb-3">
        <div class="flex items-center">
            <div class="w-6 h-6 border-2 bg-dost-dark border-dost-dark">
                <div class="flex items-center justify-center w-full h-full text-xs font-bold text-dost-light">ST</div>
            </div>
            <span class="ml-2 text-xs font-bold text-dost-dark">STAMPede</span>
        </div>
        <div class="text-xs text-dost-dark">{{ $stamp->created_at->format('m/d') }}</div>
    </div>
    
    <!-- To and From -->
    <div class="mb-3">
        <div class="text-xs font-semibold text-dost-dark">
            To: <span>{{ $stamp->stp_to }}</span>
        </div>
        <div class="text-xs text-dost-dark">
            From: <span>{{ $stamp->stp_from }}</span>
        </div>
    </div>
    
    <!-- Message Body -->
    <div class="flex-1 mb-3 overflow-hidden">
        <div class="h-full p-2 text-sm leading-relaxed break-words border-2 text-dost-dark {{ $strColorClass }} overflow-y-auto">{{ $stamp->stp_message }}</div>
    </div>
    
    <!-- Footer with Edit and Delete -->
    <div class="flex items-center justify-between text-xs">
        <a href="{{ route('edit-stamp', $stamp->stp_id) }}" class="cursor-pointer text-dost-blue hover:underline">Edit</a>
        <button onclick="showDeleteModal({{ $stamp->stp_id }})" class="cursor-pointer text-dost-dark hover:underline">Delete</button>
    </div>
</div>