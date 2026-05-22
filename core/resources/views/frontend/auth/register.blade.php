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
                    <path d="M12 2C12 2 4 10.5 4 15.5a8 8 0 0 0 16 0C20 10.5 12 2 12 2Z" fill="#6b9bff"/>
                </svg>
            </div>
            <div class="brand-text">
                <span class="brand-name h4 d-block">ChatBox</span>
                <span class="brand-sub small">Real-time Chat · Connect Instantly</span>
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
                <span>Create Your Account</span>
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
                            <input id="name" type="text" class="form-control login-input" name="name" placeholder="Enter your full name" required autofocus autocomplete="name">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="input-group-animated mb-3">
                        <label for="email" class="login-label">Email Address</label>
                        <div class="input-wrap">
                            <svg class="field-icon" viewBox="0 0 24 24">
                                <rect x="2" y="4" width="20" height="16" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                            <input id="email" type="email" class="form-control login-input" name="email" placeholder="you@example.com" required autocomplete="email">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="input-group-animated mb-3">
                        <label for="password" class="login-label">Password</label>
                        <div class="input-wrap">
                            <svg class="field-icon" viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input id="password" type="password" class="form-control login-input" name="password" placeholder="••••••••" required>
                        </div>

                        <div class="password-checker" id="password-checker">
                            <div class="checker-dots" id="strength-dots">
                                <span class="checker-dot"></span>
                                <span class="checker-dot"></span>
                                <span class="checker-dot"></span>
                                <span class="checker-dot"></span>
                                <span class="checker-dot"></span>
                                <span class="checker-dot"></span>
                            </div>
                            <span class="checker-text" id="strength-text">
                                Use 8+ characters with numbers, uppercase & symbols
                            </span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="input-group-animated mb-3">
                        <label for="password-confirm" class="login-label">Confirm Password</label>
                        <div class="input-wrap">
                            <svg class="field-icon" viewBox="0 0 24 24">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                            <input id="password-confirm" type="password" class="form-control login-input" name="password_confirmation" placeholder="••••••••" required>
                        </div>

                        <div class="password-match" id="password-match">
                            Passwords do not match yet
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="input-group-animated mt-4 d-flex flex-column gap-3">
                        <button type="submit" class="btn login-btn">
                            Register Now
                        </button>

                        <div class="divider"><span>OR</span></div>

                        <a href="{{ route('login') }}" class="login-link">
                            Already have an account? Sign in
                        </a>
                    </div>

                </form>
            </div>

            <div class="card-footer-strip"></div>
        </div>

        <div class="page-footer mt-3 text-center">
            &copy; 2025 ChatBox · Privacy · Terms
        </div>

    </div>
</div>