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


                            <li class="{{ @$subNavAllUnitMMActiveClass }}">
                                <a href="{{ route('owner.property.allUnit') }}"
                                    class="{{ @$subNavAllUnitActiveClass }}">{{ __('All Unit') }}</a>
                            </li>
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
                            <a href="{{ route('owner.assets.replacement') }}">{{ __('Replacement') }}</a>
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
                            <a href="{{ route('owner.assets.depreciation_class') }}">{{ __('Depreciation Class') }}</a>
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
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
