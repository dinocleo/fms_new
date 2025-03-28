<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="{{ route('owner.dashboard') }}">
                        <i class="ri-dashboard-line"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
                @can('Manage Property')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-building-line"></i>
                            <span>{{ __('Estate Portfolio') }}</span>
                        </a>
                        <ul class="sub-menu {{ @$navPropertyMMShowClass }}" aria-expanded="false">
                            <li class="{{ @$subNavAllPropertyMMActiveClass }}">
                                <a href="{{ route('owner.property.allProperty') }}"
                                    class="{{ @$subNavAllPropertyActiveClass }}">{{ __('Commercial') }}</a>
                            </li>

                            <li class="{{ request()->routeIs('nonCommercial') ? 'active' : '' }}">
                                <a href="{{ route('owner.property.nonCommercial') }}"
                                    class="{{ @$subNavNonCommercialActiveClass }}">{{ __('Non-Commercial') }}</a>
                            </li>


                            {{-- <li class="{{ @$subNavAllUnitMMActiveClass }}">
                                <a href="{{ route('owner.property.allUnit') }}"
                                    class="{{ @$subNavAllUnitActiveClass }}">{{ __('All Unit') }}</a>
                            </li> --}}
                            {{-- <li class="{{ @$subNavOwnPropertyActiveClass }}">
                                <a href="{{ route('owner.property.ownProperty') }}"
                                    class="{{ @$subNavOwnPropertyActiveClass }}">{{ __('Own Property') }}</a>
                            </li>
                            <li class="{{ @$subNavLeasePropertyActiveClass }}">
                                <a href="{{ route('owner.property.leaseProperty') }}"
                                    class="{{ @$subNavLeasePropertyActiveClass }}">{{ __('Lease Property') }}</a>
                            </li> --}}
                        </ul>
                    </li>
                @endcan

                @can('Manage Asset')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-folder-chart-line"></i>
                            <span>{{ __('Asset Management') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li>
                                <a href="{{ route('owner.assets.getList') }}">{{ __('All Assets') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('owner.assets.replacement.replacement') }}">{{ __('Replacement') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('owner.assets.dispose') }}">{{ __('Dispose') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('owner.assets.category.index') }}">{{ __('Category') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('owner.assets.vendor.index') }}">{{ __('Vendor') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('owner.assets.manufacturer') }}">{{ __('Manufacturer') }}</a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('owner.assets.depreciation_class') }}">{{ __('Depreciation Class') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('owner.assets.condition.index') }}">{{ __('Condition') }}</a>
                            </li>

                            <li>
                                <a href="{{ route('owner.assets.status.index') }}">{{ __('Status') }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan


                @can('Manage Asset')
                    <li>
                        <a href="{{ route('owner.property.energy.index') }}">
                            <i class="ri-flashlight-line"></i>
                            <span>{{ __('Utilities') }}</span>
                        </a>
                    </li>
                @endcan
                @can('Manage Maintains')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-account-circle-line"></i>
                            <span>{{ __('Maintains') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('owner.maintainer.index') }}">{{ __('Maintainers') }}</a></li>
                            <li><a
                                    href="{{ route('owner.maintenance-request.index') }}">{{ __('Maintenance Request') }}</a>
                            </li>

                            <li><a
                                href="{{ route('owner.maintenance-request.preventiveMaintenanceRequest') }}">{{ __('Preventive Maintenance') }}</a>
                        </li>
                        </ul>
                    </li>
                @endcan
                @if (isAddonInstalled('PROTYSAAS') < 1 || ownerCurrentPackage(getOwnerUserId())?->ticket_support == ACTIVE)
                    @can('Manage Ticket')
                        <li>
                            <a href="{{ route('owner.ticket.index') }}">
                                <i class="ri-bookmark-2-line"></i>
                                <span>{{ __('Tickets') }}</span>
                            </a>
                        </li>
                    @endcan
                @endif
                @can('Manage Vendor')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-group-line"></i>
                            <span>{{ __('Contracts') }}</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('owner.property.vendor.index') }}">{{ __('Vendor List') }}</a></li>
                            <li>
                                <a href="{{ route('owner.agreement.index') }}">
                                    <span>{{ __(' Agreement') }}</span> </a>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('Manage Asset')
                    <li>
                        <a href="#" target="_blank">
                            <i class="ri-projector-line"></i> <!-- You can change this icon if you prefer -->
                            <span>{{ __('Project Management') }}</span>
                        </a>
                    </li>
                @endcan

                @can('Manage Asset')
                    <li>
                        <a href="{{ route('owner.property.visitors') }}">
                            <i class="ri-car-line"></i>
                            <span>{{ __('Visitors') }}</span>
                        </a>
                    </li>
                @endcan




                @can('Manage Report')
                    <li>
                        <a href="{{ route('owner.property.fleetManagement') }}">
                            <i class="ri-car-line"></i>
                            <span>{{ __('Fleet Management') }}</span>
                        </a>
                    </li>
                @endcan


                @can('Manage Report')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="ri-folder-chart-line"></i>
                            <span>{{ __('Report') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('owner.reports.earning') }}">{{ __('Earning') }}</a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('owner.reports.loss-profit.by.month') }}">{{ __('Loss / Profit By Month') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('owner.reports.expenses') }}">{{ __('Expenses') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('owner.reports.lease') }}">{{ __('Lease') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('owner.reports.occupancy') }}">{{ __('Occupancy') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('owner.reports.maintenance') }}">{{ __('Maintenance') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('owner.reports.tenant') }}">{{ __('Tenant') }}</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('Manage Team')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.7739 18C21.5232 18 22.1192 17.5285 22.6543 16.8691C23.7498 15.5194 21.9512 14.4408 21.2652 13.9126C20.5679 13.3756 19.7893 13.0714 18.9999 13M17.9999 11C19.3806 11 20.4999 9.88071 20.4999 8.5C20.4999 7.11929 19.3806 6 17.9999 6"
                                        stroke="#737C91" stroke-width="1.5" stroke-linecap="round" />
                                    <path
                                        d="M3.2259 18C2.47659 18 1.88061 17.5285 1.34548 16.8691C0.250031 15.5194 2.04861 14.4408 2.73458 13.9126C3.43191 13.3756 4.21052 13.0714 4.99994 13M5.49994 11C4.11923 11 2.99994 9.88071 2.99994 8.5C2.99994 7.11929 4.11923 6 5.49994 6"
                                        stroke="#737C91" stroke-width="1.5" stroke-linecap="round" />
                                    <path
                                        d="M8.08368 15.1112C7.0619 15.743 4.38286 17.0331 6.01458 18.6474C6.81166 19.436 7.6994 20 8.8155 20H15.1843C16.3004 20 17.1881 19.436 17.9852 18.6474C19.6169 17.0331 16.9379 15.743 15.9161 15.1112C13.52 13.6296 10.4797 13.6296 8.08368 15.1112Z"
                                        stroke="#737C91" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M15.4999 7.5C15.4999 9.433 13.9329 11 11.9999 11C10.0669 11 8.49988 9.433 8.49988 7.5C8.49988 5.567 10.0669 4 11.9999 4C13.9329 4 15.4999 5.567 15.4999 7.5Z"
                                        stroke="#737C91" stroke-width="1.5" />
                                </svg>
                            </i>
                            <span>{{ __('Manage Users') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('owner.role-permission.role-list') }}">{{ __('Role & Permission') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('owner.team-member.index') }}">{{ __('Staff Users') }}</a>

                            </li>


                            {{-- @can('Manage Tenant') --}}

                            <li class="{{ @$subNavAllTenantMMActiveClass }}">
                                <a href="{{ route('owner.tenant.index', ['type' => 'all']) }}"
                                    class="{{ @$subNavAllTenantActiveClass }}">{{ __('All Tenants') }}</a>
                            </li>
                            <li class="{{ @$subNavTenantHistoryMMActiveClass }}">
                                <a href="{{ route('owner.tenant.index', ['type' => 'history']) }}"
                                    class="{{ @$subNavTenantHistoryActiveClass }}">{{ __('Tenant History') }}</a>
                            </li>


                            {{-- @endcan --}}
                        </ul>
                    </li>
                @endcan
                @can('Manage Settings')
                    {{-- <li>
                        <a href="{{ route('owner.setting.gateway.index') }}">
                            <i class="ri-settings-3-line"></i>
                            <span>{{ __('Settings') }}</span>
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('owner.setting.expense-type.index') }}">
                            <i class="ri-settings-3-line"></i>
                            <span>{{ __('Settings') }}</span>
                        </a>
                    </li>
                @endcan

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
