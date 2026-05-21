<div class="login-container">

    <!-- Background Grid -->
    <div class="grid-bg"></div>

    <!-- Glow Orb -->
    <div class="glow-orb"></div>

    <!-- Floating Particles -->
    <div class="particles" id="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center w-100 m-0">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 d-flex justify-content-center">
                <div class="card login-card rounded-4 shadow-lg">

                    <!-- HEADER -->
                    <div class="login-header text-center">

                        <!-- Logo -->
                        <div class="logo-area mb-2">
                            <div class="logo-drop mb-2">
                                <svg class="logo-drop-svg" viewBox="0 0 100 120" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="dropGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#ff6b6b"/>
                                            <stop offset="100%" stop-color="#8b0000"/>
                                        </linearGradient>
                                    </defs>
                                    <path d="M50 10 C50 10, 10 55, 10 75 C10 97 28 110 50 110 C72 110 90 97 90 75 C90 55 50 10 50 10Z"
                                          fill="url(#dropGrad)"/>
                                    <rect x="42" y="50" width="16" height="42" rx="4" fill="white" opacity="0.9"/>
                                    <rect x="30" y="62" width="40" height="16" rx="4" fill="white" opacity="0.9"/>
                                </svg>
                            </div>
                            <div class="brand-name">Blood Bank</div>
                            <div class="brand-sub">রক্তদান · জীবন বাঁচান</div>
                        </div>

                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <span class="icon-lock">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                                </svg>
                            </span>
                            <span class="header-title">অ্যাকাউন্টে লগইন করুন</span>
                        </div>

                    </div>

                    <!-- BODY -->
                    <div class="login-body card-body">

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- EMAIL -->
                            <div class="form-group-custom">
                                <label for="email" class="login-label">ইমেইল ঠিকানা</label>
                                <input id="email" type="email"
                                       class="login-input @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="you@example.com"
                                       required autocomplete="off" autofocus>
                                @error('email')
                                    <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <!-- PASSWORD -->
                            <div class="form-group-custom">
                                <label for="password" class="login-label">পাসওয়ার্ড</label>
                                <input id="password" type="password"
                                       class="login-input @error('password') is-invalid @enderror"
                                       name="password"
                                       placeholder="••••••••"
                                       required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <!-- REMEMBER -->
                            <div class="form-check custom-check mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label login-remember" for="remember">
                                    আমাকে মনে রাখুন
                                </label>
                            </div>

                            <!-- BUTTON -->
                            <button type="submit" class="login-btn mb-3">লগইন করুন</button>

                            <!-- FORGOT PASSWORD -->
                            @if (Route::has('password.request'))
                                <div class="text-end mb-3">
                                    <a class="login-link" href="{{ route('password.request') }}">
                                        পাসওয়ার্ড ভুলে গেছেন?
                                    </a>
                                </div>
                            @endif

                        </form>

                        <!-- DIVIDER -->
                        <div class="divider"><span>অথবা</span></div>

                        <!-- SIGN UP -->
                        <div class="text-center mt-2">
                            <span class="signup-text me-2">অ্যাকাউন্ট নেই?</span>
                            <a href="{{ route('register') }}" class="signup-btn">নিবন্ধন করুন</a>
                        </div>

                    </div>

                    <!-- INFO STRIP -->
                    <div class="info-strip text-center mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                        </svg>
                        আপনার তথ্য সম্পূর্ণ সুরক্ষিত ও এনক্রিপ্টেড।
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --blood-red: #c0392b;
            --blood-dark: #922b21;
            --blood-deep: #641e16;
            --blood-light: #e74c3c;
            --blood-glow: rgba(192, 57, 43, 0.4);
            --bg-dark: #0a0a0f;
            --bg-card: rgba(15, 10, 10, 0.85);
            --text-main: #f5f0f0;
            --text-muted: #b5a5a5;
            --border-color: rgba(192, 57, 43, 0.3);
            --input-bg: rgba(255,255,255,0.05);
        }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            color: var(--text-main);
        }

        /* ── BACKGROUND ── */
        .login-container {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: radial-gradient(ellipse at 50% 0%, #2c0a0a 0%, #0a0a0f 60%);
        }

        /* Grid lines */
        .grid-bg {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(192,57,43,0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(192,57,43,0.07) 1px, transparent 1px);
            background-size: 48px 48px;
            z-index: 0;
        }

        /* Glow orb */
        .glow-orb {
            position: absolute;
            top: -180px;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(192,57,43,0.25) 0%, transparent 70%);
            animation: orbPulse 4s ease-in-out infinite;
            z-index: 0;
        }

        @keyframes orbPulse {
            0%, 100% { transform: translateX(-50%) scale(1);   opacity: 0.7; }
            50%       { transform: translateX(-50%) scale(1.12); opacity: 1;   }
        }

        /* Floating particles */
        .particles {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: var(--blood-light);
            opacity: 0;
            animation: floatUp linear infinite;
        }

        /* 12 particles */
        .particle:nth-child(1)  { width:5px;  height:5px;  left:8%;   animation-duration:9s;  animation-delay:0s;   }
        .particle:nth-child(2)  { width:3px;  height:3px;  left:18%;  animation-duration:12s; animation-delay:1.5s; }
        .particle:nth-child(3)  { width:7px;  height:7px;  left:28%;  animation-duration:8s;  animation-delay:3s;   }
        .particle:nth-child(4)  { width:4px;  height:4px;  left:38%;  animation-duration:11s; animation-delay:0.8s; }
        .particle:nth-child(5)  { width:6px;  height:6px;  left:50%;  animation-duration:10s; animation-delay:2s;   }
        .particle:nth-child(6)  { width:3px;  height:3px;  left:60%;  animation-duration:13s; animation-delay:4s;   }
        .particle:nth-child(7)  { width:5px;  height:5px;  left:70%;  animation-duration:9s;  animation-delay:1s;   }
        .particle:nth-child(8)  { width:4px;  height:4px;  left:78%;  animation-duration:7s;  animation-delay:2.5s; }
        .particle:nth-child(9)  { width:6px;  height:6px;  left:85%;  animation-duration:11s; animation-delay:0.3s; }
        .particle:nth-child(10) { width:3px;  height:3px;  left:92%;  animation-duration:14s; animation-delay:3.5s; }
        .particle:nth-child(11) { width:5px;  height:5px;  left:5%;   animation-duration:10s; animation-delay:5s;   }
        .particle:nth-child(12) { width:4px;  height:4px;  left:45%;  animation-duration:8s;  animation-delay:6s;   }

        @keyframes floatUp {
            0%   { bottom: -20px; opacity: 0;   transform: translateX(0)   scale(0.5); }
            10%  { opacity: 0.6; }
            90%  { opacity: 0.3; }
            100% { bottom: 110%;  opacity: 0;   transform: translateX(30px) scale(1);  }
        }

        /* ── LAYOUT ── */
        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            padding: 24px 16px;
            display: flex;
            justify-content: center;
        }

        /* ── CARD ── */
        .login-card {
            width: 100%;
            max-width: 480px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow:
                0 0 0 1px rgba(192,57,43,0.1),
                0 20px 60px rgba(0,0,0,0.6),
                0 0 80px rgba(192,57,43,0.08);
            overflow: hidden;
            animation: cardIn 0.7s cubic-bezier(0.22,1,0.36,1) both;
        }

        @keyframes cardIn {
            from { opacity: 0; transform: translateY(30px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0)    scale(1);    }
        }

        /* ── HEADER ── */
        .login-header {
            position: relative;
            padding: 36px 32px 28px;
            background: linear-gradient(135deg, #1a0505 0%, #2c0a0a 100%);
            border-bottom: 1px solid var(--border-color);
            text-align: center;
        }

        /* Top red stripe */
        .login-header::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--blood-light), var(--blood-red), transparent);
        }

        /* Blood drop logo */
        .logo-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .logo-drop {
            width: 64px;
            height: 64px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-drop-svg {
            width: 56px;
            height: 56px;
            filter: drop-shadow(0 0 12px rgba(192,57,43,0.8));
            animation: dropPulse 2.5s ease-in-out infinite;
        }

        @keyframes dropPulse {
            0%, 100% { filter: drop-shadow(0 0 10px rgba(192,57,43,0.7)); transform: scale(1);    }
            50%       { filter: drop-shadow(0 0 22px rgba(231,76,60,1));   transform: scale(1.07); }
        }

        .brand-name {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            background: linear-gradient(135deg, #ff6b6b, #c0392b, #ff6b6b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-sub {
            font-size: 0.75rem;
            color: var(--text-muted);
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        /* Lock icon + Login title */
        .icon-lock {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(192,57,43,0.15);
            border: 1px solid var(--border-color);
            margin-bottom: 8px;
        }

        .icon-lock svg {
            width: 20px;
            height: 20px;
            color: var(--blood-light);
            stroke: var(--blood-light);
        }

        .header-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-main);
            letter-spacing: 0.04em;
        }

        /* ── BODY ── */
        .login-body {
            padding: 32px;
        }

        /* Form group */
        .form-group-custom {
            margin-bottom: 22px;
        }

        .login-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 8px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .login-input {
            width: 100%;
            padding: 13px 16px;
            background: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-main);
            font-size: 0.95rem;
            font-family: inherit;
            transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
            outline: none;
        }

        .login-input::placeholder {
            color: rgba(255,255,255,0.2);
        }

        .login-input:focus {
            border-color: var(--blood-light);
            background: rgba(192,57,43,0.06);
            box-shadow: 0 0 0 3px rgba(192,57,43,0.15), 0 0 20px rgba(192,57,43,0.08);
        }

        .login-input.is-invalid {
            border-color: #ff6b6b;
        }

        .invalid-feedback {
            font-size: 0.8rem;
            color: #ff6b6b;
            margin-top: 6px;
            display: block;
        }

        /* Remember */
        .custom-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 4px;
        }

        .form-check-input {
            width: 17px;
            height: 17px;
            border-radius: 5px;
            border: 1px solid var(--border-color);
            background: var(--input-bg);
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            position: relative;
            flex-shrink: 0;
            transition: background 0.2s, border-color 0.2s;
        }

        .form-check-input:checked {
            background: var(--blood-red);
            border-color: var(--blood-red);
        }

        .form-check-input:checked::after {
            content: '';
            position: absolute;
            top: 2px; left: 5px;
            width: 5px; height: 9px;
            border: 2px solid #fff;
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
        }

        .login-remember {
            font-size: 0.875rem;
            color: var(--text-muted);
            cursor: pointer;
        }

        /* Login button */
        .login-btn {
            width: 100%;
            padding: 14px;
            margin-top: 12px;
            background: linear-gradient(135deg, var(--blood-red) 0%, var(--blood-dark) 100%);
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            letter-spacing: 0.05em;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 20px rgba(192,57,43,0.4);
        }

        .login-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.12) 0%, transparent 60%);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(192,57,43,0.55);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        /* Forgot */
        .text-end {
            text-align: right;
            margin-top: 10px;
        }

        .login-link {
            font-size: 0.82rem;
            color: var(--blood-light);
            text-decoration: none;
            transition: color 0.2s;
        }

        .login-link:hover {
            color: #ff6b6b;
            text-decoration: underline;
        }

        /* Divider */
        .divider {
            position: relative;
            text-align: center;
            margin: 26px 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%; left: 0; right: 0;
            height: 1px;
            background: var(--border-color);
        }

        .divider span {
            position: relative;
            background: #110606;
            padding: 0 14px;
            font-size: 0.75rem;
            color: var(--text-muted);
            letter-spacing: 0.1em;
        }

        /* Sign up row */
        .signup-row {
            text-align: center;
        }

        .signup-text {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .signup-btn {
            display: inline-block;
            padding: 6px 20px;
            border: 1px solid var(--blood-red);
            border-radius: 8px;
            color: var(--blood-light);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            margin-left: 8px;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }

        .signup-btn:hover {
            background: var(--blood-red);
            color: #fff;
            box-shadow: 0 4px 16px rgba(192,57,43,0.4);
        }

        /* ── INFO STRIP (bottom of card) ── */
        .info-strip {
            padding: 14px 32px;
            background: rgba(192,57,43,0.05);
            border-top: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .info-strip svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            stroke: var(--blood-light);
        }

        /* ── FOOTER ── */
        .page-footer {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 16px;
            font-size: 0.75rem;
            color: rgba(255,255,255,0.15);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 480px) {
            .login-header { padding: 28px 20px 22px; }
            .login-body   { padding: 24px 20px; }
            .info-strip   { padding: 12px 20px; }
        }
    </style>