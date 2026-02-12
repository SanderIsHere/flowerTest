<!-- extends primary layout -->
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">

      <!-- back to list button -->
      <div class="mb-3">
        <a href="{{ route('movies.searchAll') }}" class="btn btn-secondary">
          ← {{ __('messages.back_to_movies') }}
        </a>
      </div>

      <!-- movie details -->
      <div class="card">
        <div class="card-header">
          <h3>{{ $movie['Title'] ?? __('messages.movie_detail') }}</h3>
        </div>
        <div class="card-body">

          <!-- Cek apakah data movie ada -->
          @if(isset($movie['Title']))

          <div class="row">
            <!-- Kolom kiri: Poster -->
            <div class="col-md-4">
              <img
                src="{{ $movie['Poster'] != 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x450?text=No+Poster' }}"
                class="img-fluid rounded"
                alt="{{ $movie['Title'] }}">
            </div>

            <!-- Kolom kanan: Detail Info -->
            <div class="col-md-8">
              <h2>{{ $movie['Title'] }}</h2>

              <!-- Year, Rating, Runtime  -->
              <p class="text-muted">
                <strong>{{ __('messages.year') }}:</strong> {{ $movie['Year'] ?? __('messages.not_available') }} |
                <strong>{{ __('messages.rated') }}:</strong> {{ $movie['Rated'] ?? __('messages.not_available') }} |
                <strong>{{ __('messages.runtime') }}:</strong> {{ $movie['Runtime'] ?? __('messages.not_available') }}
              </p>

              <hr>

              <!-- Genre -->
              <p>
                <strong>{{ __('messages.genre') }}:</strong>
                <span class="badge bg-primary">{{ $movie['Genre'] ?? __('messages.not_available') }}</span>
              </p>

              <!-- Director -->
              <p><strong>{{ __('messages.director') }}:</strong> {{ $movie['Director'] ?? __('messages.not_available') }}</p>

              <!-- Actors  -->
              <p><strong>{{ __('messages.actors') }}:</strong> {{ $movie['Actors'] ?? __('messages.not_available') }}</p>

              <!-- Plot  -->
              <p><strong>{{ __('messages.plot') }}:</strong></p>
              <p class="text-justify">{{ $movie['Plot'] ?? __('messages.no_plot') }}</p>

              <!-- Ratings -->
              @if(isset($movie['Ratings']) && count($movie['Ratings']) > 0)
              <p><strong>{{ __('messages.ratings') }}:</strong></p>
              <ul class="list-unstyled">
                @foreach($movie['Ratings'] as $rating)
                <li>
                  <strong>{{ $rating['Source'] }}:</strong> {{ $rating['Value'] }}
                </li>
                @endforeach
              </ul>
              @endif

              <!-- IMDb Rating  -->
              @if(isset($movie['imdbRating']))
              <p>
                <strong>{{ __('messages.imdb_rating') }}:</strong>
                <span class="badge bg-warning text-dark">
                  ⭐ {{ $movie['imdbRating'] }}/10
                </span>
              </p>
              @endif

              <!-- IMDb Votes -->
              @if(isset($movie['imdbVotes']))
              <p>
                <strong>{{ __('messages.imdb_votes') }}:</strong> {{ $movie['imdbVotes'] }}
              </p>
              @endif

              <!-- Box Office -->
              @if(isset($movie['BoxOffice']) && $movie['BoxOffice'] != 'N/A')
              <p>
                <strong>{{ __('messages.box_office') }}:</strong> {{ $movie['BoxOffice'] }}
              </p>
              @endif

              <!-- awards -->
              @if(isset($movie['Awards']) && $movie['Awards'] != 'N/A')
              <p>
                <strong>{{ __('messages.awards') }}:</strong>
                <span class="text-success">🏆 {{ $movie['Awards'] }}</span>
              </p>
              @endif

            </div>
          </div>

          @else
          <!-- if movie not found or invalid -->
          <div class="alert alert-danger">
            {{ __('messages.movie_not_found') }}
          </div>
          @endif

        </div>
      </div>

    </div>
  </div>
</div>
@endsection