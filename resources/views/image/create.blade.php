@extends('layouts.main')

@section('main')
    <h2>Upload Image</h2>
    <br><br>

    <form method="POST" class="form" action="{{ route('image.store') }}" enctype="multipart/form-data">
        @csrf
        @method('post')
        
        @error('image')
            <small>{{ $message }}</small>
        @enderror
        <div class="field">
            <label>Image: </label>
            <input class="input" type="file" name="image" required>
        </div>

        <br><hr class="line"><br>

        @error('description')
            <small>{{ $message }}</small>
        @enderror
        <div class="field">
            <label>Description (optional): </label>
            <textarea class="input" name="description" cols="30" rows="3"></textarea>
        </div>

        <br><hr class="line"><br>

        @error('location')
            <small>{{ $message }}</small>
        @enderror
        <div class="field">
            <label>Location (optional): </label>
            <input class="input" type="text" name="location">
        </div>

        <br><hr class="line"><br>

        @error('date')
            <small>{{ $message }}</small>
        @enderror
        <div class="field">
            <label>Date (optional): </label>
            <input class="input" type="date" name="date">
        </div>

        <br><hr class="line"><br>

        <button type="submit">Update</button>
    </form>

    
@endsection