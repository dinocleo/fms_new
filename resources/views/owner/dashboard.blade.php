@extends('owner.layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-content-wrapper bg-white p-30 radius-20">
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="page-title-box d-flex flex-column flex-sm-row align-items-sm-center justify-content-between g-20">
                                <div class="page-title-left">
                                    <h2 class="mb-sm-0">{{ __('Dashboard') }}</h2>
                                    <p>{{ __('Welcome back') }}, {{ auth()->user()->name }} <span class="iconify font-24"
                                            data-icon="openmoji:waving-hand"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="row">
                        <!-- Existing Cards -->
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-20 mb-25">
                                <div
                                    class="dashboard-feature-item-icon-wrap font-20 d-flex align-items-center justify-content-center bg-white radius-4">
                                    <span class="iconify orange-color" data-icon="bxs:home-circle"></span>
                                </div>
                                <p class="mt-2">{{ __('Total Property') }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <h2>{{ $totalProperties }}</h2>
                                    <!-- View All link -->
                                    <a class="theme-link font-14 font-medium d-flex align-items-center"
                                        href="{{ route('owner.property.allProperty') }}">
                                        {{ __('View All') }}<i class="ri-arrow-right-line ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-20 mb-25">
                                <div
                                    class="dashboard-feature-item-icon-wrap font-20 d-flex align-items-center justify-content-center bg-white radius-4">
                                    <span class="iconify blue-color" data-icon="ri-folder-chart-line"></span>
                                </div>
                                <p class="mt-2">{{ __('Total Assets') }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <h2>12</h2>
                                    <!-- View All link -->
                                    {{--                                    <a class="theme-link font-14 font-medium d-flex align-items-center" --}}
                                    {{--                                       href="{{ route('owner.ticket.index') }}"> --}}
                                    {{--                                        {{ __('View All') }}<i class="ri-arrow-right-line ms-2"></i> --}}
                                    {{--                                    </a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-20 mb-25">
                                <div
                                    class="dashboard-feature-item-icon-wrap font-20 d-flex align-items-center justify-content-center bg-white radius-4">
                                    <span class="iconify orange-color" data-icon="bi:bar-chart-line-fill"></span>
                                </div>
                                <p class="mt-2">{{ __('Total Tenants') }}</p>
                                <h2 class="mt-1">{{ $totalTenants }}</h2>
                            </div>
                        </div>

                        <!-- New Cards for Additional Summaries -->
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-20 mb-25">
                                <div
                                    class="dashboard-feature-item-icon-wrap font-20 d-flex align-items-center justify-content-center bg-white radius-4">
                                    <span class="iconify blue-color" data-icon="ri-folder-chart-line"></span>
                                </div>
                                <p class="mt-2">{{ __('Total Ticket') }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <h2>12</h2>
                                    <!-- View All link -->
                                    <a class="theme-link font-14 font-medium d-flex align-items-center"
                                        href="{{ route('owner.ticket.index') }}">
                                        {{ __('View All') }}<i class="ri-arrow-right-line ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-20 mb-25">
                                <div
                                    class="dashboard-feature-item-icon-wrap font-20 d-flex align-items-center justify-content-center bg-white radius-4">
                                    <span class="iconify yellow-color" data-icon="ri-group-line"></span>
                                </div>
                                <p class="mt-2">{{ __('Total Contracts') }}</p>
                                <h2 class="mt-1">15</h2>
                            </div>
                        </div> --}}
                    </div>


                    <div class="row">
                        <!-- Utility Usage Trends -->
                        <div class="col-12 col-lg-6 col-xl-6">
                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-15 mb-15"
                                style="border: 1px solid #ddd; padding: 15px; border-radius: 4px; background: #f9f9f9;">
                                <div
                                    class="dashboard-feature-item-icon-wrap font-20 d-flex align-items-center justify-content-center bg-white radius-4">
                                    <span class="iconify purple-color" data-icon="ri-flashlight-line"></span>
                                </div>
                                <div class="mt-2">
                                    <h4 class="mb-0">{{ __('Utility Usage Trends') }}</h4>
                                </div>
                                <div>
                                    <canvas id="utilitiesChart"></canvas>
                                </div>
                            </div>
                        </div>


                        <!-- Assets Management Summary -->
                        <div class="col-12 col-lg-6 col-xl-6">
                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-15 mb-15"
                                style="border: 1px solid #ddd; padding: 15px; border-radius: 4px; background: #f9f9f9;">
                                {{--                                <div class="dashboard-properties-table bg-off-white theme-border p-20 radius-4 mb-25"> --}}
                                <div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-flex align-items-center justify-content-between mb-25">
                                                <h4 class="mb-0">{{ __('My Properties') }}</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add a canvas for the bar chart -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="chart-container">
                                                <canvas id="propertiesBarChart"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <a class="theme-link font-14 font-medium d-flex align-items-center justify-content-center mt-20"
                                            href="{{ route('owner.property.allProperty') }}">
                                            {{ __('View All') }}<i class="ri-arrow-right-line ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{--                        <div class="col-12 col-lg-6 col-xl-6"> --}}
                        {{--                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-15 mb-15" style="border: 1px solid #ddd; padding: 15px; border-radius: 4px; background: #f9f9f9;"> --}}
                        {{--                                <div class="dashboard-feature-item-icon-wrap font-20 d-flex align-items-center justify-content-center bg-white radius-4"> --}}
                        {{--                                    <span class="iconify green-color" data-icon="ri-building-line"></span> --}}
                        {{--                                </div> --}}
                        {{--                                <div class="mt-2"> --}}
                        {{--                                    <h4 class="mb-0">{{ __('Assets Management') }}</h4> --}}
                        {{--                                </div> --}}
                        {{--                                <div class="mt-2 text-center"> --}}
                        {{--                                    <h5>Total Assets: <span class="text-success">220</span></h5> <!-- Example total assets count --> --}}
                        {{--                                </div> --}}
                        {{--                                <div> --}}
                        {{--                                    <canvas id="assetsChart" height="180"></canvas> <!-- Adjusted height --> --}}
                        {{--                                </div> --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}


                        <!-- Property & Assets Maintenance Summary -->
                        <div class="col-12 col-lg-6 col-xl-6">
                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-15 mb-15"
                                style="border: 1px solid #ddd; padding: 15px; border-radius: 4px; background: #f9f9f9;">
                                <div
                                    class="dashboard-feature-item-icon-wrap font-20 d-flex align-items-center justify-content-center bg-white radius-4">
                                    <span class="iconify blue-color" data-icon="ri-tools-line"></span>
                                </div>
                                <div class="mt-2">
                                    <h4 class="mb-0">{{ __('Maintenance') }}</h4>
                                </div>
                                <div>
                                    <canvas id="maintenanceChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Project Management Summary -->
                        <div class="col-12 col-lg-6 col-xl-6">
                            <div class="dashboard-feature-item bg-off-white theme-border radius-4 p-15 mb-15"
                                style="border: 1px solid #ddd; padding: 15px; border-radius: 4px; background: #f9f9f9;">
                                <div
                                    class="dashboard-feature-item-icon-wrap font-20 d-flex align-items-center justify-content-center bg-white radius-4">
                                    <span class="iconify red-color" data-icon="ri-projector-line"></span>
                                </div>
                                <div class="mt-2">
                                    <h4 class="mb-0">{{ __('Project Status') }}</h4>
                                </div>
                                <div>
                                    <canvas id="projectsChart"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Additional Tables or Summaries -->
                    <div class="row">
                        @can('Manage Property')
                            {{--                            <div class="col-lg-7"> --}}
                            {{--                                <div class="dashboard-properties-table bg-off-white theme-border p-20 radius-4 mb-25"> --}}
                            {{--                                    <div> --}}
                            {{--                                        <div class="row align-items-center"> --}}
                            {{--                                            <div class="col-12"> --}}
                            {{--                                                <div class="d-flex align-items-center justify-content-between mb-25"> --}}
                            {{--                                                    <h4 class="mb-0">{{ __('My Properties') }}</h4> --}}
                            {{--                                                </div> --}}
                            {{--                                            </div> --}}
                            {{--                                        </div> --}}

                            {{--                                        <!-- Add a canvas for the bar chart --> --}}
                            {{--                                        <div class="row"> --}}
                            {{--                                            <div class="col-12"> --}}
                            {{--                                                <div class="chart-container"> --}}
                            {{--                                                    <canvas id="propertiesBarChart"></canvas> --}}
                            {{--                                                </div> --}}
                            {{--                                            </div> --}}
                            {{--                                        </div> --}}

                            {{--                                        <div> --}}
                            {{--                                            <a class="theme-link font-14 font-medium d-flex align-items-center justify-content-center mt-20" --}}
                            {{--                                               href="{{ route('owner.property.allProperty') }}"> --}}
                            {{--                                                {{ __('View All') }}<i class="ri-arrow-right-line ms-2"></i> --}}
                            {{--                                            </a> --}}
                            {{--                                        </div> --}}
                            {{--                                    </div> --}}
                            {{--                                </div> --}}
                            {{--                            </div> --}}

                            {{--                            <div class="col-lg-7"> --}}
                            {{--                                <div class="dashboard-properties-table bg-off-white theme-border p-20 radius-4 mb-25"> --}}
                            {{--                                    <div class=""> --}}
                            {{--                                        <div class="row align-items-center"> --}}
                            {{--                                            <div class="col-12"> --}}
                            {{--                                                <div class="d-flex align-items-center justify-content-between mb-25"> --}}
                            {{--                                                    <h4 class="mb-0">{{ __('My Properties') }}</h4> --}}
                            {{--                                                </div> --}}
                            {{--                                            </div> --}}
                            {{--                                        </div> --}}
                            {{--                                        <div class="row"> --}}
                            {{--                                            <div class="col-12"> --}}
                            {{--                                                <div class="table-responsive"> --}}
                            {{--                                                    <table class="table theme-border p-20"> --}}
                            {{--                                                        <thead> --}}
                            {{--                                                            <tr> --}}
                            {{--                                                                <th>{{ __('Name') }}</th> --}}
                            {{--                                                                <th>{{ __('Units') }}</th> --}}
                            {{--                                                                <th>{{ __('Available Unit') }}</th> --}}
                            {{--                                                                <th>{{ __('Tenants') }}</th> --}}
                            {{--                                                                <th>{{ __('Maintainer') }}</th> --}}
                            {{--                                                            </tr> --}}
                            {{--                                                        </thead> --}}
                            {{--                                                        <tbody> --}}
                            {{--                                                            @forelse ($properties as $property) --}}
                            {{--                                                                <tr> --}}
                            {{--                                                                    <td> --}}
                            {{--                                                                        <h6 class="theme-text-color">{{ $property->name }}</h6> --}}
                            {{--                                                                        <p class="font-13">{{ $property->address }}</p> --}}
                            {{--                                                                    </td> --}}
                            {{--                                                                    <td>{{ $property->number_of_unit }}</td> --}}
                            {{--                                                                    <td>{{ $property->number_of_unit - $property->total_tenant }} --}}
                            {{--                                                                    </td> --}}
                            {{--                                                                    <td>{{ $property->total_tenant }}</td> --}}
                            {{--                                                                    <td>{{ $property->total_maintainers }}</td> --}}
                            {{--                                                                </tr> --}}
                            {{--                                                            @empty --}}
                            {{--                                                                <tr> --}}
                            {{--                                                                    <td class="text-center">{{ __('No data found') }}</td> --}}
                            {{--                                                                </tr> --}}
                            {{--                                                            @endforelse --}}
                            {{--                                                        </tbody> --}}
                            {{--                                                    </table> --}}
                            {{--                                                    <div> --}}
                            {{--                                                        <a class="theme-link font-14 font-medium d-flex align-items-center justify-content-center mt-20" --}}
                            {{--                                                            href="{{ route('owner.property.allProperty') }}"> --}}
                            {{--                                                            {{ __('View All') }}<i class="ri-arrow-right-line ms-2"></i> --}}
                            {{--                                                        </a> --}}
                            {{--                                                    </div> --}}
                            {{--                                                </div> --}}
                            {{--                                            </div> --}}
                            {{--                                        </div> --}}
                            {{--                                    </div> --}}
                            {{--                                </div> --}}
                            {{--                            </div> --}}
                        @endcan

                        {{--                        @if (isAddonInstalled('PROTYSAAS') < 1 || ownerCurrentPackage(getOwnerUserId())?->ticket_support == ACTIVE) --}}
                        {{--                            <div class="col-lg-5"> --}}
                        {{--                                @can('Manage Ticket') --}}
                        {{--                                    <div class="dashboard-properties-table bg-off-white theme-border p-20 radius-4 mb-25"> --}}
                        {{--                                        <div class=""> --}}
                        {{--                                            <div class="row align-items-center"> --}}
                        {{--                                                <div class="col-12"> --}}
                        {{--                                                    <div class="d-flex align-items-center justify-content-between mb-25"> --}}
                        {{--                                                        <h4 class="mb-0">{{ __('Tickets') }}</h4> --}}
                        {{--                                                        <div> --}}
                        {{--                                                            <a class="theme-link font-14 font-medium d-flex align-items-center justify-content-center" --}}
                        {{--                                                                href="{{ route('owner.ticket.index') }}"> --}}
                        {{--                                                                {{ __('View All') }}<i class="ri-arrow-right-line ms-2"></i> --}}
                        {{--                                                            </a> --}}
                        {{--                                                        </div> --}}
                        {{--                                                    </div> --}}
                        {{--                                                </div> --}}
                        {{--                                            </div> --}}
                        {{--                                            <div class="row"> --}}
                        {{--                                                <div class="col-12"> --}}
                        {{--                                                    <div class="table-responsive"> --}}
                        {{--                                                        <table class="table theme-border p-20"> --}}
                        {{--                                                            <tbody> --}}
                        {{--                                                                @forelse ($tickets as $ticket) --}}
                        {{--                                                                    <tr> --}}
                        {{--                                                                        <td> --}}
                        {{--                                                                            <div class="d-flex align-items-center"> --}}
                        {{--                                                                                <div class="flex-shrink-0"> --}}
                        {{--                                                                                    <div --}}
                        {{--                                                                                        class="h-36 w-36 overflow-hidden radius-50"> --}}
                        {{--                                                                                        <img src="{{ $ticket->user?->image }}" --}}
                        {{--                                                                                            alt="" --}}
                        {{--                                                                                            class="img-fluid h-36"> --}}
                        {{--                                                                                    </div> --}}
                        {{--                                                                                </div> --}}
                        {{--                                                                                <div class="flex-grow-1 ms-3"> --}}
                        {{--                                                                                    <h6>{{ Str::limit($ticket->title, 25, '...') }} --}}
                        {{--                                                                                    </h6> --}}
                        {{--                                                                                    <div> --}}
                        {{--                                                                                        <a href="{{ route('owner.ticket.details', $ticket->id) }}" --}}
                        {{--                                                                                            class="primary-color font-13 me-2">{{ Str::limit($ticket->topic->name, 25, '...') }}</a> --}}
                        {{--                                                                                        <span href="#" --}}
                        {{--                                                                                            class="orange-color font-13 me-2">{{ __('Issue') }}</span> --}}
                        {{--                                                                                    </div> --}}
                        {{--                                                                                </div> --}}
                        {{--                                                                            </div> --}}
                        {{--                                                                        </td> --}}
                        {{--                                                                    </tr> --}}
                        {{--                                                                @empty --}}
                        {{--                                                                    <tr> --}}
                        {{--                                                                        <td class="text-center">{{ __('No data found') }}</td> --}}
                        {{--                                                                    </tr> --}}
                        {{--                                                                @endforelse --}}
                        {{--                                                            </tbody> --}}
                        {{--                                                        </table> --}}
                        {{--                                                    </div> --}}
                        {{--                                                </div> --}}
                        {{--                                            </div> --}}
                        {{--                                        </div> --}}
                        {{--                                    </div> --}}
                        {{--                                @endcan --}}
                        {{--                            </div> --}}
                        {{--                        @endif --}}
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const MONTHS = @json($months);
        const INVOICEMONTLYAMOUNT = @json($invoiceMonthlyAmount);
    </script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/index-charts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Utility Usage Chart
            var ctx1 = document.getElementById('utilitiesChart').getContext('2d');
            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12], // Months
                    datasets: [{
                            label: 'Electricity Usage',
                            data: [234000, 256779, 389999, 289378, 367377.5, 397312.9, 427248.3,
                                457183.7, 487119.1, 517054.5, 546989.9, 576925.3
                            ],
                            borderColor: 'blue',
                            borderWidth: 2,
                            fill: false
                        },
                        {
                            label: 'Fuel Usage',
                            data: [200000, 230000, 150000, 200000, 230000, 150000, 173333.33,
                                167619.0476, 161904.7619, 156190.4762, 150476.1905, 144761.9048
                            ],
                            borderColor: 'orange',
                            borderWidth: 2,
                            fill: false
                        },
                        {
                            label: 'Water Usage',
                            data: [100000, 110000, 120000, 100000, 110000, 120000, 100000, 110000,
                                120000, 100000, 110000, 120000
                            ],
                            borderColor: 'gray',
                            borderWidth: 2,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Assets Management Chart
            // var ctx2 = document.getElementById('assetsChart').getContext('2d');
            // new Chart(ctx2, {
            //     type: 'bar',
            //     data: {
            //         labels: ['Buildings', 'Vehicles', 'Machinery', 'Furniture', 'Electronics'],
            //         datasets: [{
            //             label: 'Total Assets',
            //             data: [15, 8, 12, 20, 10], // Example asset counts
            //             backgroundColor: ['#4CAF50', '#FF9800', '#3F51B5', '#E91E63', '#009688']
            //         }]
            //     },
            //     options: {
            //         responsive: true,
            //         maintainAspectRatio: false,
            //         scales: {
            //             y: {
            //                 beginAtZero: true
            //             }
            //         }
            //     }
            // });

            // Property & Assets Maintenance Chart
            var ctx3 = document.getElementById('maintenanceChart').getContext('2d');
            new Chart(ctx3, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'Pending', 'Overdue'],
                    datasets: [{
                        label: 'Maintenance Tasks',
                        data: [30, 10, 5], // Example maintenance task counts
                        backgroundColor: ['#2E7D32', '#FFC107', '#D32F2F']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Project Management Chart
            var ctx4 = document.getElementById('projectsChart').getContext('2d');
            new Chart(ctx4, {
                type: 'pie',
                data: {
                    labels: ['Completed', 'In Progress', 'Pending', 'Overdue'],
                    datasets: [{
                        label: 'Projects',
                        data: [10, 5, 3, 2], // Example project counts
                        backgroundColor: ['#4CAF50', '#FFC107', '#FF9800', '#D32F2F']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
    <script>
        // Prepare data from your properties
        var propertiesData = @json($properties);

        // Extract data for the chart
        var propertyNames = propertiesData.map(property => property.name);
        var unitCounts = propertiesData.map(property => property.number_of_unit);
        var tenantCounts = propertiesData.map(property => property.total_tenant);

        // Create the chart
        var ctx = document.getElementById('propertiesBarChart').getContext('2d');
        var propertiesBarChart = new Chart(ctx, {
            type: 'bar', // Type of chart
            data: {
                labels: propertyNames, // Property names on the x-axis
                datasets: [{
                        label: 'Total Units',
                        data: unitCounts, // Units for each property
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Blue color
                        borderColor: 'rgba(54, 162, 235, 1)', // Blue border color
                        borderWidth: 1
                    },
                    {
                        label: 'Total Tenants',
                        data: tenantCounts, // Tenants for each property
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Red color
                        borderColor: 'rgba(255, 99, 132, 1)', // Red border color
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
