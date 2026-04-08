@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div style="display:flex; align-items:center; gap:1.5rem; position:relative; z-index:1;">
        <div style="width:64px; height:64px; border-radius:50%; background:rgba(201,168,76,.2); border:2px solid var(--gold); display:flex; align-items:center; justify-content:center; font-size:1.5rem; overflow:hidden; flex-shrink:0;">
            @if($student->profile_photo)
                <img src="{{ Storage::url($student->profile_photo) }}" alt="Photo" style="width:100%; height:100%; object-fit:cover;">
            @else
                {{ strtoupper(substr($student->first_name,0,1)) }}{{ strtoupper(substr($student->last_name,0,1)) }}
            @endif
        </div>
        <div>
            <h1>Welcome, {{ $student->first_name }}!</h1>
            <p>{{ $student->course }} &nbsp;·&nbsp; {{ $student->year_level }} &nbsp;·&nbsp; ID: <strong style="color:var(--gold2);">{{ $student->student_id }}</strong></p>
        </div>
    </div>
</div>

{{-- Stats --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">🎓</div>
        <div class="stat-value">{{ $student->year_level }}</div>
        <div class="stat-label">Year Level</div>
    </div>
    <div class="stat-card" style="border-left-color:#3B82F6;">
        <div class="stat-icon">📋</div>
        <div class="stat-value">{{ $logCount }}</div>
        <div class="stat-label">Activity Logs</div>
    </div>
    <div class="stat-card" style="border-left-color:#10B981;">
        <div class="stat-icon">✅</div>
        <div class="stat-value">{{ ucfirst($student->status) }}</div>
        <div class="stat-label">Account Status</div>
    </div>
    <div class="stat-card" style="border-left-color:#8B5CF6;">
        <div class="stat-icon">📅</div>
        <div class="stat-value">{{ $student->created_at->format('Y') }}</div>
        <div class="stat-label">Enrolled Since</div>
    </div>
</div>

{{-- Student Info + Logs --}}
<div style="display:grid; grid-template-columns:1fr 1.6fr; gap:1.5rem;">

    {{-- Student Summary Card --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Student Profile</h3>
            <a href="{{ route('profile') }}" style="font-size:.82rem; color:var(--gold); text-decoration:none; font-weight:600;">Edit →</a>
        </div>
        <div class="card-body" style="padding:1.5rem;">
            <div style="text-align:center; margin-bottom:1.5rem;">
                <div style="width:80px; height:80px; border-radius:50%; background:var(--navy); border:3px solid var(--gold); margin:0 auto .75rem; display:flex; align-items:center; justify-content:center; font-family:'Playfair Display',serif; font-size:1.75rem; color:var(--gold); overflow:hidden;">
                    @if($student->profile_photo)
                        <img src="{{ Storage::url($student->profile_photo) }}" alt="Photo" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        {{ strtoupper(substr($student->first_name,0,1)) }}
                    @endif
                </div>
                <div style="font-weight:600; font-size:1.05rem; color:var(--navy);">{{ $student->full_name }}</div>
                <div style="font-size:.82rem; color:var(--gray400);">{{ $student->email }}</div>
            </div>

            @php
            $info = [
                ['Student ID', $student->student_id],
                ['Course', $student->course],
                ['Year Level', $student->year_level],
                ['Gender', $student->gender],
                ['Date of Birth', $student->date_of_birth->format('F d, Y')],
                ['Phone', $student->phone_number],
                ['City', $student->city . ', ' . $student->province],
            ];
            @endphp

            @foreach($info as [$label, $value])
            <div style="display:flex; justify-content:space-between; padding:.55rem 0; border-bottom:1px solid var(--gray100); font-size:.85rem;">
                <span style="color:var(--gray400); font-weight:500;">{{ $label }}</span>
                <span style="color:var(--gray800); font-weight:500; text-align:right; max-width:55%;">{{ $value }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Activity Log --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Recent Activity</h3>
            <span class="badge badge-info">{{ $allLogs->count() }} events</span>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allLogs as $log)
                    <tr>
                        <td>
                            @php
                            $icons = ['login'=>'🔑','logout'=>'🚪','register'=>'📝','login_failed'=>'⚠️','profile_update'=>'✏️','password_change'=>'🔒','page_visit'=>'👁'];
                            $icon = $icons[$log->event_type] ?? '📌';
                            @endphp
                            <span style="font-size:1rem;">{{ $icon }}</span>
                            <span style="font-size:.8rem; color:var(--gray600); margin-left:.25rem;">{{ str_replace('_',' ',ucfirst($log->event_type)) }}</span>
                        </td>
                        <td style="max-width:220px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; font-size:.82rem; color:var(--gray600);">{{ $log->description }}</td>
                        <td><span class="badge {{ $log->status_badge }}">{{ ucfirst($log->status) }}</span></td>
                        <td style="font-size:.78rem; color:var(--gray400); white-space:nowrap;">{{ $log->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:var(--gray400); padding:2rem;">No activity yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection