@extends('frontend.app')

@section('content')

    <!-- ========== Hero ========== -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <div class="pulse"></div>
                    Donate blood now, save lives
                </div>
                <h1>
                    One drop of blood<br>
                    <span class="highlight">can save a life</span>
                </h1>
                <p>
                    We connect blood donors and patients. Join us to find the right blood group when every minute counts.
                </p>
                <div class="hero-buttons">
                    <a href="#blood-groups" class="btn-primary-custom">
                        <i class="bi bi-search"></i> Find Donors
                    </a>
                    <a href="#contact" class="btn-secondary-custom">
                        <i class="bi bi-telephone-fill"></i> Emergency Contact
                    </a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-blood-drop">
                    <svg class="blood-drop-svg" viewBox="0 0 200 260" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="bloodGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#ef4444"/>
                                <stop offset="100%" style="stop-color:#b91c1c"/>
                            </linearGradient>
                            <linearGradient id="shineGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:rgba(255,255,255,0.4)"/>
                                <stop offset="100%" style="stop-color:rgba(255,255,255,0)"/>
                            </linearGradient>
                        </defs>
                        <path d="M100 10 C100 10, 20 120, 20 170 C20 215, 55 250, 100 250 C145 250, 180 215, 180 170 C180 120, 100 10, 100 10Z" fill="url(#bloodGrad)"/>
                        <path d="M70 80 C70 80, 45 135, 45 160 C45 180, 60 195, 75 195 C90 195, 95 180, 95 165 C95 140, 70 80, 70 80Z" fill="url(#shineGrad)" opacity="0.3"/>
                        <text x="100" y="185" text-anchor="middle" fill="white" font-size="40" font-weight="800" font-family="Inter, sans-serif">Blood</text>
                        <text x="100" y="215" text-anchor="middle" fill="rgba(255,255,255,0.7)" font-size="16" font-weight="600" font-family="Inter, sans-serif">Give</text>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Success Alert (hidden by default) ========== -->
    <div class="alert-success" id="successAlert">
        <i class="bi bi-check-circle-fill"></i> Your message was sent successfully!
    </div>

    <!-- ========== Blood Groups ========== -->
    <section class="blood-groups" id="blood-groups">
        <div class="container">
            <div class="section-header fade-in">
                <div class="section-subtitle">
                    <i class="bi bi-droplet-fill"></i> Blood Groups
                </div>
                <h2 class="section-title">Available Blood Groups</h2>
                <p class="section-desc">Select your required blood group to view the donor list</p>
            </div>

@php
$groups = [
    'A+' => 128,
    'A-' => 45,
    'B+' => 215,
    'B-' => 62,
    'O+' => 340,
    'O-' => 87,
    'AB+' => 96,
    'AB-' => 31
];
@endphp

<div class="blood-grid">
    @foreach($groups as $group => $count)
        <div class="blood-card fade-in">
            <div class="blood-icon"><span class="group-text">{{ $group }}</span></div>
            <p class="label">Blood Group</p>
            <a href="{{ url('/donor_list/'.$group) }}" class="view-donors-btn">
                View Donors <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    @endforeach
</div>
        </div>
    </section>


    <!-- ========== Contact ========== -->
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="section-header fade-in">
                <div class="section-subtitle">
                    <i class="bi bi-envelope-fill"></i> Contact
                </div>
                <h2 class="section-title">Get In Touch With Us</h2>
                <p class="section-desc">Let us know for any questions or emergency needs</p>
            </div>

            <div class="contact-grid">
                <!-- Form -->
                <div class="contact-form-wrapper fade-in">
                    <form id="contactForm" action="{{ url('/contactus') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Your Name</label>
                            <input type="text" name="name" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group">
                            <label>Your Email</label>
                            <input type="email" name="email" placeholder="example@email.com" required>
                        </div>

                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" rows="5" placeholder="Write your message here..." required></textarea>
                        </div>

                        <button type="submit" class="submit-btn" id="contactSubmitBtn">
                            <i class="bi bi-send-fill"></i> Send Message
                        </button>
                    </form>
                </div>

                <!-- Info -->
                <div class="contact-info fade-in">
                    <div class="emergency-card">
                        <div class="emergency-icon"><i class="fas fa-ambulance"></i></div>
                        <h4>Emergency Hotline</h4>
                        <p>Call anytime for emergency blood needs</p>
                        <div class="phone">{{ $account->phone ?? 'N/A' }}</div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <h5>Email</h5>
                            <p>{{ $account->email ?? 'N/A' }}<br>{{ $account->website ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Footer ========== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="logo-icon"><i class="bi bi-droplet-fill"></i></div>
                    <span>Blood Bank</span>
                </div>

                <div class="footer-links">
                    <a href="#">Home</a>
                    <a href="#blood-groups">Blood Groups</a>
                    <a href="#contact">Contact</a>
                </div>

                <div class="footer-social">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <div class="footer-bottom">
                &copy; 2025 Blood Bank. All rights reserved. ❤️ Made with love
            </div>
        </div>
    </footer>

    <script>
        // Scroll animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, index * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

       // Form submission with AJAX
        function handleSubmit(e) {
            e.preventDefault();

            const form = e.target;
            const alert = document.getElementById('successAlert');

            // Prepare form data
            const formData = new FormData(form);

            fetch("{{ url('/contactus') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) throw new Error("Network response was not ok");
                return response.text(); 
            })
            .then(data => {
                // Show success alert
                alert.classList.add('show');
                alert.scrollIntoView({ behavior: 'smooth', block: 'center' });

                // Reset form
                form.reset();

                // Hide alert after 5 seconds
                setTimeout(() => {
                    alert.classList.remove('show');
                }, 5000);
            })
            .catch(error => {
                console.error("Error:", error);
                alert.textContent = "Failed to send message, please try again.";
                alert.classList.add('show');
                setTimeout(() => alert.classList.remove('show'), 5000);
            });
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    // Close mobile menu
                    document.querySelector('.nav-links').classList.remove('open');
                }
            });
        });

        document.getElementById('contactForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('contactSubmitBtn');

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-send-fill"></i> Sending...';
        });
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            background: #f8f9fa;
            overflow-x: hidden;
        }

        /* ============ Hero Section ============ */
        .hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: white;
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(220, 38, 38, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(239, 68, 68, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 60px;
            position: relative;
            z-index: 1;
        }

        .hero-content {
            flex: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(220, 38, 38, 0.2);
            border: 1px solid rgba(220, 38, 38, 0.4);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            color: #fca5a5;
            margin-bottom: 24px;
        }

        .hero-badge .pulse {
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.5); }
        }

        .hero h1 {
            font-size: 52px;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 20px;
        }

        .hero h1 .highlight {
            background: linear-gradient(135deg, #ef4444, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 18px;
            color: rgba(255,255,255,0.7);
            line-height: 1.7;
            margin-bottom: 36px;
            max-width: 520px;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.4);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(220, 38, 38, 0.5);
        }

        .btn-secondary-custom {
            background: rgba(255,255,255,0.1);
            border: 2px solid rgba(255,255,255,0.3);
            color: white;
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-secondary-custom:hover {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.5);
        }

        .hero-visual {
            flex: 0 0 420px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-blood-drop {
            position: relative;
            width: 280px;
            height: 350px;
        }

        .blood-drop-svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 20px 60px rgba(220, 38, 38, 0.4));
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .hero-stats {
            display: flex;
            gap: 40px;
            margin-top: 50px;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: #ef4444;
        }

        .stat-label {
            font-size: 13px;
            color: rgba(255,255,255,0.5);
            margin-top: 4px;
        }

        /* ============ Success Alert ============ */
        .alert-success {
            max-width: 1200px;
            margin: 20px auto;
            padding: 16px 24px;
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            border-left: 4px solid #22c55e;
            border-radius: 8px;
            color: #15803d;
            font-weight: 600;
            text-align: center;
            display: none;
        }

        .alert-success.show {
            display: block;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ============ Blood Groups Section ============ */
        .blood-groups {
            padding: 80px 0;
            background: linear-gradient(180deg, #fff 0%, #fef2f2 100%);
        }

        .blood-groups .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-subtitle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fef2f2;
            color: #dc2626;
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 38px;
            font-weight: 800;
            color: #1a1a2e;
            margin-bottom: 12px;
        }

        .section-desc {
            font-size: 16px;
            color: #6b7280;
            max-width: 500px;
            margin: 0 auto;
        }

        .blood-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .blood-card {
            background: white;
            border-radius: 20px;
            padding: 36px 24px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 2px solid transparent;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .blood-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #dc2626, #ef4444);
            transform: scaleX(0);
            transition: transform 0.35s;
        }

        .blood-card:hover::before {
            transform: scaleX(1);
        }

        .blood-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(220, 38, 38, 0.15);
            border-color: rgba(220, 38, 38, 0.1);
        }

        .blood-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 16px;
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.35s;
        }

        .blood-card:hover .blood-icon {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            transform: scale(1.1);
        }

        .blood-icon .group-text {
            font-size: 24px;
            font-weight: 800;
            color: #dc2626;
            transition: color 0.35s;
        }

        .blood-card:hover .blood-icon .group-text {
            color: white;
        }

        .blood-card h3 {
            font-size: 28px;
            font-weight: 800;
            color: #dc2626;
            margin-bottom: 4px;
        }

        .blood-card .label {
            font-size: 13px;
            color: #9ca3af;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .blood-card .donor-count {
            font-size: 14px;
            color: #6b7280;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .blood-card .donor-count span {
            color: #dc2626;
        }

        .view-donors-btn {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .view-donors-btn:hover {
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
            transform: translateY(-1px);
        }

        /* ============ Features ============ */
        .features {
            padding: 80px 0;
            background: white;
        }

        .features .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .feature-card {
            padding: 36px 28px;
            border-radius: 20px;
            background: linear-gradient(135deg, #fafafa, #fff);
            border: 1px solid #f3f4f6;
            transition: all 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .feature-icon.red {
            background: #fef2f2;
            color: #dc2626;
        }

        .feature-icon.blue {
            background: #eff6ff;
            color: #2563eb;
        }

        .feature-icon.green {
            background: #f0fdf4;
            color: #16a34a;
        }

        .feature-card h4 {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 15px;
            color: #6b7280;
            line-height: 1.7;
        }

        /* ============ Contact Section ============ */
        .contact-section {
            padding: 80px 0;
            background: linear-gradient(180deg, #f8f9fa 0%, #fff 100%);
        }

        .contact-section .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 40px;
            align-items: start;
        }

        .contact-form-wrapper {
            background: white;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 4px 30px rgba(0,0,0,0.06);
            border: 1px solid #f3f4f6;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s;
            background: #fafafa;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #dc2626;
            background: white;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
            border: none;
            width: 100%;
            padding: 16px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(220, 38, 38, 0.4);
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .contact-info-card {
            background: white;
            padding: 28px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            display: flex;
            align-items: flex-start;
            gap: 16px;
            border: 1px solid #f3f4f6;
            transition: all 0.3s;
        }

        .contact-info-card:hover {
            transform: translateX(4px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }

        .contact-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #dc2626;
            flex-shrink: 0;
        }

        .contact-info-card h5 {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 4px;
        }

        .contact-info-card p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
        }

        .emergency-card {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            padding: 32px;
            border-radius: 20px;
            color: white;
            text-align: center;
            box-shadow: 0 8px 30px rgba(220, 38, 38, 0.3);
        }

        .emergency-card .emergency-icon {
            font-size: 40px;
            margin-bottom: 12px;
        }

        .emergency-card h4 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .emergency-card p {
            font-size: 14px;
            opacity: 0.85;
            margin-bottom: 16px;
        }

        .emergency-card .phone {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        /* ============ Footer ============ */
        .footer {
            background: #1a1a2e;
            color: white;
            padding: 50px 0 24px;
        }

        .footer .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
            flex-wrap: wrap;
            padding-bottom: 30px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .footer-brand .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #dc2626, #ef4444);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .footer-brand span {
            font-size: 20px;
            font-weight: 800;
        }

        .footer-links {
            display: flex;
            gap: 28px;
        }

        .footer-links a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-social {
            display: flex;
            gap: 12px;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .footer-social a:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 24px;
            font-size: 13px;
            color: rgba(255,255,255,0.4);
        }

        /* ============ Responsive ============ */
        @media (max-width: 768px) {
            .navbar .container {
                flex-direction: column;
                gap: 12px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero .container {
                flex-direction: column;
                text-align: center;
            }

            .hero h1 {
                font-size: 34px;
            }

            .hero p {
                margin: 0 auto 36px;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-visual {
                flex: none;
            }

            .hero-blood-drop {
                width: 180px;
                height: 230px;
            }

            .hero-stats {
                justify-content: center;
            }

            .blood-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 28px;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .blood-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .blood-card {
                padding: 24px 16px;
            }

            .hero-stats {
                gap: 24px;
            }

            .contact-form-wrapper {
                padding: 24px;
            }
        }

        /* ============ Scroll Animations ============ */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ============ Hamburger ============ */
        .hamburger {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: block;
                position: absolute;
                right: 20px;
                top: 18px;
            }

            .navbar .container {
                position: relative;
            }

            .nav-links {
                display: none;
            }

            .nav-links.open {
                display: flex;
                flex-direction: column;
                width: 100%;
                background: rgba(0,0,0,0.15);
                border-radius: 12px;
                padding: 12px;
            }
        }
    </style>


@endsection