@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/contact.css') }}">
@endpush
@section('content')
    <div class="img-decorate !p-0 !m-0">
        <div class="img-deco !h-96 !bg-center" style="background-image: url({{ asset('asset/img/contact2.jpg') }});">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-7xl text-white">
                CONTACT
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        <section>
            <div class="contact-section">
                <h1>FEEL FREE TO CONTACT US</h1>
                <p>Elementum nisi quis eleifend quam adipiscing vitae proin sagittis nisl.</p>
                <form action="#" method="POST" class="form-wrapper">
                    <div class="form-row">
                        <div class="field-container">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="field-container">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="field-container">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Send</button>
                </form>
            </div>
            <div class="column map-section">
                <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3021.998874706762!2d-74.00397452415491!3d40.72500517206925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259af18b67b4d%3A0xefe2c682f8eafe9b!2s3%20Wakehurst%20St%2C%20New%20York%2C%20NY%2010002!5e0!3m2!1sen!2sus!4v1697032822654!5m2!1sen!2sus"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </section>
        <section>
            <div class="service">
                <div class="service1">
                    <img src="asset/img/contact3.jpg" alt="">
                </div>
                <div class="service1">
                    <img src="asset/img/contact5.jpg" alt="">
                </div>
                <div class="service1 service2">
                    <!-- <img src="assets/img/new4.jpg" alt=""> -->
                    <h2>Folow our <br> Instagram</h2>

                </div>
                <div class="service1">
                    <img src="asset/img/contact7.jpg" alt="" >

                </div>
                <div class="service1">
                    <img src="asset/img/contact8.jpg" alt="">

                </div>

            </div>
        </section>
    </div>
@endsection
