@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Create Event</h2>
    <form>
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Event Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter event title">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Optional"></textarea>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date & Time</label>
            <input type="datetime-local" class="form-control" id="date" name="date">
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Enter location">
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" min="1" max="1000">
        </div>

        <div class="mb-3">
            <label for="image_path" class="form-label">Image URL</label>
            <input type="url" class="form-control" id="image_path" name="image_path" placeholder="https://example.com/image.jpg">
        </div>

        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>
@endsection