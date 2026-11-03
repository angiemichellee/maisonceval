@extends('layouts.app')

@section('title', 'Catalogs · Maison Céval')
@section('description', 'Browse the Maison Céval catalogs: the Everyday Menu and our seasonal collections.')

@section('content')

    <section class="page-hero">
        <div class="container">
            <p class="eyebrow eyebrow--center">Our catalogs</p>
            <h1 class="page-hero__title">Choose a catalog</h1>
            <p class="page-hero__lead">Our everyday signatures, plus limited collections for the special moments of the year.</p>
        </div>
    </section>

    <section class="section section--flush-top">
        <div class="container">
            @if ($catalogs->isEmpty())
                <p class="empty-state">New catalogs are coming soon.</p>
            @else
                <div class="catalog-cards">
                    @foreach ($catalogs as $catalog)
                        <x-catalog-card :catalog="$catalog" />
                    @endforeach
                </div>
            @endif

            <p class="catalogs-note">
                Looking for everything in one place?
                <a href="{{ route('menu') }}" class="link-arrow">See the full menu <span aria-hidden="true">&rarr;</span></a>
            </p>
        </div>
    </section>

@endsection
