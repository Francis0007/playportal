<!-- view_uploaded_app.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>View Uploaded App</h1>
        @if($app)
            <div>
                <h2>{{ $app->app_name }}</h2>
                <p>Category: {{ $app->app_cat }}</p>
                <p>Operating System: {{ $app->app_os }}</p>
                <p>Description: {{ $app->app_desc }}</p>
                <p>Owner: {{ $app->app_owner }}</p>
                <p>Email: {{ $app->owner_email }}</p>
                <p>Number: {{ $app->owner_number }}</p>
                <img src="{{ asset($app->icon_picture) }}" alt="Icon Picture">
                <img src="{{ asset($app->feature_picture) }}" alt="Feature Picture">
                <h3>Gameplay Screenshots:</h3>
                @foreach(json_decode($app->gameplay_screenshots) as $screenshot)
                    <img src="{{ asset($screenshot) }}" alt="Gameplay Screenshot">
                @endforeach
                <p>Compressed File: <a href="{{ route('file.download', ['filePath' => $app->compressed_file]) }}">Download</a></p>
            </div>
        @else
            <p>No app found.</p>
        @endif
    </div>
@endsection
