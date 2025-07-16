@extends('layouts.app')

@section('title', 'Wall - Stampede')

@if (session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative">
        <strong>{{ session('success') }}</strong>
        @if (session('edit_code'))
            <div class="mt-2 text-sm">
                Your stamp edit/delete code is:
                <span class="font-mono bg-white border px-2 py-1 rounded select-all" id="editCode">
                    {{ session('edit_code') }}
                </span>
                <button onclick="copyCode()" class="ml-2 text-blue-600 underline hover:text-blue-800">
                    Copy
                </button>
            </div>
        @endif
    </div>

    <script>
        function copyCode() {
            const text = document.getElementById('editCode').innerText;
            navigator.clipboard.writeText(text)
                .then(() => alert('Code copied!'))
                .catch(() => alert('Failed to copy code.'));
        }
    </script>
@endif


@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-dost-dark mb-2">Digital Bulletin Board</h2>
            <p class="text-gray-600">Share your thoughts and connect with others</p>
        </div>

        <div id="stamps-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($arrStamps as $stamp)
                @include('partials.stamp-card', ['stamp' => $stamp])
            @endforeach
        </div>

        @if($arrStamps->hasMorePages())
            <div class="text-center mt-8">
                <button id="load-more-btn" class="bg-dost-blue text-white px-6 py-3 rounded hover:bg-blue-600 transition">
                    Load More Stamps
                </button>
            </div>
        @endif

        <div id="loading" class="hidden text-center mt-8">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-dost-blue"></div>
            <p class="mt-2 text-gray-600">Loading more stamps...</p>
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
                                <div class="stamp-card ${strColorClass} rounded-lg shadow-md p-6 border-2 border-dost-dark transform hover:scale-105 transition-transform duration-200">
                                    <div class="stamp-header mb-4">
                                        <div class="text-sm font-semibold text-dost-dark">
                                            To: ${stamp.stp_to}
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            From: ${stamp.stp_from}
                                        </div>
                                    </div>

                                    <div class="stamp-message mb-4">
                                        <p class="text-dost-dark leading-relaxed">${stamp.stp_message}</p>
                                    </div>

                                    <div class="stamp-footer flex justify-between items-center text-xs text-gray-500">
                                        <span>${strDate}</span>
                                        <div class="flex space-x-2">
                                            <a href="/edit-stamp/${stamp.stp_id}" class="text-dost-blue hover:underline">Edit</a>
                                            <button onclick="showDeleteModal(${stamp.stp_id})" class="text-red-500 hover:underline">Delete</button>
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