@extends('layout',['title'=>'Saved Vehicles'])
@section('content')
<section class="page-heading"><div class="container"><p class="eyebrow">YOUR PERSONAL SHORTLIST</p><h1>Saved <span>vehicles.</span></h1><p>Your favorites are stored in this browser, ready when you are.</p></div></section><section class="container section"><div class="vehicle-grid">@foreach($cars as $car)<div x-show="saved.includes({{ $car['id'] }})" x-cloak>@include('components.vehicle-card')</div>@endforeach</div><div class="empty-state" x-show="!saved.length" x-cloak><span>♡</span><h2>Your next drive is waiting.</h2><p>Tap the heart on a vehicle to add it to your shortlist.</p><a class="button" href="{{ route('inventory') }}">Explore Inventory ↗</a></div></section>
@endsection
