@extends('layouts.app')

@section('title', 'STAMPede')

@if (session('success'))
    <!-- Success Modal -->
    <div id="success-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="max-w-md p-6 font-mono bg-white rounded-lg w-mx-4">
            <div class="mb-4 text-green-800">
                <strong>{{ session('success') }}</strong>
            </div>
            @if (session('edit_code'))
                <div class="mb-4 text-sm">
                    Your stamp edit/delete code is:
                    <div class="px-2 py-1 mt-2 font-mono bg-gray-100 border rounded select-all" id="editCode">
                        {{ session('edit_code') }}
                    </div>
                    <button onclick="copyCode()" class="px-4 py-2 mt-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Copy Code
                    </button>
                </div>
            @endif
            <button onclick="closeModal()" class="px-4 py-2 text-white bg-gray-600 rounded hover:bg-gray-700">
                Close
            </button>
        </div>
    </div>

    <script>
        function copyCode() {
            const text = document.getElementById('editCode').innerText;
            navigator.clipboard.writeText(text)
                .then(() => alert('Code copied!'))
                .catch(() => alert('Failed to copy code.'));
        }
        
        function closeModal() {
            document.getElementById('success-modal').style.display = 'none';
        }
    </script>
@endif

@section('content')
    <div class="max-w-full">
        <div id="stamps-container" class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
            @foreach($arrStamps as $stamp)
                @include('partials.stamp-card', ['stamp' => $stamp])
            @endforeach
        </div>

        @if($arrStamps->hasMorePages())
            <div class="mt-8 text-center">
                <button id="load-more-btn" class="px-6 py-3 font-mono font-bold tracking-wide text-white transition border-2 rounded bg-dost-blue hover:bg-blue-600 border-dost-blue">
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
            let intCurrentPage = 1;
            const btnLoadMore = document.getElementById('load-more-btn');
            const divLoading = document.getElementById('loading');
            const divStampsContainer = document.getElementById('stamps-container');

            if (btnLoadMore) {
                btnLoadMore.addEventListener('click', function () {
                    intCurrentPage++;
                    loadMoreStamps();
                });
            }

            function loadMoreStamps() {
                btnLoadMore.style.display = 'none';
                divLoading.style.display = 'block';

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
                            btnLoadMore.style.display = 'block';
                        } else {
                            btnLoadMore.style.display = 'none';
                        }

                        divLoading.style.display = 'none';
                    })
                    .catch(error => {
                        console.error('Error loading stamps:', error);
                        divLoading.style.display = 'none';
                        btnLoadMore.style.display = 'block';
                    });
            }

            function createStampHtml(stamp) {
                const strColorClass = getColorClass(stamp.stp_color);
                const strDate = new Date(stamp.created_at).toLocaleDateString();

                return `
                    <div class="stamp-card ${strColorClass} rounded-lg shadow-md p-6 border-2 border-dost-dark transform hover:scale-105 transition-transform duration-200 font-mono">
                        <div class="mb-4 stamp-header">
                            <div class="text-sm font-bold tracking-wide text-dost-dark">
                                TO: ${stamp.stp_to}
                            </div>
                            <div class="text-sm tracking-wide text-gray-600">
                                FROM: ${stamp.stp_from}
                            </div>
                        </div>

                        <div class="mb-4 stamp-message">
                            <p class="leading-relaxed text-dost-dark">${stamp.stp_message}</p>
                        </div>

                        <div class="flex items-center justify-between text-xs text-gray-500 stamp-footer">
                            <span class="tracking-wide">${strDate}</span>
                            <div class="flex space-x-2">
                                <a href="/edit-stamp/${stamp.stp_id}" class="font-bold tracking-wide text-dost-blue hover:underline">EDIT</a>
                                <button onclick="showDeleteModal(${stamp.stp_id})" class="font-bold tracking-wide text-red-500 hover:underline">DELETE</button>
                            </div>
                        </div>
                    </div>
                `;
            }

            function getColorClass(strColor) {
                switch (strColor) {
                    case 'blue': return 'bg-blue-100 border-blue-300';
                    case 'gray': return 'bg-gray-100 border-gray-300';
                    case 'white': return 'bg-white border-gray-300';
                    default: return 'bg-white border-gray-300';
                }
            }
        });

        function showDeleteModal(intStampId) {
            const strCode = prompt('Enter the edit code to delete this stamp:');
            if (strCode) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/delete-stamp/${intStampId}`;

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;

                const codeInput = document.createElement('input');
                codeInput.type = 'hidden';
                codeInput.name = 'stp_edit_code';
                codeInput.value = strCode;

                form.appendChild(csrfInput);
                form.appendChild(codeInput);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection