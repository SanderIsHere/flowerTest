<!-- buat extend layout utama dr php -->
@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">

      <!-- Card untuk form search -->
      <div class="card mb-4">
        <div class="card-header">{{ __('messages.search_movies') }}</div>
        <div class="card-body">
          {{-- Form search movies --}}
          <form action="{{ route('movies.searchAll') }}" method="GET">
            <div class="input-group">
              <!-- Input text untuk keyword -->
              <input
                type="text"
                name="search"
                class="form-control"
                placeholder="{{ __('messages.search_placeholder') }}"
                value="{{ $keysearch }}">

              <!-- submit button -->
              <button class="btn btn-primary" type="submit">{{ __('messages.search_button') }}</button>
            </div>
          </form>
        </div>
      </div>

      <!-- search result card -->
      <div class="card">
        <div class="card-header">
          {{ __('messages.search_results') }} "{{ $keysearch }}"
        </div>
        <div class="card-body">

          <!-- result checker -->
          @if(isset($movies['Search']) && count($movies['Search']) > 0)

          <!-- for show all movies in grid -->
          <div class="row">
            <!-- Loop semua movies  -->
            @foreach($movies['Search'] as $movie)
            <div class="col-md-3 mb-4">
              <div class="card h-100">
                <!-- Poster movie  -->
                <img
                  src="{{ $movie['Poster'] != 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x450?text=No+Poster' }}"
                  class="card-img-top"
                  alt="{{ $movie['Title'] }}">
                <div class="card-body">
                  <!-- Title -->
                  <h5 class="card-title">{{ $movie['Title'] }}</h5>
                  {{-- Year --}}
                  <p class="card-text">
                    <small class="text-muted">{{ $movie['Year'] }}</small>
                  </p>
                  <!-- Link to details -->
                  <a
                    href="{{ route('movies.movieDetail', $movie['imdbID']) }}"
                    class="btn btn-primary btn-sm">
                    {{ __('messages.view_detail') }}
                  </a>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          @else
          <!-- if result is nothing -->
          <div class="alert alert-warning">
            {{ __('messages.no_movies') }}
          </div>
          @endif

        </div>
      </div>

    </div>
  </div>
</div>
@endsection