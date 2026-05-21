@extends('frontend.app')

@section('content')

<div class="main-content">

    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    <!-- Profile Card Wrapper (centered) -->
    <div class="profile-card-wrapper">
        <div class="profile-card">

            <!-- Header -->
            <div class="card-header">
                <div class="header-icon">
                    <i class="bi bi-person-circle"></i>
                </div>
                <h3>Profile Overview</h3>
            </div>

            <div class="card-body">

                <!-- Avatar Section -->
                <div class="profile-avatar-section">
                    <div class="avatar-circle">
                        {{ strtoupper(substr($profile->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="avatar-info">
                        <h4>{{ $profile->name ?? 'Not set' }}</h4>
                        <span class="blood-badge">
                            <i class="bi bi-droplet-fill"></i>
                            {{ $profile->blood ?? 'Not set' }}
                        </span>
                    </div>
                </div>

                <!-- Fields -->
                <div class="field-group">

                    <!-- Mobile Number -->
                    <div class="field-item">
                        <div class="field-label"><i class="bi bi-telephone-fill"></i> Mobile Number</div>
                        <div class="field-value">{{ $profile->number ?? 'Not set' }}</div>
                    </div>

                    <!-- Blood Group -->
                    <div class="field-item blood-field">
                        <div class="field-label"><i class="bi bi-droplet-half"></i> Blood Group</div>
                        <div class="field-value">
                            <span class="blood-type-large">{{ $profile->blood ?? '--' }}</span>
                            <span class="blood-type-text">Blood Group</span>
                        </div>
                    </div>

                    <!-- Division -->
                    <div class="field-item">
                        <div class="field-label"><i class="bi bi-geo-alt-fill"></i> Division</div>
                        <div class="field-value">
                            {{ $profile->division ?? 'Not set' }}
                        </div>
                    </div>

                    <!-- Last Donated -->
                    <div class="field-item">
                        <div class="field-label"><i class="bi bi-calendar-check-fill"></i> Last Donated</div>
                        <div class="field-value">
                            @if($profile->last_donated)
                                {{ \Carbon\Carbon::parse($profile->last_donated)->timezone('Asia/Dhaka')->format('d M Y') }}
                            @else
                                Not yet donated
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Edit Button -->
                <a href="{{ url('/profile/edit') }}" class="edit-btn">
                    <i class="bi bi-pencil-square"></i>
                    Edit Profile
                </a>

            </div>
        </div>
    </div>

</div>

<!-- Footer -->
<footer>
    &copy; 2025 <span>BloodBank</span>. Saving lives, one drop at a time.
</footer>

<style>
    /* Main content flex */
    .main-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        padding: 3rem 1rem;
        min-height: 80vh;
    }

    /* Wrapper to center the card */
    .profile-card-wrapper {
        width: 100%;
        max-width: 480px;
        display: flex;
        justify-content: center;
    }

    .profile-card {
        width: 100%;
        /* existing styles... */
        background: rgba(10, 0, 0, 0.65);
        border: 1px solid rgba(220, 38, 38, 0.35);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 0 40px rgba(220, 38, 38, 0.2),
                    0 20px 60px rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(16px);
    }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a0000 0%, #3d0000 40%, #6b0000 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── NAVBAR ─── */
        .navbar {
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(10px);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            border-bottom: 1px solid rgba(220, 38, 38, 0.4);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .navbar-brand .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #dc2626, #991b1b);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #fff;
            box-shadow: 0 0 12px rgba(220, 38, 38, 0.6);
        }

        .navbar-brand span {
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.5px;
        }

        .navbar-brand span em {
            color: #f87171;
            font-style: normal;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            list-style: none;
        }

        .nav-links a {
            color: #fca5a5;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .nav-links a:hover {
            color: #fff;
        }

        .nav-links a.active {
            color: #fff;
            border-bottom: 2px solid #ef4444;
            padding-bottom: 2px;
        }

        /* ─── MAIN CONTENT ─── */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
        }

        /* ─── ALERT ─── */
        .alert {
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.4);
            color: #86efac;
            padding: 0.85rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.92rem;
            position: relative;
        }

        .alert i {
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .alert .btn-close {
            margin-left: auto;
            background: none;
            border: none;
            color: #86efac;
            cursor: pointer;
            font-size: 1rem;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .alert .btn-close:hover {
            opacity: 1;
        }

        /* ─── PROFILE CARD ─── */
        .profile-card {
            width: 100%;
            max-width: 480px;
            background: rgba(10, 0, 0, 0.65);
            border: 1px solid rgba(220, 38, 38, 0.35);
            border-radius: 20px;
            overflow: hidden;
            box-shadow:
                0 0 40px rgba(220, 38, 38, 0.2),
                0 20px 60px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(16px);
        }

        /* ─── CARD HEADER ─── */
        .card-header {
            background: linear-gradient(135deg, #7f1d1d 0%, #991b1b 50%, #b91c1c 100%);
            padding: 2rem 2rem 1.6rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: -40px;
            left: -20px;
            width: 90px;
            height: 90px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
        }

        .header-icon {
            font-size: 2.5rem;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .card-header h3 {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
        }

        /* ─── CARD BODY ─── */
        .card-body {
            padding: 2rem;
        }

        /* ─── AVATAR SECTION ─── */
        .profile-avatar-section {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(220, 38, 38, 0.2);
        }

        .avatar-circle {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #dc2626, #7f1d1d);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            flex-shrink: 0;
            box-shadow:
                0 0 0 3px rgba(220, 38, 38, 0.3),
                0 0 20px rgba(220, 38, 38, 0.4);
            letter-spacing: 0;
        }

        .avatar-info h4 {
            color: #fff;
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .blood-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(220, 38, 38, 0.2);
            border: 1px solid rgba(220, 38, 38, 0.5);
            color: #f87171;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .blood-badge i {
            font-size: 0.75rem;
        }

        /* ─── FIELD GROUP ─── */
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1.8rem;
        }

        .field-item {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(220, 38, 38, 0.18);
            border-radius: 12px;
            padding: 1rem 1.2rem;
            transition: border-color 0.25s, background 0.25s;
        }

        .field-item:hover {
            border-color: rgba(220, 38, 38, 0.45);
            background: rgba(220, 38, 38, 0.06);
        }

        .field-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #f87171;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .field-label i {
            font-size: 0.82rem;
        }

        .field-value {
            font-size: 1rem;
            color: #f5f5f5;
            font-weight: 500;
        }

        /* ─── BLOOD FIELD SPECIAL ─── */
        .blood-field .field-value {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .blood-type-large {
            font-size: 1.6rem;
            font-weight: 800;
            color: #ef4444;
            line-height: 1;
        }

        .blood-type-text {
            font-size: 0.8rem;
            color: #9ca3af;
            font-weight: 400;
        }

        /* ─── EDIT BUTTON ─── */
        .edit-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 0.85rem 1.5rem;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: #fff;
            text-decoration: none;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            transition: all 0.25s;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.35);
        }

        .edit-btn:hover {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            box-shadow: 0 6px 22px rgba(220, 38, 38, 0.55);
            transform: translateY(-2px);
            color: #fff;
        }

        .edit-btn:active {
            transform: translateY(0);
        }

        /* ─── FOOTER ─── */
        footer {
            text-align: center;
            padding: 1.2rem;
            color: rgba(255, 255, 255, 0.3);
            font-size: 0.8rem;
            border-top: 1px solid rgba(220, 38, 38, 0.15);
        }

        footer span {
            color: #ef4444;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 520px) {
            .card-body {
                padding: 1.4rem;
            }

            .nav-links {
                gap: 1rem;
            }

            .nav-links li:not(:last-child) {
                display: none;
            }

            .navbar-brand span {
                font-size: 1.1rem;
            }
        }
    </style>

@endsection