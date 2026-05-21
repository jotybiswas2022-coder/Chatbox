@extends('frontend.app')

@section('content')

<style>
    :root{
        --primary:#2563EB;
        --bg:#FFFFFF;
        --text:#111827;
        --light:#F3F4F6;
        --border:#E5E7EB;
    }

    body{
        background:var(--bg);
        font-family:Arial, sans-serif;
        color:var(--text);
    }

    .hero{
        padding:90px 0;
        text-align:center;
        background:linear-gradient(180deg, #EEF4FF, #FFFFFF);
    }

    .hero h1{
        font-size:48px;
        font-weight:700;
    }

    .hero p{
        max-width:600px;
        margin:15px auto;
        color:#6B7280;
        font-size:16px;
    }

    .btn-primary-custom{
        background:var(--primary);
        color:#fff;
        padding:12px 25px;
        border-radius:30px;
        text-decoration:none;
        display:inline-block;
        margin-top:15px;
    }

    .features{
        padding:60px 0;
    }

    .feature-card{
        border:1px solid var(--border);
        border-radius:15px;
        padding:25px;
        transition:.3s;
        height:100%;
        background:#fff;
    }

    .feature-card:hover{
        transform:translateY(-8px);
        box-shadow:0 10px 25px rgba(0,0,0,0.08);
    }

    .feature-card i{
        font-size:30px;
        color:var(--primary);
        margin-bottom:10px;
    }

    .about{
        padding:60px 0;
        background:var(--light);
        text-align:center;
    }

    .about p{
        max-width:700px;
        margin:auto;
        color:#6B7280;
    }

</style>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>Welcome to ChatBox</h1>
        <p>
            ChatBox is a modern social messaging platform designed to connect people instantly.
            Fast, secure, and simple communication for everyone.
        </p>

        <a href="#" class="btn-primary-custom">
            <i class="bi bi-box-arrow-in-right"></i> Get Started
        </a>
    </div>
</section>

<!-- Features -->
<section class="features">
    <div class="container">
        <div class="row g-4">

            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="bi bi-lightning-charge"></i>
                    <h5>Fast Messaging</h5>
                    <p>Send and receive messages instantly with high speed performance.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="bi bi-shield-lock"></i>
                    <h5>Secure Chat</h5>
                    <p>Your messages are protected with modern security standards.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="bi bi-people"></i>
                    <h5>Connect People</h5>
                    <p>Build connections and stay in touch with friends easily.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- About -->
<section class="about">
    <div class="container">
        <h2>About ChatBox</h2>
        <p>
            ChatBox is a lightweight and modern messaging platform focused on simplicity and speed.
            It helps users communicate in real-time with a clean and distraction-free interface.
        </p>
    </div>
</section>

@endsection
