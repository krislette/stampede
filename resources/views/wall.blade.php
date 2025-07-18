<!-- ======================================================================
SYSTEM NAME: STAMPede
PURPOSE: UI/View for the wall where stamps are posted
PROGRAMMER: Acelle Krislette L. Rosales
COPYRIGHT: © 2025 ITD. All rights reserved.
====================================================================== -->

@extends('layouts.app')

@section('title', 'STAMPede')

@if (session('success'))
    <!-- Success Modal -->
    <div id="success-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="w-full max-w-md p-6 mx-4 font-mono bg-white border border-black">
            <div class="mb-4 font-bold text-center text-dost-blue">
                <strong>{{ session('success') }}</strong>
            </div>

            @if (session('edit_code'))
                <div class="mb-4 text-sm">
                    <div class="mb-1">Your stamp edit/delete code is:</div>
                    <div class="flex items-center gap-2">
                        <div class="flex-1 px-2 py-2 bg-gray-100 border border-gray-400 select-all" id="editCode">
                            {{ session('edit_code') }}
                        </div>
                        <button onclick="copyCode()" class="px-3 py-2 text-sm border border-dost-blue text-dost-blue hover:bg-dost-blue hover:text-dost-light">
                            Copy
                        </button>
                    </div>
                </div>
            @endif

            <div class="flex justify-center">
                <button onclick="closeModal()" class="px-4 py-2 border border-dost-dark text-dost-dark hover:bg-dost-dark hover:text-dost-light">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        // Function to copy the edit/delete code to user's clipboard
        function copyCode() {
            const text = document.getElementById('editCode').innerText;
            navigator.clipboard.writeText(text)
                .then(() => showToast('Copied successfully!'))
                .catch(() => showToast('Failed to copy code.', true));
        }

        // Function to close a modal
        function closeModal() {
            document.getElementById('success-modal').style.display = 'none';
        }
    </script>
@endif

<!-- Delete Modal -->
<div id="delete-modal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-full max-w-md p-6 mx-4 font-mono bg-white border border-black">
        <div class="mb-4 text-sm text-dost-dark">
            Please enter the edit/delete code to confirm deletion:
        </div>
        <input id="delete-code" type="text" class="w-full px-2 py-2 mb-4 border border-gray-400 focus:outline-none" placeholder="Enter code" />

        <div class="flex justify-between">
            <button onclick="closeDeleteModal()" class="px-4 py-2 border text-dost-dark border-dost-dark hover:bg-dost-dark hover:text-dost-light">
                Cancel
            </button>
            <button onclick="submitDelete()" class="px-4 py-2 border text-dost-blue border-dost-blue hover:bg-dost-blue hover:text-dost-light">
                Delete
            </button>
        </div>
    </div>
</div>

@section('content')
    <div class="max-w-full">
        <div id="stamps-container" class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
            @foreach($arrStamps as $stamp)
                @include('partials.stamp_card', ['stamp' => $stamp])
            @endforeach
        </div>

        @if($arrStamps->hasMorePages())
            <div class="mt-8 text-center">
                <button id="load-more-btn" class="px-6 py-3 text-lg font-bold tracking-wide transition border-2 text-dost-blue bg-dost-light hover:bg-dost-blue border-dost-blue hover:text-dost-light">
                    LOAD MORE STAMPS
                </button>
            </div>
        @endif

        <div id="loading" class="hidden mt-8 text-center">
            <div class="inline-block w-8 h-8 border-b-2 rounded-full animate-spin border-dost-blue"></div>
            <p class="mt-2 font-mono text-gray-600">Loading more stamps...</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initializing components and monitoring variables
            let intCurrentPage = 1;
            let intCurrentDeleteId = null;
            const btnLoadMore = document.getElementById('load-more-btn');
            const divLoading = document.getElementById('loading');
            const divStampsContainer = document.getElementById('stamps-container');

            // Logic for if the load more button is present
            if (btnLoadMore) {
                btnLoadMore.addEventListener('click', function () {
                    intCurrentPage++;
                    loadMoreStamps();
                });
            }

            // Function to enable the loading and showing of more stamps
            function loadMoreStamps() {
                btnLoadMore.classList.add('hidden');
                divLoading.classList.remove('hidden');

                fetch(`/load-more-stamps?page=${intCurrentPage}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.stamps && data.stamps.length > 0) {
                            data.stamps.forEach(stamp => {
                                const stampHtml = createStampHtml(stamp);
                                divStampsContainer.insertAdjacentHTML('beforeend', stampHtml);
                            });
                        }

                        if (data.has_more) {
                            btnLoadMore.classList.remove('hidden');
                        } else {
                            btnLoadMore.classList.add('hidden');
                        }
                        divLoading.classList.add('hidden');
                    })
                    .catch(error => {
                        console.error('Error loading stamps:', error);
                        divLoading.style.display = 'none';
                        btnLoadMore.style.display = 'block';
                    });
            }

            /**
             * Function to create stamp template HTML for creating more stamps
             * @param {object} objStamp
             */
            function createStampHtml(objStamp) {
                const strColorClass = getColorClass(objStamp.stp_color);
                const stampDate = new Date(objStamp.created_at);
                const strFormattedDate = `${String(stampDate.getMonth() + 1).padStart(2, '0')}/${String(stampDate.getDate()).padStart(2, '0')}`;

                return `
                    <div id="stamp-${objStamp.stp_id}" class="flex flex-col p-4 transition-transform duration-200 transform bg-white border-2 shadow-md h-80 border-dost-dark hover:scale-105">
                        <!-- Header with network logo and date -->
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center">
                                <div class="w-6 h-6 border-2 bg-dost-dark border-dost-dark">
                                    <div class="flex items-center justify-center w-full h-full text-xs font-bold text-white">ST</div>
                                </div>
                                <span class="ml-2 text-xs font-bold text-dost-dark">STAMPede</span>
                            </div>
                            <div class="text-xs text-dost-dark">${strFormattedDate}</div>
                        </div>
                        
                        <!-- To and From -->
                        <div class="mb-3">
                            <div class="text-xs font-semibold text-dost-dark">
                                To: <span>${objStamp.stp_to}</span>
                            </div>
                            <div class="text-xs text-dost-dark">
                                From: <span>${objStamp.stp_from}</span>
                            </div>
                        </div>
                        
                        <!-- Message Body -->
                        <div class="flex-1 mb-3 overflow-hidden">
                            <div class="h-full p-3 text-sm leading-relaxed break-words border-2 text-dost-dark ${strColorClass} overflow-y-auto">${objStamp.stp_message}</div>
                        </div>
                        
                        <!-- Footer with Edit and Delete -->
                        <div class="flex items-center justify-between text-xs">
                            <a href="/edit-stamp/${objStamp.stp_id}" class="cursor-pointer text-dost-blue hover:underline">Edit</a>
                            <button onclick="showDeleteModal(${objStamp.stp_id})" class="cursor-pointer text-dost-dark hover:underline">Delete</button>
                        </div>
                    </div>
                `;
            }

            /**
             * Helper function for getting colors
             * @param {string} strColor
             */
            function getColorClass(strColor) {
                switch(strColor) {
                    case 'sunrays':
                        return 'bg-yellow-100 border-yellow-300';
                    case 'lime':
                        return 'bg-lime-100 border-lime-300';
                    case 'blaze':
                        return 'bg-orange-100 border-orange-300';
                    case 'hotpink':
                        return 'bg-pink-100 border-pink-300';
                    case 'skyblue':
                        return 'bg-sky-100 border-sky-300';
                    case 'white':
                        return 'bg-white border-gray-300';
                    default:
                        return 'bg-white border-gray-300';
                }
            }
        });

        /**
         * Helper function to show delete modal
         * @param {int} stampId
         */
        function showDeleteModal(intStampId) {
            intCurrentDeleteId = intStampId;
            document.getElementById('delete-code').value = '';
            document.getElementById('delete-modal').style.display = 'flex';
        }

        // Function to collapse the delete modal
        function closeDeleteModal() {
            document.getElementById('delete-modal').style.display = 'none';
        }

        // Helper function that handles delete submission
        function submitDelete() {
            const code = document.getElementById('delete-code').value;
            if (!code) {
                showToast('Please enter a code.', true);
                return;
            }

            // Disable buttons and show loading state
            const cancelBtn = document.querySelector('#delete-modal button[onclick="closeDeleteModal()"]');
            const sendBtn = document.querySelector('#delete-modal button[onclick="submitDelete()"]');
            
            cancelBtn.disabled = true;
            sendBtn.disabled = true;
            sendBtn.textContent = 'Deleting...';
            
            // Add visual disabled state
            cancelBtn.classList.add('opacity-50', 'cursor-not-allowed');
            sendBtn.classList.add('opacity-50', 'cursor-not-allowed');

            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            formData.append('stp_edit_code', code);

            fetch(`/delete-stamp/${intCurrentDeleteId}`, {
                method: 'POST',
                body: formData
            })
            .then(res => {
                if (!res.ok) {
                    throw new Error('Network response was not ok');
                }
                return res.json();
            })
            .then(data => {
                // Re-enable buttons first
                cancelBtn.disabled = false;
                sendBtn.disabled = false;
                sendBtn.textContent = 'Delete';
                cancelBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                sendBtn.classList.remove('opacity-50', 'cursor-not-allowed');

                if (data.success) {
                    closeDeleteModal();
                    showToast('Deleted successfully!', false);
                    
                    // Remove the stamp from DOM instead
                    removeStampFromDOM(intCurrentDeleteId);
                } else {
                    showToast(data.message || 'Failed to delete. Wrong code.', true);
                }
            })
            .catch(error => {
                console.error('Delete error:', error);
                // Re-enable buttons
                cancelBtn.disabled = false;
                sendBtn.disabled = false;
                sendBtn.textContent = 'Delete';
                cancelBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                sendBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                
                showToast('An error occurred.', true);
            });
        }

        /**
         * Helper function to remove the stamp from DOM after deletion
         * @param {int} intStampId
         */
        function removeStampFromDOM(intStampId) {
            const stampElement = document.getElementById(`stamp-${intStampId}`);
            if (stampElement) {
                stampElement.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
                stampElement.style.opacity = '0';
                stampElement.style.transform = 'scale(0.95)';
                
                // Remove the element after the animation
                setTimeout(() => {
                    stampElement.remove();
                }, 300);
            }
        }
    </script>
@endsection