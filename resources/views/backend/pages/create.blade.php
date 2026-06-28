@extends('backend.layout.template')

@section('title')
    Create Role
@endsection

@section('page_subtitle')
    Create new role and assign permissions
@endsection

@section('body-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Create Role</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.role.store') }}" method="post">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label">Role Name <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                    name="name" value="{{ old('name') }}" id="name" placeholder="Enter role name"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                                    <label class="form-label m-0">Permissions</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" value="1"
                                            id="checkPermissionAll">
                                        <label class="form-check-label fw-bold" for="checkPermissionAll">Select All</label>
                                    </div>
                                </div>
                                <hr class="my-3">

                                @foreach ($permission_groups as $permission_group)
                                    @php
                                        $groupIndex = $loop->iteration;
                                        $permissions = App\Models\User::getpermissionsByGroupName(
                                            $permission_group->name,
                                        );
                                    @endphp
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="{{ $groupIndex }}Management"
                                                    onclick="checkPermissionByGroup('role-{{ $groupIndex }}-management-checkbox', this)">
                                                <label class="form-check-label fw-bold" for="{{ $groupIndex }}Management">
                                                    {{ $permission_group->name }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-9 role-{{ $groupIndex }}-management-checkbox">
                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="form-check mb-2">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="permissions[]" value="{{ $permission->name }}"
                                                                id="checkPermission{{ $permission->id }}"
                                                                onclick="checkSinglePermission('role-{{ $groupIndex }}-management-checkbox', '{{ $groupIndex }}Management', {{ count($permissions) }})">
                                                            <label class="form-check-label"
                                                                for="checkPermission{{ $permission->id }}">
                                                                {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                                    <i data-feather="arrow-left" class="me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i data-feather="save" class="me-1"></i> Save Role
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#checkPermissionAll').click(function() {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').prop('checked', true);
            } else {
                $('input[type=checkbox]').prop('checked', false);
            }
        });

        function checkPermissionByGroup(className, checkThis) {
            const groupIdName = $("#" + checkThis.id);
            const classCheckBox = $('.' + className + ' input');
            if (groupIdName.is(':checked')) {
                classCheckBox.prop('checked', true);
            } else {
                classCheckBox.prop('checked', false);
            }
            implementAllChecked();
        }

        function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
            const classCheckbox = $('.' + groupClassName + ' input');
            const groupIDCheckbox = $('#' + groupID);

            if ($('.' + groupClassName + ' input:checked').length == countTotalPermission) {
                groupIDCheckbox.prop('checked', true);
            } else {
                groupIDCheckbox.prop('checked', false);
            }
            implementAllChecked();
        }

        function implementAllChecked() {
            const countPermissions = {{ count($all_permissions) }};
            const countPermissionGroup = {{ count($permission_groups) }};

            if ($('input[type=checkbox]:checked').length >= countPermissions + countPermissionGroup) {
                $('#checkPermissionAll').prop('checked', true);
            } else {
                $('#checkPermissionAll').prop('checked', false);
            }
        }
    </script>
@endsection
