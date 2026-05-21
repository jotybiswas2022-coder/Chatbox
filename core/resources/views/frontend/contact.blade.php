@extends('frontend.app')

@section('content')

    @if (session('success'))
        <div class="alert-success show" id="successAlert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @else
        <div class="alert-success" id="successAlert">
            <i class="bi bi-check-circle-fill"></i> Your message was sent successfully!
        </div>
    @endif

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
                    <form id="contactForm" action="{{ route('contact') }}" method="POST">
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

            fetch("{{ route('contact') }}", {
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

@endsection
