<div class="login-container">

    <!-- Animated Particles -->
    <div class="particles" id="particles">
        <span class="particle" style="left:5%;  width:8px;  height:10px; animation-duration:9s;  animation-delay:0s;   bottom:-20px;"></span>
        <span class="particle" style="left:12%; width:5px;  height:7px;  animation-duration:12s; animation-delay:1.5s; bottom:-20px;"></span>
        <span class="particle" style="left:22%; width:11px; height:14px; animation-duration:8s;  animation-delay:3s;   bottom:-20px;"></span>
        <span class="particle" style="left:35%; width:6px;  height:8px;  animation-duration:14s; animation-delay:.8s;  bottom:-20px;"></span>
        <span class="particle" style="left:48%; width:9px;  height:12px; animation-duration:10s; animation-delay:2s;   bottom:-20px;"></span>
        <span class="particle" style="left:58%; width:5px;  height:7px;  animation-duration:11s; animation-delay:4s;   bottom:-20px;"></span>
        <span class="particle" style="left:70%; width:12px; height:15px; animation-duration:7s;  animation-delay:.3s;  bottom:-20px;"></span>
        <span class="particle" style="left:80%; width:7px;  height:9px;  animation-duration:13s; animation-delay:2.7s; bottom:-20px;"></span>
        <span class="particle" style="left:90%; width:10px; height:13px; animation-duration:9s;  animation-delay:1s;   bottom:-20px;"></span>
        <span class="particle" style="left:96%; width:6px;  height:8px;  animation-duration:15s; animation-delay:3.5s; bottom:-20px;"></span>

        <span class="cross-particle" style="left:8%;  animation-duration:14s; animation-delay:1s;   bottom:-20px;">+</span>
        <span class="cross-particle" style="left:28%; animation-duration:11s; animation-delay:3s;   bottom:-20px;">✚</span>
        <span class="cross-particle" style="left:55%; animation-duration:16s; animation-delay:.5s;  bottom:-20px;">+</span>
        <span class="cross-particle" style="left:75%; animation-duration:10s; animation-delay:2s;   bottom:-20px;">✚</span>
        <span class="cross-particle" style="left:92%; animation-duration:13s; animation-delay:4s;   bottom:-20px;">+</span>
    </div>

    <div class="login-wrapper">

        <!-- Brand Logo Above Card -->
        <div class="brand-top mb-4 text-center">
            <div class="brand-icon mb-2">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="50" height="50">
                    <path d="M12 2C12 2 4 10.5 4 15.5a8 8 0 0 0 16 0C20 10.5 12 2 12 2Z" fill="red"/>
                </svg>
            </div>
            <div class="brand-text">
                <span class="brand-name h4 d-block">Blood Bank</span>
                <span class="brand-sub small">Save a life · Donate blood</span>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card login-card">

            <!-- Header -->
            <div class="card-header login-header d-flex align-items-center justify-content-between">
                <div class="header-icon">
                    <svg viewBox="0 0 24 24" width="24" height="24">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <line x1="19" y1="8" x2="19" y2="14"/>
                        <line x1="22" y1="11" x2="16" y2="11"/>
                    </svg>
                </div>
                <span>Create Account</span>
                <div class="blood-drops d-flex gap-1">
                    <div class="drop"></div>
                    <div class="drop"></div>
                    <div class="drop"></div>
                </div>
            </div>

            <!-- Step Progress Bar -->
            <div class="step-bar mb-3">
                <span class="active"></span>
                <span class="active"></span>
                <span></span>
                <span></span>
            </div>

            <!-- Body -->
            <div class="card-body login-body">
                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                    <!-- Name -->
                    <div class="input-group-animated mb-3">
                        <label for="name" class="login-label">Full Name</label>
                        <div class="input-wrap">
                            <svg class="field-icon" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <input id="name" type="text" class="form-control login-input @error('name') is-invalid @enderror" name="name" placeholder="Enter your full name" required autofocus autocomplete="name">
                        </div>
                        @error('name')
                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="input-group-animated mb-3">
                        <label for="email" class="login-label">Email Address</label>
                        <div class="input-wrap">
                            <svg class="field-icon" viewBox="0 0 24 24">
                                <rect x="2" y="4" width="20" height="16" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                            <input id="email" type="email" class="form-control login-input @error('email') is-invalid @enderror" name="email" placeholder="you@example.com" required autocomplete="email">
                        </div>
                        @error('email')
                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="input-group-animated mb-3">
                        <label for="password" class="login-label">Password</label>
                        <div class="input-wrap">
                            <svg class="field-icon" viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input id="password" type="password" class="form-control login-input @error('password') is-invalid @enderror" name="password" placeholder="••••••••" required autocomplete="new-password">
                        </div>
                        @error('password')
                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <div class="password-checker" id="password-checker" aria-live="polite">
                            <div class="checker-dots" id="strength-dots">
                                <span class="checker-dot"></span>
                                <span class="checker-dot"></span>
                                <span class="checker-dot"></span>
                                <span class="checker-dot"></span>
                                <span class="checker-dot"></span>
                                <span class="checker-dot"></span>
                            </div>
                            <span class="checker-text" id="strength-text">Use 8+ chars, number, upper & symbol</span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="input-group-animated mb-3">
                        <label for="password-confirm" class="login-label">Confirm Password</label>
                        <div class="input-wrap">
                            <svg class="field-icon" viewBox="0 0 24 24">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                            <input id="password-confirm" type="password" class="form-control login-input" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password">
                        </div>
                        <div class="password-match" id="password-match">Passwords do not match yet</div>
                    </div>

                    <!-- Actions -->
                    <div class="input-group-animated mt-4 d-flex flex-column gap-3">
                        <button type="submit" class="btn login-btn">
                            <svg viewBox="0 0 24 24" width="20" height="20">
                                <path d="M12 2C12 2 5 9 5 14a7 7 0 0 0 14 0C19 9 12 2 12 2Z"/>
                            </svg>
                            Register Now
                        </button>

                        <div class="divider"><span>or</span></div>

                        <a href="{{ route('login') }}" class="login-link">
                            <svg viewBox="0 0 24 24" width="20" height="20">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                                <polyline points="10 17 15 12 10 7"/>
                                <line x1="15" y1="12" x2="3" y2="12"/>
                            </svg>
                            Already have an account? Sign In
                        </a>
                    </div>

                </form>
            </div>

            <!-- Bottom color strip -->
            <div class="card-footer-strip"></div>
        </div>

        <!-- Page footer -->
        <div class="page-footer mt-3 text-center">
            &copy; 2025 LifeLine Blood Bank &nbsp;·&nbsp;
            <a href="#">Privacy</a> &nbsp;·&nbsp;
            <a href="#">Terms</a>
        </div>

    </div>
</div>

<style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --red-deep:    #8B0000;
            --red-mid:     #C0392B;
            --red-bright:  #E74C3C;
            --red-light:   #FF6B6B;
            --red-pale:    #FDECEA;
            --white:       #FFFFFF;
            --grey-soft:   #F8F9FA;
            --grey-mid:    #6C757D;
            --grey-dark:   #343A40;
            --shadow-sm:   0 2px 8px rgba(139,0,0,.15);
            --shadow-md:   0 8px 32px rgba(139,0,0,.25);
            --shadow-lg:   0 20px 60px rgba(139,0,0,.35);
            --radius:      16px;
            --transition:  .35s cubic-bezier(.4,0,.2,1);
        }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
        }

        /* ═══════════════════════════════════════
           BACKGROUND & PARTICLES
        ═══════════════════════════════════════ */
        .login-container {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a0000 0%, #3d0000 30%, #6b0000 60%, #8B0000 100%);
            overflow: hidden;
            padding: 40px 16px;
        }

        /* Animated gradient orbs */
        .login-container::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 600px 400px at 10% 20%, rgba(231,76,60,.18) 0%, transparent 70%),
                radial-gradient(ellipse 500px 500px at 90% 80%, rgba(192,57,43,.22) 0%, transparent 70%),
                radial-gradient(ellipse 400px 300px at 50% 50%, rgba(139,0,0,.1) 0%, transparent 70%);
            animation: orb-shift 8s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes orb-shift {
            0%   { opacity: .6; transform: scale(1) rotate(0deg); }
            100% { opacity: 1;  transform: scale(1.08) rotate(3deg); }
        }

        /* Particles canvas area */
        .particles {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
        }

        /* Individual floating blood-drop particles */
        .particle {
            position: absolute;
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            background: radial-gradient(circle at 40% 35%, rgba(255,120,120,.9), rgba(180,0,0,.7));
            animation: float-up linear infinite;
            opacity: 0;
            filter: blur(.4px);
        }

        @keyframes float-up {
            0%   { transform: translateY(0)   scale(1)   rotate(0deg);   opacity: 0; }
            10%  { opacity: .6; }
            90%  { opacity: .3; }
            100% { transform: translateY(-110vh) scale(.4) rotate(360deg); opacity: 0; }
        }

        /* Cross / plus signs floating */
        .cross-particle {
            position: absolute;
            color: rgba(255,120,120,.25);
            font-size: 24px;
            font-weight: 900;
            animation: float-cross linear infinite;
            pointer-events: none;
            user-select: none;
        }

        @keyframes float-cross {
            0%   { transform: translateY(0)      rotate(0deg);   opacity: 0; }
            15%  { opacity: .5; }
            85%  { opacity: .2; }
            100% { transform: translateY(-100vh) rotate(180deg); opacity: 0; }
        }

        /* Grid overlay */
        .login-container::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
        }

        /* ═══════════════════════════════════════
           BRAND HEADER (ABOVE CARD)
        ═══════════════════════════════════════ */
        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 480px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0;
        }

        .brand-top {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
        }

        .brand-top .brand-icon {
            width: 52px;
            height: 52px;
            background: var(--red-bright);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 6px rgba(231,76,60,.25), 0 0 0 12px rgba(231,76,60,.1);
            animation: pulse-ring 2.2s ease-in-out infinite;
        }

        @keyframes pulse-ring {
            0%, 100% { box-shadow: 0 0 0 6px rgba(231,76,60,.25), 0 0 0 12px rgba(231,76,60,.1); }
            50%       { box-shadow: 0 0 0 10px rgba(231,76,60,.35), 0 0 0 22px rgba(231,76,60,.12); }
        }

        .brand-top .brand-icon svg {
            width: 26px;
            height: 26px;
            fill: white;
            stroke: none;
        }

        .brand-top .brand-text {
            display: flex;
            flex-direction: column;
        }

        .brand-top .brand-name {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            letter-spacing: .5px;
            line-height: 1;
        }

        .brand-top .brand-sub {
            font-size: 12px;
            color: rgba(255,255,255,.55);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 3px;
        }

        /* ═══════════════════════════════════════
           CARD
        ═══════════════════════════════════════ */
        .card {
            background: rgba(255,255,255,.97);
            border-radius: var(--radius);
            overflow: hidden;
            width: 100%;
            box-shadow: var(--shadow-lg), 0 0 0 1px rgba(255,255,255,.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* ═══════════════════════════════════════
           CARD HEADER
        ═══════════════════════════════════════ */
        .login-header {
            background: linear-gradient(135deg, var(--red-deep) 0%, var(--red-mid) 50%, var(--red-bright) 100%);
            padding: 32px 36px 28px;
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            letter-spacing: .5px;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: rgba(255,255,255,.07);
        }

        .login-header::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: 40%;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255,255,255,.05);
        }

        .header-icon {
            width: 52px;
            height: 52px;
            background: rgba(255,255,255,.18);
            border: 2px solid rgba(255,255,255,.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 16px rgba(0,0,0,.2);
        }

        .header-icon svg {
            width: 26px;
            height: 26px;
            stroke: #fff;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* Step badge */
        .header-badge {
            margin-left: auto;
            position: relative;
            z-index: 1;
            background: rgba(255,255,255,.2);
            border: 1px solid rgba(255,255,255,.35);
            border-radius: 20px;
            padding: 4px 14px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #fff;
        }

        /* ═══════════════════════════════════════
           CARD BODY
        ═══════════════════════════════════════ */
        .login-body {
            padding: 36px 36px 32px;
        }

        /* ═══════════════════════════════════════
           FORM ELEMENTS
        ═══════════════════════════════════════ */
        .input-group-animated {
            position: relative;
        }

        .login-label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--grey-dark);
            margin-bottom: 8px;
            letter-spacing: .4px;
            text-transform: uppercase;
        }

        .login-label::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 6px;
            background: var(--red-bright);
            border-radius: 50%;
            margin-right: 7px;
            vertical-align: middle;
            margin-top: -2px;
        }

        .login-input {
            width: 100%;
            padding: 13px 18px 13px 44px;
            border: 2px solid #E8ECEF;
            border-radius: 10px;
            font-size: 14.5px;
            font-family: 'Inter', sans-serif;
            color: var(--grey-dark);
            background: var(--grey-soft);
            transition: border-color var(--transition), background var(--transition), box-shadow var(--transition);
            outline: none;
        }

        .login-input::placeholder {
            color: #B0B7C3;
            font-weight: 400;
        }

        .login-input:focus {
            border-color: var(--red-bright);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(231,76,60,.12), 0 4px 16px rgba(231,76,60,.08);
        }

        .login-input:hover:not(:focus) {
            border-color: #CBD0D8;
            background: #fff;
        }

        /* Field icons */
        .field-icon {
            position: absolute;
            left: 14px;
            bottom: 14px;
            width: 18px;
            height: 18px;
            stroke: #B0B7C3;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            pointer-events: none;
            transition: stroke var(--transition);
        }

        .input-group-animated:focus-within .field-icon {
            stroke: var(--red-bright);
        }

        /* Wrapper to position icon inside input */
        .input-wrap {
            position: relative;
        }

        /* Invalid state */
        .login-input.is-invalid {
            border-color: var(--red-bright);
            background: var(--red-pale);
        }

        .invalid-feedback {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: var(--red-mid);
            font-weight: 500;
        }

        .password-checker {
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 2px solid #D4D7DC;
            border-radius: 14px;
            padding: 8px 12px;
            background: #fff;
        }

        .checker-dots {
            display: flex;
            gap: 6px;
            align-items: center;
            padding: 3px 7px;
            border-radius: 8px;
            background: #f2f4f7;
            transition: background .2s ease;
        }

        .checker-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #111;
            opacity: .22;
            transition: opacity .2s ease, transform .2s ease;
        }

        .checker-dot.active {
            opacity: 1;
            transform: scale(1.03);
        }

        .checker-text {
            font-size: 11.5px;
            color: #616a74;
            font-weight: 600;
            letter-spacing: .2px;
        }

        .password-match {
            margin-top: 8px;
            font-size: 11.5px;
            font-weight: 700;
            color: #8a2e2e;
            min-height: 16px;
        }

        .password-match.ok {
            color: #237a3a;
        }

        /* ═══════════════════════════════════════
           SPACING BETWEEN FIELDS
        ═══════════════════════════════════════ */
        .input-group-animated + .input-group-animated,
        .input-group-animated + br + .input-group-animated {
            margin-top: 0;
        }

        /* Override the <br> spacing with targeted gaps */
        .login-body form br { display: none; }

        .input-group-animated {
            margin-bottom: 20px;
        }

        /* ═══════════════════════════════════════
           SUBMIT BUTTON
        ═══════════════════════════════════════ */
        .login-btn {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, var(--red-deep) 0%, var(--red-mid) 50%, var(--red-bright) 100%);
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            letter-spacing: .6px;
            position: relative;
            overflow: hidden;
            transition: transform var(--transition), box-shadow var(--transition);
            box-shadow: 0 6px 20px rgba(192,57,43,.45);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 0;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,.15) 0%, transparent 60%);
            opacity: 0;
            transition: opacity var(--transition);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(192,57,43,.55);
        }

        .login-btn:hover::before { opacity: 1; }

        .login-btn:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(192,57,43,.4);
        }

        .login-btn svg {
            width: 18px;
            height: 18px;
            fill: none;
            stroke: #fff;
            stroke-width: 2.2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ═══════════════════════════════════════
           DIVIDER & LOGIN LINK
        ═══════════════════════════════════════ */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 22px 0 18px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #E8ECEF;
        }

        .divider span {
            font-size: 11px;
            color: #B0B7C3;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .login-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: var(--red-mid);
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            padding: 11px 20px;
            border: 2px solid rgba(192,57,43,.25);
            border-radius: 10px;
            background: rgba(231,76,60,.04);
            transition: all var(--transition);
        }

        .login-link:hover {
            background: rgba(231,76,60,.1);
            border-color: var(--red-bright);
            color: var(--red-deep);
            transform: translateY(-1px);
        }

        .login-link svg {
            width: 15px;
            height: 15px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ═══════════════════════════════════════
           CARD FOOTER STRIP
        ═══════════════════════════════════════ */
        .card-footer-strip {
            background: linear-gradient(90deg, var(--red-deep), var(--red-bright), var(--red-mid));
            height: 4px;
            border-radius: 0 0 var(--radius) var(--radius);
        }

        /* ═══════════════════════════════════════
           FOOTER BELOW CARD
        ═══════════════════════════════════════ */
        .page-footer {
            margin-top: 24px;
            text-align: center;
            color: rgba(255,255,255,.45);
            font-size: 12px;
            letter-spacing: .3px;
        }

        .page-footer a {
            color: rgba(255,180,180,.7);
            text-decoration: none;
        }

        /* ═══════════════════════════════════════
           BLOOD DROP DECORATION (HEADER)
        ═══════════════════════════════════════ */
        .blood-drops {
            display: flex;
            gap: 6px;
            align-items: center;
            margin-left: auto;
            position: relative;
            z-index: 1;
        }

        .drop {
            width: 10px;
            height: 13px;
            background: rgba(255,255,255,.6);
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            animation: drip 2s ease-in-out infinite;
        }

        .drop:nth-child(2) { animation-delay: .3s; opacity: .8; transform: scale(.8); }
        .drop:nth-child(3) { animation-delay: .6s; opacity: .6; transform: scale(.65); }

        @keyframes drip {
            0%, 100% { transform: scaleY(1); }
            50%       { transform: scaleY(1.15); }
        }

        /* ═══════════════════════════════════════
           STEP PROGRESS (DECORATIVE)
        ═══════════════════════════════════════ */
        .step-bar {
            display: flex;
            gap: 6px;
            padding: 16px 36px 0;
        }

        .step-bar span {
            flex: 1;
            height: 3px;
            border-radius: 99px;
            background: #E8ECEF;
        }

        .step-bar span.active {
            background: linear-gradient(90deg, var(--red-mid), var(--red-bright));
        }

        /* ═══════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════ */
        @media (max-width: 520px) {
            .login-header  { padding: 24px 24px 20px; font-size: 19px; }
            .login-body    { padding: 28px 24px 24px; }
            .step-bar      { padding: 14px 24px 0; }
            .brand-top .brand-name { font-size: 19px; }
        }

        @media (max-width: 360px) {
            .login-header { gap: 10px; }
            .blood-drops  { display: none; }
        }

        /* ═══════════════════════════════════════
           UTILITY
        ═══════════════════════════════════════ */
        .btn { display: inline-flex; }
        .form-control { display: block; }
        .d-flex { display: flex; }
        .flex-column { flex-direction: column; }
        .gap-3 { gap: 12px; }
        .mt-3  { margin-top: 12px; }
    </style>
<script>
    (function () {
        var passwordInput = document.getElementById('password');
        var confirmInput = document.getElementById('password-confirm');
        var checker = document.getElementById('password-checker');
        var dots = document.querySelectorAll('#strength-dots .checker-dot');
        var strengthText = document.getElementById('strength-text');
        var matchText = document.getElementById('password-match');

        if (!passwordInput || !confirmInput || !checker || !dots.length || !strengthText || !matchText) {
            return;
        }

        function getScore(value) {
            var score = 0;
            if (value.length >= 8) score++;
            if (value.length >= 12) score++;
            if (/[a-z]/.test(value) && /[A-Z]/.test(value)) score++;
            if (/\d/.test(value)) score++;
            if (/[^A-Za-z0-9]/.test(value)) score++;
            if (value.length >= 16) score++;
            return Math.min(score, 6);
        }

        function updateMatch() {
            var pass = passwordInput.value || '';
            var confirm = confirmInput.value || '';

            if (!confirm.length) {
                matchText.classList.remove('ok');
                matchText.textContent = 'Passwords do not match yet';
                return;
            }

            if (pass === confirm) {
                matchText.classList.add('ok');
                matchText.textContent = 'Passwords matched';
            } else {
                matchText.classList.remove('ok');
                matchText.textContent = 'Passwords do not match';
            }
        }

        function updateStrength() {
            var value = passwordInput.value || '';
            var score = getScore(value);
            var bg = '#f2f4f7';
            var label = 'Use 8+ chars, number, upper & symbol';

            dots.forEach(function (dot, index) {
                dot.classList.toggle('active', index < score);
            });

            if (!value.length) {
                bg = '#f2f4f7';
            } else if (score <= 2) {
                bg = '#ffdedd';
                label = 'Weak password';
            } else if (score <= 4) {
                bg = '#ffecc9';
                label = 'Medium password';
            } else {
                bg = '#d8f7d5';
                label = 'Strong password';
            }

            checker.style.borderColor = score >= 5 ? '#6fcf84' : (score >= 3 ? '#f2bf66' : '#dc8e8e');
            document.getElementById('strength-dots').style.background = bg;
            strengthText.textContent = label;
            updateMatch();
        }

        passwordInput.addEventListener('input', updateStrength);
        confirmInput.addEventListener('input', updateMatch);
        updateStrength();
    })();
</script>
