<h1>Listings<h1>
    @if (count($listings) == 0)
        <p>No Listings Found</p>
    @else
        @foreach ($listings as $listing)
        <h3>{{ $listing->title }}</h3>
        <p>{{ $listing->description }}</p>
    @endforeach
    @endif
    