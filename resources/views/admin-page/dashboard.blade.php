@extends('layouts.admin-layout')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold mb-4">Recent Users</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Email</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Role</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $user_count = 1 ?>
                                        @forelse ($latest_users as $user)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">
                                                        <a style="color: #000;" href="{{ route('admin.user.edit', $user->user_uuid) }}">{{ $user->name }}</a>
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ substr($user->email, 0, 15) . '...' }}</h6>
                                                </td>
                                                <td>
                                                    @if ($user->is_admin_generated)
                                                        <h6 class="fw-semibold mb-0">Parish Representative</h6>
                                                    @else
                                                        <h6 class="fw-semibold mb-0">User</h6>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Recent Churches</h5>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Id</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Church Name</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Parish Priest</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Status</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $church_count = 1 ?>
                                    @forelse ($latest_churches as $key => $church)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">{{ $church_count++ }}</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1">
                                                    <a href="{{ route('admin.church.edit', $church->church_uuid) }}" style="color: #000;">{{ substr($church->name,0, 20) . '...' }}</a>
                                                </h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $church->parish_priest }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    @if($church->is_active)
                                                        <span class="badge bg-success rounded-3 fw-semibold">Active</span>
                                                    @else
                                                        <span class="badge bg-warning rounded-3 fw-semibold">Inactive</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">
                2023 © <a href="{{ url('') }}" class="text-primary">Kumpisalan.</a> All rights reserved.
                Design and Developed by <a href="https://godesq.com/" target="_blank"
                    class="pe-1 text-primary text-decoration-underline">GodesQ.com</a>
            </p>
        </div>
    </div>
@endsection

@if (Session::get('login-success'))
    @push('scripts')
        <script>
            toastr.success("{{ Session::get('login-success') }}", 'Login');
        </script>
    @endpush
@endif



