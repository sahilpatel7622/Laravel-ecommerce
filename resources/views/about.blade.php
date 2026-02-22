@extends('common')
@section('content')

<!-- Web Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<!-- Bootstrap Icons if not already available -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4338ca 0%, #6366f1 100%);
        --secondary-gradient: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        --dark-glass: rgba(15, 23, 42, 0.7);
        --light-glass: rgba(255, 255, 255, 0.85);
        --font-heading: 'Outfit', sans-serif;
        --font-body: 'Inter', sans-serif;
    }

    body {
        font-family: var(--font-body);
        background-color: #f8fafc;
    }

    .heading-font {
        font-family: var(--font-heading);
    }

    /* Hero Section */
    .about-hero {
        position: relative;
        min-height: 50vh;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-top: -1.5rem; /* Adjust if common header has margin */
    }

    .about-hero::before {
        content: '';
        position: absolute;
        width: 150%;
        height: 150%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
        top: -25%;
        left: -25%;
        animation: pulseBlob 15s infinite alternate ease-in-out;
    }

    .about-hero::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
        background: linear-gradient(to top, #f8fafc, transparent);
        z-index: 1;
    }

    @keyframes pulseBlob {
        0% { transform: scale(1) translate(0, 0); }
        50% { transform: scale(1.1) translate(5%, 5%); }
        100% { transform: scale(0.9) translate(-5%, -5%); }
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        letter-spacing: -1.5px;
        margin-bottom: 1rem;
        text-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .hero-subtitle {
        font-size: 1.25rem;
        font-weight: 300;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Story Section */
    .story-section {
        padding: 5rem 0;
        background-color: #f8fafc;
    }

    .about-glass-card {
        background: var(--light-glass);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 1.5rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        padding: 3rem;
        position: relative;
        overflow: hidden;
    }

    .about-glass-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--secondary-gradient);
    }

    /* Values Section */
    .values-section {
        padding: 5rem 0;
        background-color: #ffffff;
        position: relative;
        z-index: 1;
    }

    .value-card {
        background: #ffffff;
        border-radius: 1rem;
        padding: 2.5rem 2rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .value-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        border-color: transparent;
    }

    .icon-box {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        margin-bottom: 1.5rem;
        transition: transform 0.5s ease;
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
    }

    .value-card:hover .icon-box {
        transform: rotateY(180deg);
    }

    .value-card h4 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1rem;
        font-family: var(--font-heading);
    }

    .value-card p {
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* Stats Section */
    .stats-container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 2rem;
        margin-top: 4rem;
        padding: 3rem 0;
        border-top: 1px solid #e2e8f0;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-family: var(--font-heading);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 1rem;
        color: #64748b;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* CTA Section */
    .cta-section {
        padding: 6rem 0;
        background: #0f172a;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 50% 150%, rgba(99, 102, 241, 0.4) 0%, transparent 60%);
        pointer-events: none;
    }

    .cta-title {
        font-size: 2.5rem;
        font-weight: 700;
        font-family: var(--font-heading);
        margin-bottom: 1.5rem;
    }

    .btn-premium {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 3rem;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
    }

    .btn-premium:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
        color: white;
    }

    .btn-premium i {
        transition: transform 0.3s ease;
    }

    .btn-premium:hover i {
        transform: translateX(5px);
    }

    /* Section Title */
    .section-title {
        text-align: center;
        margin-bottom: 4rem;
    }

    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #0f172a;
        font-family: var(--font-heading);
        margin-bottom: 1rem;
    }

    .section-title p {
        color: #64748b;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }
</style>

<!-- Hero Section -->
<div class="about-hero">
    <div class="container hero-content">
        <h1 class="hero-title heading-font animate__animated animate__fadeInDown">Elevating Your Lifestyle</h1>
        <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">We are more than just a marketplace. We are a destination for premium products that redefine everyday living.</p>
    </div>
</div>

<!-- Story Section -->
<div class="story-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="about-glass-card">
                    <div class="row align-items-center">
                        <div class="col-md-5 mb-4 mb-md-0 d-flex justify-content-center">
                            <img src="https://placehold.co/800x600/4338ca/ffffff?text=Our+Journey" alt="Our Workspace" class="img-fluid rounded-4 shadow-sm" style="max-height: 350px; object-fit: cover;">
                        </div>
                        <div class="col-md-7 px-md-5">
                            <h3 class="heading-font fw-bold text-dark mb-3 fs-2">Our Journey</h3>
                            <p class="text-muted mb-4 fs-6" style="line-height: 1.8;">
                                Founded with a passion for excellence, our mission has always been to bridge the gap between quality and accessibility. We curate the finest products, from cutting-edge electronics to lifestyle essentials, ensuring every item meets our rigorous standards.
                            </p>
                            <p class="text-muted mb-0 fs-6" style="line-height: 1.8;">
                                What started as a small idea has grown into a trusted platform for thousands of customers worldwide. We believe in transparency, innovation, and putting our community first.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="stats-container">
                    <div class="stat-item">
                        <div class="stat-number">20K+</div>
                        <div class="stat-label">Happy Customers</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">99%</div>
                        <div class="stat-label">Satisfaction Rate</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Expert Support</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Values Section -->
<div class="values-section">
    <div class="container">
        <div class="section-title">
            <h2>Why Choose Us</h2>
            <p>We combine exceptional product quality with unparalleled customer service to deliver the best shopping experience.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="value-card">
                    <div class="icon-box">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4>Premium Quality</h4>
                    <p>Every product is handpicked and thoroughly vetted to ensure it meets our uncompromising standards of excellence.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="value-card">
                    <div class="icon-box">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h4>Fast Delivery</h4>
                    <p>We value your time. Our streamlined fulfillment network ensures your orders reach your doorstep in record time.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="value-card">
                    <div class="icon-box">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h4>24/7 Support</h4>
                    <p>Our dedicated support team is always ready to assist you round the clock, ensuring a seamless shopping experience.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="cta-section">
    <div class="container position-relative" style="z-index: 2;">
        <h2 class="cta-title">Ready to Experience the Best?</h2>
        <p class="lead mb-5 text-light" style="opacity: 0.8; max-width: 600px; margin: 0 auto;">Join our community of satisfied customers and discover products that elevate your everyday life.</p>
        <a href="{{ route('products') }}" class="btn-premium">
            Explore Collection <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>

@endsection
