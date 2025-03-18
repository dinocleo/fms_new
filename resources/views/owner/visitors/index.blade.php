@extends('owner.layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-content-wrapper bg-white p-30 radius-20">
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between border-bottom mb-20">
                                <div class="page-title-left">
                                    <h3 class="mb-sm-0">Visitors</h3>
                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('owner.dashboard') }}"
                                                title="{{ __('Dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Visitors</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="property-top-search-bar">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="theme-btn mb-25" data-bs-toggle="modal"
                                    data-bs-target="#visitorModal" data-url="{{ route('owner.property.visitors.create') }}">
                                    {{ __('Add Record') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- 
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif --}}

                    <div class="container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('ID Type') }}</th>
                                    <th>{{ __('Purpose') }}</th>
                                    <th>{{ __('Office / Building') }}</th>
                                    <th>{{ __('Entry Time') }}</th>
                                    <th>{{ __('Visit Date') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visitors as $visitor)
                                    <tr>
                                        <td>{{ $visitor->name }}</td>
                                        <td>{{ $visitor->id_type }}</td>
                                        <td>{{ $visitor->purpose }}</td>
                                        <td>{{ $visitor->office_unit }}</td>
                                        <td>{{ $visitor->entry_time }}</td>
                                        <td>{{ \Carbon\Carbon::parse($visitor->visit_date)->format('d F Y') }}</td>
                                        <td>
                                            <button type="button" class="p-1 tbl-action-btn edit" data-bs-toggle="modal"
                                                data-bs-target="#visitorModal"
                                                data-url="{{ route('owner.property.visitors.edit', $visitor->id) }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('owner.property.visitors.destroy', $visitor->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1 tbl-action-btn">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Visitor Modal -->
    <div class="modal fade" id="visitorModal" tabindex="-1" aria-labelledby="visitorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visitorModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded here via AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="theme-btn btn-sm mb-25" style="background-color: #7f7e7e; color: #ffffff;"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="theme-btn btn-sm mb-25" id="modalSubmitBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    @include('common.layouts.datatable-style')
@endpush

@push('script')
    @include('common.layouts.datatable-script')
    <script src="{{ asset('assets/js/custom/information.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('visitorModal');
            const modalTitle = modal.querySelector('.modal-title');
            const modalBody = modal.querySelector('.modal-body');
            const modalSubmitBtn = document.getElementById('modalSubmitBtn');

            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-url');

                // Load content via AJAX
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        modalBody.innerHTML = html;
                        modalTitle.textContent = button.classList.contains('edit') ? 'Edit Visitor' :
                            'Add New Visitor';

                        // Re-attach any scripts from the loaded content
                        const scripts = modalBody.querySelectorAll('script');
                        scripts.forEach(oldScript => {
                            const newScript = document.createElement('script');
                            if (oldScript.src) {
                                newScript.src = oldScript.src;
                            } else {
                                newScript.textContent = oldScript.textContent;
                            }
                            document.body.appendChild(newScript).parentNode.removeChild(
                                newScript);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            });

            modalSubmitBtn.addEventListener('click', function() {
                const form = modalBody.querySelector('form');
                if (form) {
                    form.submit();
                }
            });
        });
    </script>
@endpush





