@extends('layouts.app')

@section('title', 'DIGIon 2026 — Digital Innovation Competition | BINUS University Malang')

@section('content')
    {{-- Hero Section --}}
    @include('components.hero')

    {{-- Section Divider --}}
    <div class="section-divider"></div>

    {{-- About Section --}}
    @include('partials.about-section')

    <div class="section-divider"></div>

    {{-- Competition Categories --}}
    @include('partials.categories-section')

    <div class="section-divider"></div>

    {{-- Timeline --}}
    @include('partials.timeline-section')

    <div class="section-divider"></div>

    {{-- Prize Pool --}}
    @include('partials.prizes-section')

    <div class="section-divider"></div>

    {{-- FAQ --}}
    @include('partials.faq-section')

    <div class="section-divider"></div>

    {{-- Sponsors --}}
    @include('partials.sponsors-section')

    <div class="section-divider"></div>

    {{-- Contact / CTA --}}
    @include('partials.contact-section')
@endsection

@section('mobile-cta')
    <a href="{{ route('register') }}" class="block text-center px-5 py-2.5 text-sm font-semibold rounded btn-primary">
        Register Now
    </a>
@endsection
