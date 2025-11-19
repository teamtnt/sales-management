@extends('sales-management::layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800">Lead Activities</h1>
                <p class="text-muted mb-0">Track and manage all lead activities in one place</p>
            </div>
        </div>

        <!-- Filters Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">
                        <i class="fas fa-filter me-2"></i>Filters
                    </h5>
                    <button class="btn btn-sm btn-link text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="true">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            </div>
            <div class="collapse show" id="filterCollapse">
                <div class="card-body">
                    <div class="row g-3 align-items-end">
                        @if($canViewAllActivities ?? false)
                            <div class="col-md-3">
                                <label for="owner_filter" class="form-label fw-semibold">
                                    <i class="fas fa-user text-muted me-1"></i>Activity Owner
                                </label>
                                <select id="owner_filter" class="form-select">
                                    <option value="">All Users</option>
                                    @foreach(($users ?? []) as $userId => $userName)
                                        <option value="{{ $userId }}">
                                            {{ $userName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        
                        <div class="col-md-3">
                            <label for="date_from" class="form-label fw-semibold">
                                <i class="fas fa-calendar-alt text-muted me-1"></i>Date From
                            </label>
                            <input type="date" id="date_from" class="form-control">
                        </div>
                        
                        <div class="col-md-3">
                            <label for="date_to" class="form-label fw-semibold">
                                <i class="fas fa-calendar-alt text-muted me-1"></i>Date To
                            </label>
                            <input type="date" id="date_to" class="form-control">
                        </div>
                        
                        <div class="col-md-3">
                            <div class="d-grid gap-2">
                                <button type="button" id="apply-filters-btn" class="btn btn-primary">
                                    <i class="fas fa-search me-1"></i>Apply Filters
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" id="my-today-btn" class="btn btn-success btn-sm">
                                        <i class="fas fa-calendar-day me-1"></i>My Today
                                    </button>
                                    <button type="button" id="clear-filters-btn" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-times me-1"></i>Clear
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'table table-hover table-striped align-middle mb-0'], true) !!}
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Modern Card Styling */
        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            border-radius: 12px 12px 0 0 !important;
        }

        /* Form Controls */
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e0e6ed;
            padding: 0.625rem 0.875rem;
            transition: all 0.2s ease-in-out;
        }

        .form-control:focus, .form-select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.625rem 1.25rem;
            transition: all 0.2s ease-in-out;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            box-shadow: 0 4px 6px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border: none;
            box-shadow: 0 3px 5px rgba(17, 153, 142, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 10px rgba(17, 153, 142, 0.4);
        }

        /* Table Enhancements */
        .table {
            font-size: 0.9rem;
        }

        .table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border: none;
            padding: 1rem 0.75rem;
            white-space: nowrap;
        }

        .table tbody tr {
            transition: all 0.2s ease-in-out;
        }

        .table tbody tr:hover {
            background-color: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .table tbody td {
            padding: 0.875rem 0.75rem;
            vertical-align: middle;
            border-color: #f0f2f5;
        }

        /* Links */
        .table a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease-in-out;
        }

        .table a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Icons */
        .table i.fa-check-circle {
            font-size: 1.25rem;
        }

        .table i.fa-times-circle {
            font-size: 1.25rem;
        }

        /* Labels */
        .form-label {
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            color: #4a5568;
        }

        /* DataTables specific */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            padding: 1rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 8px;
            border: 1px solid #e0e6ed;
            padding: 0.5rem 1rem;
            margin-left: 0.5rem;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e0e6ed;
            padding: 0.375rem 2rem 0.375rem 0.75rem;
            margin: 0 0.5rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 6px;
            padding: 0.5rem 0.875rem;
            margin: 0 0.125rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            color: white !important;
        }

        /* Page Header */
        .h3 {
            font-weight: 700;
            color: #2d3748;
        }

        .text-gray-800 {
            color: #2d3748 !important;
        }

        /* Shadow Utilities */
        .shadow-sm {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
        }

        /* Collapse Icon Animation */
        [data-bs-toggle="collapse"] i {
            transition: transform 0.3s ease-in-out;
        }

        [data-bs-toggle="collapse"][aria-expanded="true"] i {
            transform: rotate(180deg);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .table {
                font-size: 0.8rem;
            }
            
            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
        }
    </style>
@endsection

@push('scripts')
    {!! $dataTable->scripts(attributes: ['type' => 'module']) !!}
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                // Get the DataTable instance
                var table = $('#lead-activity-table').DataTable();
                
                // Store the original ajax URL
                var baseUrl = '{{ route("teamtnt.sales-management.lead-activities.index") }}';
                
                // Apply filters button
                document.getElementById('apply-filters-btn').addEventListener('click', function() {
                    var ownerFilter = document.getElementById('owner_filter') ? document.getElementById('owner_filter').value : '';
                    var dateFrom = document.getElementById('date_from') ? document.getElementById('date_from').value : '';
                    var dateTo = document.getElementById('date_to') ? document.getElementById('date_to').value : '';
                    
                    // Build new URL with parameters
                    var params = new URLSearchParams();
                    if (ownerFilter) params.set('owner_filter', ownerFilter);
                    if (dateFrom) params.set('date_from', dateFrom);
                    if (dateTo) params.set('date_to', dateTo);
                    
                    var newUrl = baseUrl + (params.toString() ? '?' + params.toString() : '');
                    
                    // Update URL and reload
                    table.ajax.url(newUrl).load();
                });
                
                // My Activities Today button
                document.getElementById('my-today-btn').addEventListener('click', function() {
                    const today = new Date().toISOString().split('T')[0];
                    
                    document.getElementById('date_from').value = today;
                    document.getElementById('date_to').value = today;
                    
                    const ownerFilter = document.getElementById('owner_filter');
                    if (ownerFilter) {
                        ownerFilter.value = '{{ auth()->id() }}';
                    }
                    
                    // Build new URL with parameters
                    var params = new URLSearchParams();
                    params.set('owner_filter', '{{ auth()->id() }}');
                    params.set('date_from', today);
                    params.set('date_to', today);
                    params.set('my_today', '1');
                    
                    var newUrl = baseUrl + '?' + params.toString();
                    
                    // Update URL and reload
                    table.ajax.url(newUrl).load();
                });
                
                // Clear filters button
                document.getElementById('clear-filters-btn').addEventListener('click', function() {
                    const ownerFilter = document.getElementById('owner_filter');
                    if (ownerFilter) {
                        ownerFilter.value = '';
                    }
                    document.getElementById('date_from').value = '';
                    document.getElementById('date_to').value = '';
                    
                    // Reset to base URL without parameters
                    table.ajax.url(baseUrl).load();
                });
            }, 100);
        });
    </script>
@endpush
