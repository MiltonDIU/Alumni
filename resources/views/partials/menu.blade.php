<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('setting_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.settings.edit") }}" class="nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs">

                            </i>
                            {{ trans('cruds.setting.title') }}
                        </a>
                    </li>
                @endcan

                @can('batch_access')
                    <li class=" nav-item">
                        <a href="{{ route("admin.batches.index") }}" class=" nav-link {{ request()->is("admin/batches") || request()->is("admin/batches/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs  nav-icon">

                            </i>
                            {{ trans('cruds.batch.title') }}
                        </a>
                    </li>
                @endcan
                @can('division_access')
                    <li class=" nav-item">
                        <a href="{{ route("admin.divisions.index") }}" class=" nav-link {{ request()->is("admin/divisions") || request()->is("admin/divisions/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs  nav-icon">

                            </i>
                            {{ trans('cruds.division.title') }}
                        </a>
                    </li>
                @endcan
                @can('district_access')
                    <li class=" nav-item">
                        <a href="{{ route("admin.districts.index") }}" class=" nav-link {{ request()->is("admin/districts") || request()->is("admin/districts/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs  nav-icon">

                            </i>
                            {{ trans('cruds.district.title') }}
                        </a>
                    </li>
                @endcan
                @can('upazila_access')
                    <li class=" nav-item">
                        <a href="{{ route("admin.upazilas.index") }}" class=" nav-link {{ request()->is("admin/upazilas") || request()->is("admin/upazilas/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs  nav-icon">

                            </i>
                            {{ trans('cruds.upazila.title') }}
                        </a>
                    </li>
                @endcan
                @can('union_access')
                    <li class=" nav-item">
                        <a href="{{ route("admin.unions.index") }}" class=" nav-link {{ request()->is("admin/unions") || request()->is("admin/unions/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs  nav-icon">

                            </i>
                            {{ trans('cruds.union.title') }}
                        </a>
                    </li>
                @endcan
                @can('field_of_work_access')
                    <li class=" nav-item">
                        <a href="{{ route("admin.field-of-works.index") }}" class=" nav-link {{ request()->is("admin/field-of-works") || request()->is("admin/field-of-works/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs  nav-icon">

                            </i>
                            {{ trans('cruds.fieldOfWork.title') }}
                        </a>
                    </li>
                @endcan
                @can('designation_access')
                    <li class=" nav-item">
                        <a href="{{ route("admin.designations.index") }}" class=" nav-link {{ request()->is("admin/designations") || request()->is("admin/designations/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs  nav-icon">

                            </i>
                            {{ trans('cruds.designation.title') }}
                        </a>
                    </li>
                @endcan
                @can('organization_access')
                    <li class=" nav-item">
                        <a href="{{ route("admin.organizations.index") }}" class=" nav-link {{ request()->is("admin/organizations") || request()->is("admin/organizations/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs  nav-icon">

                            </i>
                            {{ trans('cruds.organization.title') }}
                        </a>
                    </li>
                @endcan
                @can('school_access')
                    <li class=" nav-item">
                        <a href="{{ route("admin.schools.index") }}" class=" nav-link {{ request()->is("admin/schools") || request()->is("admin/schools/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs  nav-icon">

                            </i>
                            {{ trans('cruds.school.title') }}
                        </a>
                    </li>
                @endcan
                @can('work_access')
                    <li class=" nav-item">
                        <a href="{{ route("admin.works.index") }}" class=" nav-link {{ request()->is("admin/works") || request()->is("admin/works/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs  nav-icon">

                            </i>
                            {{ trans('cruds.work.title') }}
                        </a>
                    </li>
                @endcan
                @can('address_access')
                    <li class=" nav-item">
                        <a href="{{ route("admin.addresses.index") }}" class=" nav-link {{ request()->is("admin/addresses") || request()->is("admin/addresses/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs  nav-icon">

                            </i>
                            {{ trans('cruds.address.title') }}
                        </a>
                    </li>
                @endcan
                @can('event_category_access')
                    <li class=" nav-item">
                        <a href="{{ route("admin.event-categories.index") }}" class=" nav-link {{ request()->is("admin/event-categories") || request()->is("admin/event-categories/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs  nav-icon">

                            </i>
                            {{ trans('cruds.eventCategory.title') }}
                        </a>
                    </li>
                @endcan
                @can('event_access')
                    <li class=" nav-item">
                        <a href="{{ route("admin.events.index") }}" class=" nav-link {{ request()->is("admin/events") || request()->is("admin/events/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-cogs  nav-icon">

                            </i>
                            {{ trans('cruds.event.title') }}
                        </a>
                    </li>
                @endcan




{{--                @can('social_access')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route("admin.socials.index") }}" class="nav-link {{ request()->is("admin/socials") || request()->is("admin/socials/*") ? "c-active" : "" }}">--}}
{{--                            <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                            </i>--}}
{{--                            {{ trans('cruds.social.title') }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                        <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
