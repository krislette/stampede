<!-- ======================================================================
SYSTEM NAME: STAMPede
PURPOSE: UI/View for the 'create' page of STAMPede
PROGRAMMER: Acelle Krislette L. Rosales
COPYRIGHT: © 2025 ITD. All rights reserved.
====================================================================== -->

@extends('layouts.app')

@section('title', 'STAMPede: Create')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6 text-center">
        <h2 class="mb-1 text-3xl font-bold text-dost-dark">CREATE <span class="text-dost-blue">STAMP</span></h2>
        <p class="text-gray-600">Write it. Post it. Let the people see it.</p>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <!-- Form Section -->
        <div class="flex-1 p-4 border-2 bg-dost-light border-dost-dark">
            <form method="POST" action="{{ route('store-stamp') }}">
                @csrf

                <!-- To block -->
                <div class="mb-4">
                    <label for="stp_to" class="block mb-2 text-sm font-medium text-dost-dark">To:</label>
                    <input type="text" 
                        id="stp_to" 
                        name="stp_to" 
                        value="{{ old('stp_to') }}"
                        class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-dost-blue"
                        placeholder="Who is this message for?"
                        required>
                    @error('stp_to')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- From block -->
                <div class="mb-4">
                    <label for="stp_from" class="block mb-2 text-sm font-medium text-dost-dark">From:</label>
                    <input type="text" 
                           id="stp_from" 
                           name="stp_from" 
                           value="{{ old('stp_from') }}"
                           class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-dost-blue"
                           placeholder="Your name or identifier"
                           required>
                    @error('stp_from')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message block -->
                <div class="mb-4">
                    <label for="stp_message" class="block mb-2 text-sm font-medium text-dost-dark">Message:</label>
                    <textarea id="stp_message" 
                        name="stp_message" 
                        rows="4"
                        maxlength="150"
                        class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-dost-blue"
                        placeholder="Write your message here..."
                        required>{{ old('stp_message') }}</textarea>
                    <div class="flex justify-between mt-1">
                        <span id="char-count" class="text-xs text-gray-500">0/150 characters</span>
                        @error('stp_message')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Color section -->
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-dost-dark">Stamp Color:</label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="flex items-center">
                            <input type="radio" 
                                name="stp_color" 
                                value="sunrays" 
                                {{ old('stp_color', 'sunrays') == 'sunrays' ? 'checked' : '' }}
                                class="mr-2">
                            <div class="w-6 h-6 bg-yellow-100 border-2 border-yellow-300"></div>
                            <span class="ml-2 text-sm">Sunrays</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" 
                                name="stp_color" 
                                value="lime" 
                                {{ old('stp_color') == 'lime' ? 'checked' : '' }}
                                class="mr-2">
                            <div class="w-6 h-6 border-2 bg-lime-100 border-lime-300"></div>
                            <span class="ml-2 text-sm">Lime</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" 
                                name="stp_color" 
                                value="blaze" 
                                {{ old('stp_color') == 'blaze' ? 'checked' : '' }}
                                class="mr-2">
                            <div class="w-6 h-6 bg-orange-100 border-2 border-orange-300"></div>
                            <span class="ml-2 text-sm">Blaze</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" 
                                name="stp_color" 
                                value="hotpink" 
                                {{ old('stp_color') == 'hotpink' ? 'checked' : '' }}
                                class="mr-2">
                            <div class="w-6 h-6 bg-pink-100 border-2 border-pink-300"></div>
                            <span class="ml-2 text-sm">Hot Pink</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" 
                                name="stp_color" 
                                value="skyblue" 
                                {{ old('stp_color') == 'skyblue' ? 'checked' : '' }}
                                class="mr-2">
                            <div class="w-6 h-6 border-2 bg-sky-100 border-sky-300"></div>
                            <span class="ml-2 text-sm">Sky Blue</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" 
                                name="stp_color" 
                                value="white" 
                                {{ old('stp_color') == 'white' ? 'checked' : '' }}
                                class="mr-2">
                            <div class="w-6 h-6 bg-white border-2 border-gray-300"></div>
                            <span class="ml-2 text-sm">White</span>
                        </label>
                    </div>
                    @error('stp_color')
                        <p class="mt-1 text-sm text-dost-dark">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bottom buttons -->
                <div class="flex justify-between">
                    <a href="{{ route('wall') }}" 
                        class="px-6 py-2 transition text-dost-dark hover:text-dost-blue">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="px-6 py-2 transition border-2 text-dots-blue bg-dost-light border-dost-blue text-dost-blue hover:bg-dost-blue hover:text-dost-light">
                        Create Stamp
                    </button>
                </div>
            </form>
        </div>

        <!-- Preview Section -->
        <div class="flex flex-col flex-1 bg-dost-light">
            <div class="flex flex-col flex-1 p-4 bg-white border-2 border-dost-dark">
                <!-- Header with network logo and date -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 border-2 bg-dost-dark border-dost-dark">
                            <div class="flex items-center justify-center w-full h-full text-xs font-bold text-white">ST</div>
                        </div>
                        <span class="ml-2 text-sm font-bold text-dost-dark">STAMPede</span>
                    </div>
                    <div class="text-xs text-dost-dark" id="preview-date">{{ date('m/d') }}</div>
                </div>
                
                <!-- To and From -->
                <div class="mb-4">
                    <div class="text-sm font-semibold text-dost-dark">
                        To: <span id="preview-to">Someone</span>
                    </div>
                    <div class="text-sm text-dost-dark">
                        From: <span id="preview-from">You</span>
                    </div>
                </div>
                
                <!-- Message Body -->
                <div class="flex-1 mb-4">
                    <div id="preview-message" class="p-4 leading-relaxed break-words bg-blue-100 border-2 border-blue-300 text-dost-dark">Your message will appear here...</div>
                </div>
                
                <!-- Footer with Edit and Delete -->
                <div class="flex items-center justify-between text-xs">
                    <span class="cursor-pointer text-dost-blue hover:underline">Edit</span>
                    <span class="cursor-pointer text-dost-dark hover:underline">Delete</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initializing input fields & radio buttons
        const inputTo = document.getElementById('stp_to');
        const inputFrom = document.getElementById('stp_from');
        const inputMessage = document.getElementById('stp_message');
        const radioColors = document.querySelectorAll('input[name="stp_color"]');
        const charCount = document.getElementById('char-count');
        
        const previewTo = document.getElementById('preview-to');
        const previewFrom = document.getElementById('preview-from');
        const previewMessage = document.getElementById('preview-message');

        // Update date in MM/DD format
        function updateDate() {
            const now = new Date();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            document.getElementById('preview-date').textContent = `${month}/${day}`;
        }

        // Update character count on UI
        function updateCharCount() {
            const count = inputMessage.value.length;
            charCount.textContent = `${count}/150 characters`;
            
            if (count > 140) {
                charCount.classList.add('text-red-500');
                charCount.classList.remove('text-gray-500');
            } else {
                charCount.classList.add('text-gray-500');
                charCount.classList.remove('text-red-500');
            }
        }

        // Update preview on input changes
        inputTo.addEventListener('input', function() {
            previewTo.textContent = this.value || 'Someone';
        });

        inputFrom.addEventListener('input', function() {
            previewFrom.textContent = this.value || 'You';
        });

        inputMessage.addEventListener('input', function() {
            previewMessage.textContent = this.value || 'Your message will appear here...';
            updateCharCount();
        });

        radioColors.forEach(radio => {
            radio.addEventListener('change', function() {
                updatePreviewColor(this.value);
            });
        });

        /**
         * Update the preview color based on user choice
         * @param {string} strColor
         */
        function updatePreviewColor(strColor) {
            previewMessage.className = 'p-4 leading-relaxed text-dost-dark break-words border-2';
            
            switch(strColor) {
                case 'sunrays':
                    previewMessage.classList.add('bg-yellow-100', 'border-yellow-300');
                    break;
                case 'lime':
                    previewMessage.classList.add('bg-lime-100', 'border-lime-300');
                    break;
                case 'blaze':
                    previewMessage.classList.add('bg-orange-100', 'border-orange-300');
                    break;
                case 'hotpink':
                    previewMessage.classList.add('bg-pink-100', 'border-pink-300');
                    break;
                case 'skyblue':
                    previewMessage.classList.add('bg-sky-100', 'border-sky-300');
                    break;
                case 'white':
                    previewMessage.classList.add('bg-white', 'border-gray-300');
                    break;
            }
        }

        // Initialize preview with default values
        updatePreviewColor('sunrays');
        updateDate();
        updateCharCount();
    });
</script>
@endsection