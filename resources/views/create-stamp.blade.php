@extends('layouts.app')

@section('title', 'Create Stamp - Stampede')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-dost-dark mb-2">Create New Stamp</h2>
        <p class="text-gray-600">Share your message with the community</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Form Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form method="POST" action="{{ route('store-stamp') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="stp_to" class="block text-sm font-medium text-dost-dark mb-2">To:</label>
                    <input type="text" 
                           id="stp_to" 
                           name="stp_to" 
                           value="{{ old('stp_to') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-dost-blue"
                           placeholder="Who is this message for?"
                           required>
                    @error('stp_to')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="stp_from" class="block text-sm font-medium text-dost-dark mb-2">From:</label>
                    <input type="text" 
                           id="stp_from" 
                           name="stp_from" 
                           value="{{ old('stp_from') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-dost-blue"
                           placeholder="Your name or identifier"
                           required>
                    @error('stp_from')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="stp_message" class="block text-sm font-medium text-dost-dark mb-2">Message:</label>
                    <textarea id="stp_message" 
                              name="stp_message" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-dost-blue"
                              placeholder="Write your message here..."
                              required>{{ old('stp_message') }}</textarea>
                    @error('stp_message')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-dost-dark mb-2">Stamp Color:</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center">
                            <input type="radio" 
                                   name="stp_color" 
                                   value="blue" 
                                   {{ old('stp_color', 'blue') == 'blue' ? 'checked' : '' }}
                                   class="mr-2">
                            <div class="w-6 h-6 bg-blue-100 border-2 border-blue-300 rounded"></div>
                            <span class="ml-2 text-sm">Blue</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" 
                                   name="stp_color" 
                                   value="gray" 
                                   {{ old('stp_color') == 'gray' ? 'checked' : '' }}
                                   class="mr-2">
                            <div class="w-6 h-6 bg-gray-100 border-2 border-gray-300 rounded"></div>
                            <span class="ml-2 text-sm">Gray</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" 
                                   name="stp_color" 
                                   value="white" 
                                   {{ old('stp_color') == 'white' ? 'checked' : '' }}
                                   class="mr-2">
                            <div class="w-6 h-6 bg-white border-2 border-gray-300 rounded"></div>
                            <span class="ml-2 text-sm">White</span>
                        </label>
                    </div>
                    @error('stp_color')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-4">
                    <button type="submit" 
                            class="bg-dost-blue text-white px-6 py-2 rounded hover:bg-blue-600 transition">
                        Create Stamp
                    </button>
                    <a href="{{ route('wall') }}" 
                       class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        <!-- Preview Section -->
        <div class="bg-dost-light rounded-lg p-6">
            <h3 class="text-lg font-semibold text-dost-dark mb-4">Preview</h3>
            <div id="stamp-preview" class="bg-blue-100 border-2 dost-blue rounded-lg shadow-md p-6 border-dost-dark">
                <div class="stamp-header mb-4">
                    <div class="text-sm font-semibold text-dost-dark">
                        To: <span id="preview-to">Someone</span>
                    </div>
                    <div class="text-sm text-gray-600">
                        From: <span id="preview-from">You</span>
                    </div>
                </div>
                
                <div class="stamp-message mb-4">
                    <p id="preview-message" class="text-dost-dark leading-relaxed">Your message will appear here...</p>
                </div>
                
                <div class="stamp-footer flex justify-between items-center text-xs text-gray-500">
                    <span>{{ date('M d, Y') }}</span>
                    <div class="flex space-x-2">
                        <span class="text-dost-blue">Edit</span>
                        <span class="text-red-500">Delete</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputTo = document.getElementById('stp_to');
    const inputFrom = document.getElementById('stp_from');
    const inputMessage = document.getElementById('stp_message');
    const radioColors = document.querySelectorAll('input[name="stp_color"]');
    
    const previewTo = document.getElementById('preview-to');
    const previewFrom = document.getElementById('preview-from');
    const previewMessage = document.getElementById('preview-message');
    const previewStamp = document.getElementById('stamp-preview');

    // Update preview on input changes
    inputTo.addEventListener('input', function() {
        previewTo.textContent = this.value || 'Someone';
    });

    inputFrom.addEventListener('input', function() {
        previewFrom.textContent = this.value || 'You';
    });

    inputMessage.addEventListener('input', function() {
        previewMessage.textContent = this.value || 'Your message will appear here...';
    });

    radioColors.forEach(radio => {
        radio.addEventListener('change', function() {
            updatePreviewColor(this.value);
        });
    });

    function updatePreviewColor(strColor) {
        previewStamp.className = 'rounded-lg shadow-md p-6 border-2 border-dost-dark';
        
        switch(strColor) {
            case 'blue':
                previewStamp.classList.add('bg-blue-100', 'border-blue-300');
                break;
            case 'gray':
                previewStamp.classList.add('bg-gray-100', 'border-gray-300');
                break;
            case 'white':
                previewStamp.classList.add('bg-white', 'border-gray-300');
                break;
        }
    }

    // Initialize preview with default values
    updatePreviewColor('blue');
});
</script>
@endsection