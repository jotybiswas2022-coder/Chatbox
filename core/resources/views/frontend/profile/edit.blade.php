@extends('frontend.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- ===== HERO STRIP ===== -->
<div class="hero-strip">
    <div class="hero-strip-icon"><i class="fa-solid fa-heart-pulse"></i></div>
    <div class="hero-strip-text">রক্তদান করুন, জীবন বাঁচান — একজন ডোনার তিনটি জীবন বাঁচাতে পারেন</div>
    <div class="hero-strip-badge"><i class="fa-solid fa-droplet"></i> ডোনেট করুন</div>
</div>

<main class="main-wrapper">
    <div class="content-grid">

        <!-- MAIN CARD -->
        <div>
            <!-- Success Alert -->
            <div class="alert-success" id="successAlert" style="display:none; margin-bottom:20px; border-radius:10px;">
                <i class="fa-solid fa-circle-check" style="font-size:18px; flex-shrink:0;"></i>
                <span>আপনার প্রোফাইল সফলভাবে আপডেট হয়েছে!</span>
                <button class="alert-close" onclick="document.getElementById('successAlert').style.display='none'">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header">
                    <div class="header-icon">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>
                    <div>
                        <h2>Edit Profile</h2>
                        <div class="header-sub">আপনার প্রোফাইল তথ্য পরিবর্তন করুন</div>
                    </div>
                </div>

                <div class="card-body">
                    <form id="profileForm" action="/profile/update" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-grid">
                            <!-- Name -->
                            <div class="form-group full">
                                <label for="name">নাম (Name) <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <input type="text" id="name" name="name"
                                        value="{{ $profile->name ?? '' }}"
                                        placeholder="আপনার পূর্ণ নাম লিখুন" required>
                                    <span class="input-icon"><i class="fa-solid fa-user"></i></span>
                                </div>
                            </div>

                            <!-- Blood Group Chips -->
                            <div class="form-group full">
                                <label>রক্তের গ্রুপ (Blood Group) <span class="required">*</span></label>
                                <div class="blood-chips" id="bloodChips">
                                    @php
                                        $groups = ['A+','A-','B+','B-','O+','O-','AB+','AB-'];
                                    @endphp
                                    @foreach($groups as $group)
                                        <button type="button" class="blood-chip {{ ($profile->blood ?? '') == $group ? 'selected' : '' }}"
                                            onclick="selectBlood('{{ $group }}', this)" data-tip="{{ $group }}">
                                            <i class="fa-solid fa-droplet"></i> {{ $group }}
                                        </button>
                                    @endforeach
                                </div>
                                <div class="input-wrapper">
                                    <select id="blood" name="blood" required onchange="syncChips(this.value)">
                                        <option value="">রক্তের গ্রুপ নির্বাচন করুন</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group }}" {{ ($profile->blood ?? '') == $group ? 'selected' : '' }}>
                                                {{ $group }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="input-icon"><i class="fa-solid fa-droplet"></i></span>
                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="form-divider">
                            <div class="line"></div>
                            <span class="divider-text"><i class="fa-solid fa-address-card"></i> যোগাযোগ তথ্য</span>
                            <div class="line"></div>
                        </div>

                        <div class="form-grid">
                            <!-- Mobile -->
                            <div class="form-group">
                                <label for="number">মোবাইল নম্বর (Mobile) <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <input type="tel" id="number" name="number"
                                        value="{{ $profile->number ?? '' }}"
                                        placeholder="01XXXXXXXXX" maxlength="15" required>
                                    <span class="input-icon"><i class="fa-solid fa-mobile-screen-button"></i></span>
                                </div>
                            </div>

                            <!-- Division -->
                            <div class="form-group">
                                <label for="division">বিভাগ (Division) <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <select id="division" name="division" required>
                                        <option value="">বিভাগ নির্বাচন করুন</option>
                                        @foreach(['Dhaka','Chattogram','Khulna','Rajshahi','Barishal','Sylhet','Rangpur','Mymensingh'] as $division)
                                            <option value="{{ $division }}"
                                                {{ ($profile->division ?? '') == $division ? 'selected' : '' }}>
                                                {{ $division }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="input-icon">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Last Donated -->
                            <div class="form-group">
                                <label for="last_donated">সর্বশেষ রক্তদান <span class="optional">(ঐচ্ছিক)</span></label>
                                <div class="input-wrapper">
                                    <input type="date" id="last_donated" name="last_donated"
                                        value="{{ isset($profile->last_donated) ? \Carbon\Carbon::parse($profile->last_donated)->format('Y-m-d') : '' }}">
                                    <span class="input-icon"><i class="fa-regular fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <!-- Info Note -->
                        <div class="info-note">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>রক্তদানের পর কমপক্ষে <strong>৩ মাস</strong> অপেক্ষা করতে হবে। সর্বশেষ দানের তারিখ সঠিকভাবে পূরণ করুন যাতে আমরা আপনাকে পরবর্তী দানের জন্য রিমাইন্ডার দিতে পারি।</span>
                        </div>

                        <!-- Buttons -->
                        <button type="submit" class="btn-submit" id="submitBtn">
                            <span class="btn-icon"><i class="fa-solid fa-floppy-disk"></i></span>
                            আপডেট করুন
                        </button>

                        <button type="button" class="btn-cancel" onclick="resetForm()">
                            <i class="fa-solid fa-rotate-left"></i>
                            পরিবর্তন বাতিল করুন
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- ===== FOOTER ===== -->
<footer>
    <div class="footer-brand">
        <i class="fa-solid fa-heart-pulse"></i>
        রক্তদান ব্যাংক বাংলাদেশ
    </div>
    <div class="footer-links">
        <a href="#">গোপনীয়তা নীতি</a>
        <a href="#">সেবার শর্তাবলী</a>
        <a href="#">যোগাযোগ</a>
        <a href="#">সাহায্য</a>
    </div>
    <div>© ২০২৪ রক্তদান ব্যাংক বাংলাদেশ — সর্বস্বত্ব সংরক্ষিত</div>
</footer>

<script>
    // Animated blood drops
    (function createDrops() {
        const container = document.getElementById('decoDrops');
        if (!container) return;
        for (let i = 0; i < 18; i++) {
            const drop = document.createElement('div');
            drop.className = 'deco-drop';
            drop.style.left = Math.random() * 100 + 'vw';
            drop.style.animationDuration = (6 + Math.random() * 12) + 's';
            drop.style.animationDelay = (Math.random() * 10) + 's';
            drop.style.width  = (4 + Math.random() * 6) + 'px';
            drop.style.height = (5 + Math.random() * 9) + 'px';
            drop.style.opacity = 0.08 + Math.random() * 0.12;
            container.appendChild(drop);
        }
    })();

    // Blood chip selection
    function selectBlood(value, chipEl) {
        document.getElementById('blood').value = value;
        document.querySelectorAll('.blood-chip').forEach(c => c.classList.remove('selected'));
        chipEl.classList.add('selected');
    }

    // Sync chips when dropdown changes
    function syncChips(value) {
        document.querySelectorAll('.blood-chip').forEach(chip => {
            chip.classList.remove('selected');
            if (chip.textContent.trim().includes(value)) {
                chip.classList.add('selected');
            }
        });
    }

    // Form submit handler (demo)
    function handleSubmit(e) {
        e.preventDefault();
        const btn = document.getElementById('submitBtn');
        btn.classList.add('loading');
        btn.querySelector('.btn-icon').innerHTML = '';
        btn.childNodes[btn.childNodes.length-1].textContent = ' আপডেট হচ্ছে...';

        setTimeout(() => {
            btn.classList.remove('loading');
            btn.querySelector('.btn-icon').innerHTML = '<i class="fa-solid fa-floppy-disk"></i>';
            btn.childNodes[btn.childNodes.length-1].textContent = ' আপডেট করুন';

            const alert = document.getElementById('successAlert');
            alert.style.display = 'flex';
            alert.scrollIntoView({ behavior: 'smooth', block: 'center' });

            setTimeout(() => { alert.style.display = 'none'; }, 5000);
        }, 1800);
    }

    // Reset form
    function resetForm() {
        document.getElementById('profileForm').reset();
        document.querySelectorAll('.blood-chip').forEach(c => c.classList.remove('selected'));
    }

    // Load districts (demo)
    function loadDistricts(division) {
        const input = document.getElementById('district');
        const map = {
            dhaka: 'ঢাকা, গাজীপুর, নারায়ণগঞ্জ',
            chittagong: 'চট্টগ্রাম, কক্সবাজার, কুমিল্লা',
            rajshahi: 'রাজশাহী, নওগাঁ, নাটোর',
        };
        input.placeholder = map[division] || 'জেলার নাম লিখুন';
    }

    // Max date for last donated
    document.getElementById('last_donated').max = new Date().toISOString().split('T')[0];
</script>

<style>
        @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap');

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --red-dark: #b91c1c;
            --red-main: #dc2626;
            --red-light: #ef4444;
            --red-soft: #fee2e2;
            --red-pale: #fff5f5;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 20px rgba(0,0,0,0.10);
            --shadow-lg: 0 8px 40px rgba(220,38,38,0.13);
            --shadow-xl: 0 20px 60px rgba(220,38,38,0.18);
            --radius: 16px;
            --radius-sm: 10px;
            --radius-xs: 6px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Hind Siliguri', 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a0000 0%, #3b0000 30%, #7f1d1d 60%, #b91c1c 100%);
            min-height: 100vh;
            color: var(--gray-800);
            position: relative;
            overflow-x: hidden;
        }

        .content-grid > div {
            grid-column: 1 / -1; 
        }

        /* Animated background blobs */
        body::before, body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.18;
            pointer-events: none;
            z-index: 0;
        }
        body::before {
            width: 500px; height: 500px;
            background: #ff6b6b;
            top: -100px; right: -100px;
            animation: blobMove1 8s ease-in-out infinite alternate;
        }
        body::after {
            width: 400px; height: 400px;
            background: #ff0000;
            bottom: -100px; left: -100px;
            animation: blobMove2 10s ease-in-out infinite alternate;
        }

        @keyframes blobMove1 {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(40px, 60px) scale(1.15); }
        }
        @keyframes blobMove2 {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(-40px, -40px) scale(1.2); }
        }

        /* ===== NAVBAR ===== */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: rgba(127, 29, 29, 0.72);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(255,255,255,0.10);
            padding: 0 2rem;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .nav-logo {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, #ff4444, #dc2626);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.2);
            animation: heartbeat 1.8s ease-in-out infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            14%       { transform: scale(1.1); }
            28%       { transform: scale(1); }
            42%       { transform: scale(1.08); }
            70%       { transform: scale(1); }
        }

        .nav-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            letter-spacing: 0.5px;
        }

        .nav-title span {
            display: block;
            font-size: 0.65rem;
            font-weight: 400;
            color: rgba(255,255,255,0.7);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: rgba(255,255,255,0.85);
            font-size: 0.875rem;
            font-weight: 500;
            padding: 7px 14px;
            border-radius: 30px;
            transition: all 0.25s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-links a:hover, .nav-links a.active {
            background: rgba(255,255,255,0.18);
            color: white;
        }

        .nav-links a.active {
            background: rgba(255,255,255,0.22);
        }

        .nav-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #ff6b6b, #dc2626);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            cursor: pointer;
            border: 2px solid rgba(255,255,255,0.3);
            transition: all 0.25s;
        }
        .nav-avatar:hover {
            transform: scale(1.08);
            border-color: rgba(255,255,255,0.6);
        }

        /* ===== HERO STRIP ===== */
        .hero-strip {
            margin-top: 68px;
            background: linear-gradient(90deg, rgba(185,28,28,0.85), rgba(127,29,29,0.85));
            padding: 18px 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            position: relative;
            z-index: 1;
        }

        .hero-strip-icon {
            font-size: 22px;
            color: #fca5a5;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.7; transform: scale(0.95); }
        }

        .hero-strip-text {
            color: white;
            font-size: 0.95rem;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .hero-strip-badge {
            background: rgba(255,255,255,0.18);
            color: white;
            font-size: 0.75rem;
            padding: 3px 12px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.25);
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* ===== MAIN CONTENT ===== */
        .main-wrapper {
            position: relative;
            z-index: 1;
            padding: 3rem 1.5rem 4rem;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .content-grid {
            width: 100%;
            max-width: 1100px;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 28px;
            align-items: start;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .sidebar-card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: var(--radius);
            padding: 22px 18px;
            color: white;
        }

        .sidebar-avatar-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
            margin-bottom: 16px;
        }

        .big-avatar {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, #ff6b6b, #b91c1c);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
            box-shadow: 0 0 0 4px rgba(255,255,255,0.15), var(--shadow-lg);
        }

        .sidebar-name {
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
        }

        .sidebar-blood-badge {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            font-size: 0.85rem;
            font-weight: 700;
            padding: 4px 16px;
            border-radius: 20px;
            box-shadow: 0 2px 8px rgba(220,38,38,0.35);
            letter-spacing: 1px;
        }

        .sidebar-stat {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            font-size: 0.82rem;
        }

        .sidebar-stat:last-child { border-bottom: none; }

        .sidebar-stat-label {
            color: rgba(255,255,255,0.6);
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .sidebar-stat-value {
            font-weight: 600;
            color: white;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            color: rgba(255,255,255,0.75);
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.22s;
            text-decoration: none;
        }

        .sidebar-nav-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .sidebar-nav-item.active {
            background: rgba(220,38,38,0.4);
            color: white;
            border: 1px solid rgba(220,38,38,0.5);
        }

        .sidebar-nav-item .nav-icon {
            width: 30px; height: 30px;
            background: rgba(255,255,255,0.1);
            border-radius: var(--radius-xs);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .sidebar-nav-item.active .nav-icon {
            background: rgba(220,38,38,0.5);
        }

        /* ===== CARD ===== */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            border: none;
        }

        /* ===== CARD HEADER ===== */
        .card-header {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 60%, #7f1d1d 100%);
            padding: 28px 32px;
            display: flex;
            align-items: center;
            gap: 18px;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 150px; height: 150px;
            background: rgba(255,255,255,0.07);
            border-radius: 50%;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: -60px; right: 80px;
            width: 200px; height: 200px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
        }

        .header-icon {
            width: 58px; height: 58px;
            background: rgba(255,255,255,0.18);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            flex-shrink: 0;
            border: 2px solid rgba(255,255,255,0.25);
            position: relative;
            z-index: 1;
        }

        .card-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin: 0;
            line-height: 1.2;
            position: relative;
            z-index: 1;
        }

        .header-sub {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.72);
            margin-top: 4px;
            position: relative;
            z-index: 1;
        }

        /* ===== SUCCESS ALERT ===== */
        .alert-success {
            background: linear-gradient(90deg, #d1fae5, #a7f3d0);
            border: 1px solid #6ee7b7;
            border-left: 4px solid #10b981;
            color: #065f46;
            padding: 14px 20px;
            border-radius: var(--radius-sm);
            margin: 20px 28px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            animation: slideDown 0.4s ease;
        }

        @keyframes slideDown {
            from { transform: translateY(-10px); opacity: 0; }
            to   { transform: translateY(0); opacity: 1; }
        }

        .alert-close {
            margin-left: auto;
            background: none;
            border: none;
            color: #065f46;
            cursor: pointer;
            font-size: 16px;
            opacity: 0.6;
            transition: opacity 0.2s;
            padding: 2px 6px;
        }
        .alert-close:hover { opacity: 1; }

        /* ===== CARD BODY ===== */
        .card-body {
            padding: 28px 32px 32px;
        }

        /* ===== FORM GROUPS ===== */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 20px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group.full { grid-column: 1 / -1; }

        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 8px;
            letter-spacing: 0.2px;
        }

        .required {
            color: var(--red-main);
            font-size: 0.9em;
        }

        .optional {
            color: var(--gray-400);
            font-size: 0.88em;
            font-weight: 400;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input,
        .input-wrapper select {
            width: 100%;
            padding: 12px 42px 12px 16px;
            font-size: 0.93rem;
            font-family: 'Hind Siliguri', 'Poppins', sans-serif;
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-sm);
            background: var(--gray-50);
            color: var(--gray-800);
            transition: all 0.22s;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
        }

        .input-wrapper input::placeholder {
            color: var(--gray-400);
            font-size: 0.875rem;
        }

        .input-wrapper input:focus,
        .input-wrapper select:focus {
            border-color: var(--red-main);
            background: white;
            box-shadow: 0 0 0 3.5px rgba(220,38,38,0.10);
        }

        .input-wrapper input:hover,
        .input-wrapper select:hover {
            border-color: var(--gray-300);
        }

        .input-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--red-light);
            font-size: 15px;
            pointer-events: none;
        }

        /* ===== BLOOD CHIPS ===== */
        .blood-chip-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 10px;
            display: block;
        }

        .blood-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        .blood-chip {
            padding: 6px 15px;
            border-radius: 30px;
            border: 1.5px solid var(--gray-200);
            background: var(--gray-50);
            color: var(--gray-600);
            font-size: 0.83rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.22s;
            display: flex;
            align-items: center;
            gap: 5px;
            letter-spacing: 0.5px;
            user-select: none;
        }

        .blood-chip:hover {
            border-color: var(--red-light);
            color: var(--red-main);
            background: var(--red-soft);
            transform: translateY(-1px);
        }

        .blood-chip.selected {
            background: linear-gradient(135deg, var(--red-main), var(--red-dark));
            border-color: var(--red-dark);
            color: white;
            box-shadow: 0 3px 10px rgba(220,38,38,0.3);
            transform: translateY(-1px);
        }

        .blood-chip i { font-size: 10px; }

        /* ===== DIVIDER ===== */
        .form-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 6px 0 22px;
        }

        .form-divider .line {
            flex: 1;
            height: 1px;
            background: var(--gray-200);
        }

        .divider-text {
            font-size: 0.75rem;
            color: var(--gray-400);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
            padding: 3px 12px;
            background: var(--red-soft);
            color: var(--red-dark);
            border-radius: 20px;
        }

        /* ===== SUBMIT BUTTON ===== */
        .btn-submit {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Hind Siliguri', 'Poppins', sans-serif;
            border: none;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all 0.28s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 18px rgba(220,38,38,0.35);
            margin-top: 8px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(220,38,38,0.45);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-icon {
            width: 28px; height: 28px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        /* ===== CANCEL BUTTON ===== */
        .btn-cancel {
            width: 100%;
            padding: 12px 24px;
            background: var(--gray-100);
            color: var(--gray-600);
            font-size: 0.9rem;
            font-weight: 600;
            font-family: 'Hind Siliguri', 'Poppins', sans-serif;
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all 0.22s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
        }

        .btn-cancel:hover {
            background: var(--gray-200);
            color: var(--gray-700);
        }

        /* ===== FOOTER ===== */
        footer {
            position: relative;
            z-index: 1;
            background: rgba(0,0,0,0.35);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.6);
            text-align: center;
            padding: 22px 1.5rem;
            font-size: 0.82rem;
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: center;
        }

        footer .footer-brand {
            color: rgba(255,255,255,0.85);
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        footer .footer-brand i {
            color: #fca5a5;
        }

        footer .footer-links {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            justify-content: center;
        }

        footer .footer-links a {
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            transition: color 0.2s;
        }

        footer .footer-links a:hover {
            color: #fca5a5;
        }

        /* ===== BLOOD DROP DECO ===== */
        .deco-drops {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .deco-drop {
            position: absolute;
            width: 6px; height: 8px;
            background: rgba(255,100,100,0.15);
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            animation: dropFall linear infinite;
        }

        @keyframes dropFall {
            0%   { transform: translateY(-20px) rotate(0deg); opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 0.5; }
            100% { transform: translateY(100vh) rotate(360deg); opacity: 0; }
        }

        /* ===== MOBILE HAMBURGER ===== */
        .hamburger {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 22px;
            cursor: pointer;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            .sidebar { display: none; }
        }

        @media (max-width: 640px) {
            .navbar { padding: 0 1rem; }
            .nav-links { display: none; }
            .hamburger { display: block; }
            .form-grid { grid-template-columns: 1fr; }
            .card-header { padding: 22px 20px; }
            .card-body { padding: 20px; }
            .card-header h2 { font-size: 1.25rem; }
            .hero-strip { flex-wrap: wrap; gap: 8px; text-align: center; }
            .main-wrapper { padding: 2rem 1rem 3rem; }
        }

        /* Validation styles */
        .input-wrapper input:invalid:not(:placeholder-shown) {
            border-color: #fca5a5;
        }

        .input-wrapper input:valid:not(:placeholder-shown) {
            border-color: #6ee7b7;
        }

        /* Custom select arrow */
        .input-wrapper select {
            cursor: pointer;
        }

        /* Loading state */
        .btn-submit.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-submit.loading::after {
            content: '';
            width: 16px; height: 16px;
            border: 2px solid rgba(255,255,255,0.4);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            margin-left: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Tooltip */
        [data-tip] {
            position: relative;
        }
        [data-tip]:hover::after {
            content: attr(data-tip);
            position: absolute;
            bottom: 110%;
            left: 50%;
            transform: translateX(-50%);
            background: var(--gray-800);
            color: white;
            font-size: 0.7rem;
            padding: 5px 10px;
            border-radius: var(--radius-xs);
            white-space: nowrap;
            pointer-events: none;
            z-index: 99;
        }

        /* Info note */
        .info-note {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-left: 3px solid #3b82f6;
            border-radius: var(--radius-xs);
            padding: 10px 14px;
            font-size: 0.8rem;
            color: #1e40af;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-top: -10px;
            margin-bottom: 20px;
        }

        .info-note i { margin-top: 1px; flex-shrink: 0; }
    </style>
@endsection