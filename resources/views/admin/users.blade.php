@extends('layouts.admin')
@section('title', 'Users')
@section('subtitle', 'Manage accounts, roles & access')

@section('content')
@php
    $adminCount   = \App\Models\User::where('role','admin')->count();
    $creatorCount = \App\Models\User::where('role','creator')->count();
    $memberCount  = \App\Models\User::where('role','user')->orWhereNull('role')->count();
@endphp

<style>
    .page-table { width:100%; font-size:13px; border-collapse:collapse; }
    .page-table thead tr { background:linear-gradient(90deg,#f8faff,#f3f4fe); }
    .page-table th { padding:12px 20px; font-size:10px; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:.14em; border-bottom:1px solid #e8ecf4; white-space:nowrap; }
    .page-table td { padding:13px 20px; border-bottom:1px solid #f3f6fb; vertical-align:middle; }
    .page-table tbody tr { transition:background .1s; }
    .page-table tbody tr:hover { background:#f7f9ff; }
    .page-table tbody tr:last-child td { border-bottom:none; }
</style>

{{-- ══ Page Header ══ --}}
<div class="fade-up" style="position:relative;overflow:hidden;border-radius:24px;margin-bottom:28px;background:linear-gradient(135deg,#082047 0%,#1040a0 38%,#0369a1 70%,#0891b2 100%);min-height:168px">
    <div style="position:absolute;inset:0;pointer-events:none;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px"></div>
    <div style="position:absolute;top:-80px;right:-40px;width:320px;height:320px;border-radius:50%;background:radial-gradient(circle,rgba(56,189,248,.18) 0%,transparent 65%);pointer-events:none"></div>
    <div style="position:absolute;bottom:-90px;left:42%;width:360px;height:360px;border-radius:50%;background:rgba(14,165,233,.07);pointer-events:none"></div>
    <div style="position:absolute;top:-50px;right:120px;width:220px;height:220px;border-radius:50%;border:1px solid rgba(255,255,255,.05);pointer-events:none"></div>

    <div style="position:relative;padding:28px 32px 26px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
            <div style="display:inline-flex;align-items:center;gap:7px;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);backdrop-filter:blur(6px)">
                <span style="width:6px;height:6px;border-radius:50%;background:#38bdf8;flex-shrink:0;animation:ap-pulse 2.5s ease infinite"></span>
                <span style="font-size:11px;font-weight:700;color:rgba(186,230,253,.85);letter-spacing:.12em;text-transform:uppercase">User Management</span>
            </div>
            <a href="{{ route('admin.users.create') }}" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;border-radius:11px;font-size:12px;font-weight:700;color:#fff;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.22);backdrop-filter:blur(6px);text-decoration:none;transition:all .15s" onmouseover="this.style.background='rgba(255,255,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add User
            </a>
        </div>

        <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px">
            <div>
                <h1 style="font-size:clamp(1.6rem,3vw,2.1rem);font-weight:900;color:#fff;line-height:1.1;letter-spacing:-.5px">
                    {{ number_format($users->total()) }}
                    <span style="font-size:1rem;font-weight:500;color:rgba(186,230,253,.55)">total accounts</span>
                </h1>
                <p style="margin-top:9px;font-size:13px;color:rgba(186,230,253,.45)">Manage roles, access and account status</p>
            </div>

            <div style="display:flex;gap:2px;flex-shrink:0;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:4px;backdrop-filter:blur(8px)">
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#fff;letter-spacing:-1px;line-height:1">{{ $adminCount }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(186,230,253,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Admins</p>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.08);margin:8px 0"></div>
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#fff;letter-spacing:-1px;line-height:1">{{ $creatorCount }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(186,230,253,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Creators</p>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.08);margin:8px 0"></div>
                <div style="padding:12px 20px;text-align:center;border-radius:12px">
                    <p style="font-size:20px;font-weight:900;color:#38bdf8;letter-spacing:-1px;line-height:1">{{ $memberCount }}</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(186,230,253,.5);margin-top:4px;text-transform:uppercase;letter-spacing:.1em">Members</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══ Table Card ══ --}}
<div class="fade-up-1" style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">

    {{-- Dark header --}}
    <div style="background:linear-gradient(135deg,#0c2447,#1d4e89,#0369a1);padding:16px 22px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
        <div style="position:absolute;top:-24px;right:-16px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none"></div>
        <div style="display:flex;align-items:center;gap:11px;position:relative">
            <div style="width:36px;height:36px;border-radius:11px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            </div>
            <div>
                <p style="font-size:14px;font-weight:700;color:#fff;letter-spacing:-.2px">All Users</p>
                <p style="font-size:11px;color:rgba(186,230,253,.6);margin-top:1px">Page {{ $users->currentPage() }} of {{ $users->lastPage() }}</p>
            </div>
        </div>
        <span style="position:relative;font-size:11px;font-weight:700;padding:5px 13px;border-radius:99px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);color:rgba(186,230,253,.9)">{{ number_format($users->total()) }} total</span>
    </div>

    <div style="background:#fff;overflow-x:auto">
        <table class="page-table">
            <thead>
                <tr>
                    <th style="text-align:left">#</th>
                    <th style="text-align:left">User</th>
                    <th style="text-align:left">Email</th>
                    <th style="text-align:left">Role</th>
                    <th style="text-align:left">Subscription</th>
                    <th style="text-align:left">Joined</th>
                    <th style="text-align:right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td style="color:#cbd5e1;font-size:11px;font-weight:700;width:40px">{{ str_pad($loop->iteration + ($users->currentPage()-1)*$users->perPage(), 2, '0', STR_PAD_LEFT) }}</td>

                        <td>
                            <div style="display:flex;align-items:center;gap:11px">
                                <div style="position:relative;flex-shrink:0">
                                    <div style="width:40px;height:40px;border-radius:12px;background:linear-gradient(135deg,#0284c7,#0891b2);display:flex;align-items:center;justify-content:center;font-size:15px;font-weight:800;color:#fff;box-shadow:0 4px 12px rgba(2,132,199,.28)">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span style="position:absolute;bottom:-2px;right:-2px;width:10px;height:10px;border-radius:50%;background:#34d399;border:2px solid #fff"></span>
                                </div>
                                <div>
                                    <p style="font-weight:700;color:#1e293b;font-size:13px">{{ $user->name }}</p>
                                    <p style="font-size:10.5px;color:#94a3b8;margin-top:1px">ID #{{ $user->id }}</p>
                                </div>
                            </div>
                        </td>

                        <td style="color:#64748b;font-size:12.5px">{{ $user->email }}</td>

                        <td>
                            @php
                                $rStyles = [
                                    'admin'   => 'background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff',
                                    'creator' => 'background:linear-gradient(135deg,#9333ea,#7e22ce);color:#fff',
                                    'user'    => 'background:#f1f5f9;color:#64748b',
                                ];
                                $rs = $rStyles[$user->role ?? 'user'] ?? $rStyles['user'];
                            @endphp
                            <form action="{{ route('admin.users.update-role', $user->id) }}" method="POST" style="display:inline">
                                @csrf @method('PUT')
                                <select name="role" onchange="this.form.submit()"
                                        style="font-size:11px;font-weight:700;padding:5px 10px;border-radius:99px;border:none;cursor:pointer;{{ $rs }};outline:none;appearance:none;-webkit-appearance:none">
                                    <option value="user"    @selected(($user->role??'user')==='user')    style="background:#f1f5f9;color:#64748b">Member</option>
                                    <option value="creator" @selected(($user->role??'user')==='creator') style="background:#f3e8ff;color:#7e22ce">Creator</option>
                                    <option value="admin"   @selected(($user->role??'user')==='admin')   style="background:#eef2ff;color:#4338ca">Admin</option>
                                </select>
                            </form>
                        </td>

                        <td>
                            @php
                                $sub = $user->subscription_status ?? 'free';
                                $subStyle = [
                                    'active'   => 'background:linear-gradient(135deg,#10b981,#059669);color:#fff',
                                    'inactive' => 'background:#f1f5f9;color:#94a3b8',
                                    'free'     => 'background:#f8fafc;color:#94a3b8',
                                ][$sub] ?? 'background:#f8fafc;color:#94a3b8';
                            @endphp
                            <span style="display:inline-flex;align-items:center;padding:4px 10px;border-radius:99px;font-size:11px;font-weight:700;{{ $subStyle }}">
                                {{ ucfirst($sub) }}
                            </span>
                        </td>

                        <td>
                            <p style="font-size:12.5px;font-weight:600;color:#475569">{{ $user->created_at?->format('M j, Y') ?? '—' }}</p>
                            <p style="font-size:11px;color:#94a3b8;margin-top:2px">{{ $user->created_at?->diffForHumans() ?? '' }}</p>
                        </td>

                        <td style="text-align:right">
                            <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px">
                                <a href="{{ route('admin.users.edit', $user) }}" class="act-btn"
                                   style="color:#4f46e5;border-color:#c7d2fe;background:#eef2ff"
                                   onmouseover="this.style.background='linear-gradient(135deg,#4f46e5,#7c3aed)';this.style.color='#fff';this.style.borderColor='transparent'"
                                   onmouseout="this.style.background='#eef2ff';this.style.color='#4f46e5';this.style.borderColor='#c7d2fe'">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Permanently delete {{ addslashes($user->name) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="act-btn"
                                            style="color:#dc2626;border-color:#fecdd3;background:#fff1f2"
                                            onmouseover="this.style.background='linear-gradient(135deg,#ef4444,#dc2626)';this.style.color='#fff';this.style.borderColor='#ef4444'"
                                            onmouseout="this.style.background='#fff1f2';this.style.color='#dc2626';this.style.borderColor='#fecdd3'">
                                        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:80px 24px;text-align:center">
                            <div style="width:64px;height:64px;border-radius:20px;background:linear-gradient(135deg,#eff6ff,#dbeafe);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 4px 16px rgba(2,132,199,.12)">
                                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#0284c7" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                            </div>
                            <p style="font-size:15px;font-weight:700;color:#1e293b">No users yet</p>
                            <p style="font-size:13px;color:#94a3b8;margin-top:5px">Users will appear here once they register.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 22px;border-top:1px solid #f1f5f9;background:#f8faff">
            <p style="font-size:12px;color:#94a3b8">Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ number_format($users->total()) }}</p>
            {{ $users->links() }}
        </div>
    @endif
</div>

@endsection
