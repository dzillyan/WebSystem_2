@extends('layouts.app')
@section('title', 'Profile Settings')

@section('content')
<div class="page-header">
    <div style="position:relative; z-index:1;">
        <h1>Profile Settings</h1>
        <p>Update your personal information, change your password, and review activity logs</p>
    </div>
</div>

{{-- Tab Nav --}}
<div class="tab-nav" id="tabNav">
    <button class="tab-btn active" onclick="switchTab('profile', this)">👤 Personal Info</button>
    <button class="tab-btn" onclick="switchTab('password', this)">🔒 Change Password</button>
    <button class="tab-btn" onclick="switchTab('activity', this)">📋 Activity Logs</button>
</div>

{{-- ─── PROFILE TAB ──────────────────────────────────────────────────────── --}}
<div id="tab-profile" class="tab-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Update Personal Information</h3>
            <span class="badge badge-info">{{ $student->student_id }}</span>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                {{-- Profile Photo --}}
                <div style="margin-bottom:2rem;">
                    <span class="section-title">Profile Photo</span>
                    <div style="display:flex; align-items:center; gap:1.5rem; margin-top:1rem;">
                        <div style="width:80px; height:80px; border-radius:50%; background:var(--navy); border:3px solid var(--gold); display:flex; align-items:center; justify-content:center; font-family:'Playfair Display',serif; font-size:1.75rem; color:var(--gold); overflow:hidden; flex-shrink:0;" id="photoPreviewWrap">
                            @if($student->profile_photo)
                                <img src="{{ Storage::url($student->profile_photo) }}" alt="Photo" style="width:100%; height:100%; object-fit:cover;" id="photoPreview">
                            @else
                                <span id="photoInitials">{{ strtoupper(substr($student->first_name,0,1)) }}{{ strtoupper(substr($student->last_name,0,1)) }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="photo_input" class="btn btn-outline btn-sm" style="cursor:pointer; margin-bottom:.5rem; display:inline-flex;">📷 Choose Photo</label>
                            <input type="file" name="profile_photo" id="photo_input" accept="image/*" style="display:none;" onchange="previewPhoto(this)">
                            <p style="font-size:.78rem; color:var(--gray400);">JPG, PNG, GIF up to 2MB</p>
                        </div>
                    </div>
                </div>

                {{-- Personal Info --}}
                <div style="margin-bottom:1.5rem;">
                    <span class="section-title">Personal Information</span>
                    <div class="form-row form-row-3" style="margin-top:1rem; margin-bottom:1.25rem;">
                        <div class="form-group" style="margin:0;">
                            <label>First Name *</label>
                            <input type="text" name="first_name" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                value="{{ old('first_name', $student->first_name) }}">
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name" class="form-control"
                                value="{{ old('middle_name', $student->middle_name) }}">
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label>Last Name *</label>
                            <input type="text" name="last_name" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                value="{{ old('last_name', $student->last_name) }}">
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-row form-row-3">
                        <div class="form-group" style="margin:0;">
                            <label>Email Address *</label>
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                value="{{ old('email', $student->email) }}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label>Phone Number *</label>
                            <input type="tel" name="phone_number" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                                value="{{ old('phone_number', $student->phone_number) }}">
                            @error('phone_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label>Date of Birth *</label>
                            <input type="date" name="date_of_birth" class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"
                                value="{{ old('date_of_birth', $student->date_of_birth->format('Y-m-d')) }}">
                            @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-row form-row-3" style="margin-top:1.25rem;">
                        <div class="form-group" style="margin:0;">
                            <label>Gender *</label>
                            <select name="gender" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                                @foreach(['Male','Female','Other'] as $g)
                                    <option value="{{ $g }}" {{ old('gender', $student->gender) == $g ? 'selected' : '' }}>{{ $g }}</option>
                                @endforeach
                            </select>
                            @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label>Guardian Name</label>
                            <input type="text" name="guardian_name" class="form-control"
                                value="{{ old('guardian_name', $student->guardian_name) }}">
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label>Guardian Contact</label>
                            <input type="tel" name="guardian_contact" class="form-control"
                                value="{{ old('guardian_contact', $student->guardian_contact) }}">
                        </div>
                    </div>
                </div>

                {{-- Address --}}
                <div style="margin-bottom:1.5rem;">
                    <span class="section-title">Address</span>
                    <div style="margin-top:1rem;">
                        <div class="form-group">
                            <label>Street / Barangay Address *</label>
                            <input type="text" name="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                value="{{ old('address', $student->address) }}">
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-row form-row-3">
                            <div class="form-group" style="margin:0;">
                                <label>City *</label>
                                <input type="text" name="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                    value="{{ old('city', $student->city) }}">
                                @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group" style="margin:0;">
                                <label>Province *</label>
                                <input type="text" name="province" class="form-control {{ $errors->has('province') ? 'is-invalid' : '' }}"
                                    value="{{ old('province', $student->province) }}">
                                @error('province')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group" style="margin:0;">
                                <label>ZIP Code *</label>
                                <input type="text" name="zip_code" class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}"
                                    value="{{ old('zip_code', $student->zip_code) }}">
                                @error('zip_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Academic --}}
                <div style="margin-bottom:2rem;">
                    <span class="section-title">Academic Information</span>
                    <div class="form-row form-row-2" style="margin-top:1rem;">
                        <div class="form-group" style="margin:0;">
                            <label>Course / Program *</label>
                            <select name="course" class="form-control {{ $errors->has('course') ? 'is-invalid' : '' }}">
                                @foreach(['Bachelor of Science in Information Technology','Bachelor of Science in Computer Science','Bachelor of Science in Nursing','Bachelor of Science in Education','Bachelor of Science in Engineering','Bachelor of Arts in Communication','Bachelor of Science in Business Administration','Bachelor of Science in Accountancy','Bachelor of Science in Psychology','Bachelor of Science in Tourism Management'] as $c)
                                    <option value="{{ $c }}" {{ old('course', $student->course) == $c ? 'selected' : '' }}>{{ $c }}</option>
                                @endforeach
                            </select>
                            @error('course')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label>Year Level *</label>
                            <select name="year_level" class="form-control {{ $errors->has('year_level') ? 'is-invalid' : '' }}">
                                @foreach(['1st Year','2nd Year','3rd Year','4th Year','5th Year'] as $y)
                                    <option value="{{ $y }}" {{ old('year_level', $student->year_level) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endforeach
                            </select>
                            @error('year_level')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div style="display:flex; gap:1rem;">
                    <button type="submit" class="btn btn-primary">💾 Save Changes</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ─── PASSWORD TAB ──────────────────────────────────────────────────────── --}}
<div id="tab-password" class="tab-content" style="display:none;">
    <div class="card" style="max-width:560px;">
        <div class="card-header">
            <h3 class="card-title">Change Password</h3>
        </div>
        <div class="card-body">
            <div style="background:#FEF3C7; border:1px solid #FDE68A; border-radius:8px; padding:.85rem 1.1rem; margin-bottom:1.5rem; font-size:.85rem; color:#92400E;">
                ⚠️ After changing your password, you will remain logged in on this device.
            </div>
            <form method="POST" action="{{ route('profile.password') }}">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Current Password *</label>
                    <input type="password" name="current_password" class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                        placeholder="Enter your current password">
                    @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>New Password *</label>
                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        placeholder="Min. 8 chars, mixed case + numbers">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group" style="margin-bottom:1.75rem;">
                    <label>Confirm New Password *</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Re-enter new password">
                </div>
                <button type="submit" class="btn btn-primary">🔒 Update Password</button>
            </form>
        </div>
    </div>
</div>

{{-- ─── ACTIVITY LOG TAB ──────────────────────────────────────────────────── --}}
<div id="tab-activity" class="tab-content" style="display:none;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Activity Log History</h3>
            <span class="badge badge-secondary">{{ $recentLogs->count() }} recent events</span>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event</th>
                        <th>Description</th>
                        <th>IP Address</th>
                        <th>Status</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentLogs as $log)
                    <tr>
                        <td style="color:var(--gray400); font-size:.78rem;">{{ $log->id }}</td>
                        <td>
                            @php
                            $icons = ['login'=>'🔑','logout'=>'🚪','register'=>'📝','login_failed'=>'⚠️','profile_update'=>'✏️','password_change'=>'🔒','page_visit'=>'👁'];
                            @endphp
                            <span>{{ $icons[$log->event_type] ?? '📌' }}</span>
                            <span style="font-size:.82rem; color:var(--gray600); margin-left:.3rem;">{{ str_replace('_',' ',ucwords($log->event_type,'_')) }}</span>
                        </td>
                        <td style="font-size:.82rem; color:var(--gray600); max-width:280px;">{{ $log->description }}</td>
                        <td style="font-size:.78rem; color:var(--gray400); font-family:monospace;">{{ $log->ip_address ?? '—' }}</td>
                        <td><span class="badge {{ $log->status_badge }}">{{ ucfirst($log->status) }}</span></td>
                        <td style="font-size:.78rem; color:var(--gray400); white-space:nowrap;">{{ $log->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; color:var(--gray400); padding:2.5rem;">No activity records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
function switchTab(name, btn) {
    document.querySelectorAll('.tab-content').forEach(t => t.style.display = 'none');
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).style.display = 'block';
    btn.classList.add('active');
}
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const wrap = document.getElementById('photoPreviewWrap');
            wrap.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
// Auto-switch to password tab if there are password errors
@if($errors->has('current_password') || $errors->has('password'))
    switchTab('password', document.querySelectorAll('.tab-btn')[1]);
@endif
</script>
@endpush
@endsection