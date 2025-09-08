@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Edit Event</h2>
    <form id="edit_form" method="POST" action="{{ route('events.update', $event->id) }}">
        @csrf
        <!-- change the method -->
        @method('PUT')

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label"><span class="text-danger">*</span>Event Title</label>
            <input type="text"
                class="form-control @error('title') is-invalid @enderror"
                id="title"
                name="title"
                value="{{ old('title', $event->title) }}"
                placeholder="Enter event title">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control"
                id="description"
                name="description"
                rows="3"
                placeholder="Optional">{{ old('description', $event->description) }}</textarea>
        </div>
        <!-- Date & Time -->
        <div class="mb-3">
            <label for="date" class="form-label"><span class="text-danger">*</span>Date & Time</label>
            <input type="datetime-local"
                class="form-control @error('date_time') is-invalid @enderror"
                id="date_time"
                name="date_time"
                value="{{ old('date_time', $event->date_time) }}">
            @error('date_time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <!-- Location -->
        <div class="mb-3">
            <label for="location" class="form-label"><span class="text-danger">*</span>Location</label>
            <input type="text"
                class="form-control @error('location') is-invalid @enderror"
                id="location"
                name="location"
                value="{{ old('location', $event->location) }}"
                placeholder="Enter location">
            @error('location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <!-- Capacity -->
        <div class="mb-3">
            <label for="capacity" class="form-label"><span class="text-danger">*</span>Capacity (between 1 and 1000)</label>
            <input type="number"
                class="form-control @error('capacity') is-invalid @enderror"
                id="capacity"
                name="capacity"
                value="{{ old('capacity', $event->capacity) }}"
                min="1" max="1000">
            @error('capacity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <!-- Image Path -->
        <div class="mb-3">
            <label for="image_path" class="form-label">Image URL</label>
            <input type="url"
                class="form-control @error('image_path') is-invalid @enderror"
                id="image_path"
                name="image_path"
                value="{{ old('image_path', $event->image_path) }}"
                placeholder="https://example.com/image.jpg">
            @error('image_path')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <!-- Categories -->
        <div class="mb-3">
            <label class="form-label"><span class="text-danger">*</span>Categories</label>
            <div class="d-flex flex-wrap gap-3">
                @foreach($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input"
                            type="checkbox"
                            id="category_{{ $category->id }}"
                            name="categories[]"
                            value="{{ $category->id }}"
                            {{ in_array($category->id, old('categories', $event->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                        <label class="form-check-label" for="category_{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('categories')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let formChanged = false;
    const form = document.getElementById('edit_form');

    // detect changes in the form
    form.addEventListener('input', () => {
        formChanged = true;
    });

    // remind before leaving the page if there are unsaved changes
    window.addEventListener('beforeunload', function (e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // If the form is actually submitted, no need to prompt
    form.addEventListener('submit', () => {
        formChanged = false;
    });
});
</script>
@endsection