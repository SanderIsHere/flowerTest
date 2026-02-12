<!-- extends primary layout -->
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">

      <!-- back to list button -->
      <div class="mb-3">
        <a href="{{ route('movies.searchAll') }}" class="btn btn-secondary">
          ← Back to Movies
        </a>
      </div>

      <!-- movie details -->
      <div class="card">
        <div class="card-header">
          <h3>{{ $movie['Title'] ?? 'Movie Detail' }}</h3>
        </div>
        <div class="card-body">

          <!-- Cek apakah data movie ada --}} -->
          @if(isset($movie['Title']))

          <div class="row">
            <!-- Kolom kiri: Poster --}} -->
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
                <strong>Year:</strong> {{ $movie['Year'] ?? 'N/A' }} |
                <strong>Rated:</strong> {{ $movie['Rated'] ?? 'N/A' }} |
                <strong>Runtime:</strong> {{ $movie['Runtime'] ?? 'N/A' }}
              </p>

              <hr>

              <!-- Genre -->
              <p>
                <strong>Genre:</strong>
                <span class="badge bg-primary">{{ $movie['Genre'] ?? 'N/A' }}</span>
              </p>

              <!-- Director -->
              <p><strong>Director:</strong> {{ $movie['Director'] ?? 'N/A' }}</p>

              <!-- Actors  -->
              <p><strong>Actors:</strong> {{ $movie['Actors'] ?? 'N/A' }}</p>

              <!-- -  Plot  -->
              <p><strong>Plot:</strong></p>
              <p class="text-justify">{{ $movie['Plot'] ?? 'No plot available.' }}</p>

              <!-- Ratings -->
              @if(isset($movie['Ratings']) && count($movie['Ratings']) > 0)
              <p><strong>Ratings:</strong></p>
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
                <strong>IMDb Rating:</strong>
                <span class="badge bg-warning text-dark">
                  ⭐ {{ $movie['imdbRating'] }}/10
                </span>
              </p>
              @endif

              <!-- IMDb Votes -->
              @if(isset($movie['imdbVotes']))
              <p>
                <strong>IMDb Votes:</strong> {{ $movie['imdbVotes'] }}
              </p>
              @endif

              <!-- Box Office -->
              @if(isset($movie['BoxOffice']) && $movie['BoxOffice'] != 'N/A')
              <p>
                <strong>Box Office:</strong> {{ $movie['BoxOffice'] }}
              </p>
              @endif

              <!-- awards -->
              @if(isset($movie['Awards']) && $movie['Awards'] != 'N/A')
              <p>
                <strong>Awards:</strong>
                <span class="text-success">🏆 {{ $movie['Awards'] }}</span>
              </p>
              @endif

            </div>
          </div>

          @else
          <!-- if movie not found or invalid -->
          <div class="alert alert-danger">
            Movie not found or invalid IMDb ID.
          </div>
          @endif

        </div>
      </div>

    </div>
  </div>
</div>
@endsection