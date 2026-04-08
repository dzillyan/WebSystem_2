<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration — EduPortal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0B1D3A; --navy2: #142850; --gold: #C9A84C; --gold2: #E8C46A;
            --cream: #F8F4EE; --white: #FFFFFF;
            --gray50: #F9FAFB; --gray100: #F3F4F6; --gray200: #E5E7EB;
            --gray400: #9CA3AF; --gray600: #4B5563; --gray800: #1F2937;
            --red: #DC2626; --green: #059669;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: var(--cream); color: var(--gray800); min-height: 100vh; }

        .top-bar {
            background: var(--navy);
            padding: 1rem 2rem;
            display: flex; align-items: center; justify-content: space-between;
        }
        .brand { display: flex; align-items: center; gap: .7rem; text-decoration: none; }
        .brand-icon { width: 36px; height: 36px; background: var(--gold); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
        .brand-name { font-family: 'Playfair Display', serif; color: var(--white); font-size: 1.25rem; }
        .brand-name span { color: var(--gold); }
        .login-link { color: rgba(255,255,255,.7); text-decoration: none; font-size: .88rem; }
        .login-link:hover { color: var(--gold); }

        .page-container { max-width: 860px; margin: 0 auto; padding: 3rem 1.5rem; }

        .reg-header { text-align: center; margin-bottom: 2.5rem; }
        .step-badge {
            display: inline-block;
            background: rgba(201,168,76,.15);
            border: 1px solid rgba(201,168,76,.4);
            color: var(--gold);
            padding: .3rem .9rem;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }
        .reg-header h1 { font-family: 'Playfair Display', serif; font-size: 2rem; color: var(--navy); }
        .reg-header p { color: var(--gray400); margin-top: .4rem; }

        .form-card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(11,29,58,.1);
            overflow: hidden;
        }
        .section-header {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 100%);
            padding: 1.1rem 2rem;
            display: flex; align-items: center; gap: .75rem;
        }
        .section-num {
            width: 28px; height: 28px;
            background: var(--gold);
            color: var(--navy);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .78rem; font-weight: 700;
        }
        .section-header h3 { color: var(--white); font-size: .95rem; font-weight: 600; }
        .section-body { padding: 2rem; }

        .form-row { display: grid; gap: 1.25rem; margin-bottom: 0; }
        .form-row-2 { grid-template-columns: 1fr 1fr; }
        .form-row-3 { grid-template-columns: 1fr 1fr 1fr; }
        .form-group { margin-bottom: 1.25rem; }

        label {
            display: block; font-size: .78rem; font-weight: 600;
            color: var(--gray600); margin-bottom: .4rem;
            letter-spacing: .05em; text-transform: uppercase;
        }
        label .req { color: var(--gold); }
        .form-control {
            width: 100%; padding: .72rem 1rem;
            border: 1.5px solid var(--gray200); border-radius: 8px;
            font-family: 'DM Sans', sans-serif; font-size: .9rem; color: var(--gray800);
            transition: border-color .2s, box-shadow .2s; outline: none;
            background: var(--white);
        }
        .form-control:focus { border-color: var(--navy); box-shadow: 0 0 0 3px rgba(11,29,58,.07); }
        .form-control.is-invalid { border-color: var(--red); }
        .invalid-feedback { font-size: .78rem; color: var(--red); margin-top: .3rem; display: flex; align-items: center; gap: .3rem; }

        .form-divider { height: 1px; background: var(--gray100); margin: 0 2rem; }

        .password-strength { height: 4px; border-radius: 2px; margin-top: .5rem; background: var(--gray200); overflow: hidden; }
        .password-strength-bar { height: 100%; width: 0; transition: width .3s, background .3s; border-radius: 2px; }

        .submit-section { padding: 2rem; background: var(--gray50); border-top: 1px solid var(--gray100); }
        .terms { font-size: .82rem; color: var(--gray400); margin-bottom: 1.25rem; display: flex; align-items: flex-start; gap: .6rem; }
        .terms input { margin-top: 2px; accent-color: var(--navy); }
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
            padding: .85rem 2rem; border-radius: 8px;
            font-family: 'DM Sans', sans-serif; font-size: .95rem; font-weight: 600;
            cursor: pointer; border: none; transition: all .2s;
        }
        .btn-primary { background: var(--navy); color: var(--white); width: 100%; }
        .btn-primary:hover { background: var(--navy2); transform: translateY(-1px); box-shadow: 0 8px 24px rgba(11,29,58,.2); }

        .back-link { text-align: center; margin-top: 1.25rem; font-size: .88rem; color: var(--gray400); }
        .back-link a { color: var(--navy); font-weight: 600; text-decoration: none; }
        .back-link a:hover { color: var(--gold); }

        .alert { padding: .85rem 1.25rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: .875rem; display: flex; align-items: flex-start; gap: .6rem; animation: fadeIn .3s ease; }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
        .alert-error { background: #FEE2E2; color: #991B1B; border-left: 4px solid #DC2626; }

        @media(max-width:640px) {
            .form-row-2, .form-row-3 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="top-bar">
    <a href="{{ route('login') }}" class="brand">
        <div class="brand-icon">🎓</div>
        <span class="brand-name">Edu<span>Portal</span></span>
    </a>
    <a href="{{ route('login') }}" class="login-link">← Back to Login</a>
</div>

<div class="page-container">
    <div class="reg-header">
        <div class="step-badge">New Student Registration</div>
        <h1>Create Your Account</h1>
        <p>Fill in your information below. All fields marked <span style="color:var(--gold)">*</span> are required.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-error" style="margin-bottom:1.5rem;">
            ✕ Please fix the errors below before submitting.
        </div>
    @endif

    <div class="form-card">
        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            {{-- SECTION 1: Personal Info --}}
            <div class="section-header">
                <div class="section-num">1</div>
                <h3>Personal Information</h3>
            </div>
            <div class="section-body">
                <div class="form-row form-row-3" style="margin-bottom:1.25rem;">
                    <div class="form-group" style="margin:0;">
                        <label>First Name <span class="req">*</span></label>
                        <input type="text" name="first_name" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                            value="{{ old('first_name') }}" placeholder="Juan">
                        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name" class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}"
                            value="{{ old('middle_name') }}" placeholder="Santos">
                        @error('middle_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>Last Name <span class="req">*</span></label>
                        <input type="text" name="last_name" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                            value="{{ old('last_name') }}" placeholder="Dela Cruz">
                        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-row form-row-3">
                    <div class="form-group" style="margin:0;">
                        <label>Date of Birth <span class="req">*</span></label>
                        <input type="date" name="date_of_birth" class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"
                            value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>Gender <span class="req">*</span></label>
                        <select name="gender" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                            <option value="">Select gender</option>
                            @foreach(['Male','Female','Other'] as $g)
                                <option value="{{ $g }}" {{ old('gender') == $g ? 'selected' : '' }}>{{ $g }}</option>
                            @endforeach
                        </select>
                        @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>Phone Number <span class="req">*</span></label>
                        <input type="tel" name="phone_number" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                            value="{{ old('phone_number') }}" placeholder="+63 9XX XXX XXXX">
                        @error('phone_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-divider"></div>

            {{-- SECTION 2: Address --}}
            <div class="section-header">
                <div class="section-num">2</div>
                <h3>Address Information</h3>
            </div>
            <div class="section-body">
                <div class="form-group">
                    <label>Street / Barangay Address <span class="req">*</span></label>
                    <input type="text" name="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                        value="{{ old('address') }}" placeholder="123 Rizal Street, Brgy. San Antonio">
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-row form-row-3">
                    <div class="form-group" style="margin:0;">
                        <label>City / Municipality <span class="req">*</span></label>
                        <input type="text" name="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                            value="{{ old('city') }}" placeholder="Tuguegarao City">
                        @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>Province <span class="req">*</span></label>
                        <input type="text" name="province" class="form-control {{ $errors->has('province') ? 'is-invalid' : '' }}"
                            value="{{ old('province') }}" placeholder="Cagayan">
                        @error('province')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>ZIP Code <span class="req">*</span></label>
                        <input type="text" name="zip_code" class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}"
                            value="{{ old('zip_code') }}" placeholder="3500">
                        @error('zip_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-divider"></div>

            {{-- SECTION 3: Academic --}}
            <div class="section-header">
                <div class="section-num">3</div>
                <h3>Academic Information</h3>
            </div>
            <div class="section-body">
                <div class="form-row form-row-2">
                    <div class="form-group" style="margin:0;">
                        <label>Course / Program <span class="req">*</span></label>
                        <select name="course" class="form-control {{ $errors->has('course') ? 'is-invalid' : '' }}">
                            <option value="">Select course</option>
                            @foreach(['Bachelor of Science in Information Technology','Bachelor of Science in Computer Science','Bachelor of Science in Nursing','Bachelor of Science in Education','Bachelor of Science in Engineering','Bachelor of Arts in Communication','Bachelor of Science in Business Administration','Bachelor of Science in Accountancy','Bachelor of Science in Psychology','Bachelor of Science in Tourism Management'] as $c)
                                <option value="{{ $c }}" {{ old('course') == $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                        @error('course')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>Year Level <span class="req">*</span></label>
                        <select name="year_level" class="form-control {{ $errors->has('year_level') ? 'is-invalid' : '' }}">
                            <option value="">Select year</option>
                            @foreach(['1st Year','2nd Year','3rd Year','4th Year','5th Year'] as $y)
                                <option value="{{ $y }}" {{ old('year_level') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                        @error('year_level')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-divider"></div>

            {{-- SECTION 4: Guardian --}}
            <div class="section-header">
                <div class="section-num">4</div>
                <h3>Guardian / Emergency Contact</h3>
            </div>
            <div class="section-body">
                <div class="form-row form-row-2">
                    <div class="form-group" style="margin:0;">
                        <label>Guardian's Full Name</label>
                        <input type="text" name="guardian_name" class="form-control"
                            value="{{ old('guardian_name') }}" placeholder="Maria Dela Cruz">
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>Guardian's Contact Number</label>
                        <input type="tel" name="guardian_contact" class="form-control"
                            value="{{ old('guardian_contact') }}" placeholder="+63 9XX XXX XXXX">
                    </div>
                </div>
            </div>

            <div class="form-divider"></div>

            {{-- SECTION 5: Account --}}
            <div class="section-header">
                <div class="section-num">5</div>
                <h3>Account Credentials</h3>
            </div>
            <div class="section-body">
                <div class="form-group">
                    <label>Email Address <span class="req">*</span></label>
                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        value="{{ old('email') }}" placeholder="juandelacruz@email.com">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-row form-row-2">
                    <div class="form-group" style="margin:0;">
                        <label>Password <span class="req">*</span></label>
                        <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            placeholder="Min. 8 chars, mixed case + numbers">
                        <div class="password-strength"><div class="password-strength-bar" id="strength-bar"></div></div>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>Confirm Password <span class="req">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Re-enter password">
                    </div>
                </div>
            </div>

            <div class="submit-section">
                <div class="terms">
                    <input type="checkbox" id="agree" required>
                    <label for="agree" style="text-transform:none; letter-spacing:0; font-weight:400; font-size:.82rem; color:var(--gray400);">
                        I certify that all information provided is accurate and complete. I agree to the institution's enrollment policies and terms of service.
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Complete Registration →</button>
            </div>
        </form>
    </div>

    <div class="back-link">Already have an account? <a href="{{ route('login') }}">Sign in here</a></div>
</div>

<script>
const pw = document.getElementById('password');
const bar = document.getElementById('strength-bar');
pw.addEventListener('input', () => {
    const v = pw.value;
    let s = 0;
    if (v.length >= 8) s++;
    if (/[A-Z]/.test(v)) s++;
    if (/[a-z]/.test(v)) s++;
    if (/[0-9]/.test(v)) s++;
    if (/[^A-Za-z0-9]/.test(v)) s++;
    const colors = ['#EF4444','#F97316','#EAB308','#22C55E','#10B981'];
    const widths = ['20%','40%','60%','80%','100%'];
    bar.style.width = v.length ? widths[s-1] || '10%' : '0';
    bar.style.background = v.length ? colors[s-1] || '#EF4444' : '';
});
</script>
</body>
</html>