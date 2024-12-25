@extends('admin-layouts.header')

@section('content')

<div class="container" style="margin-top: 3.5rem;">

    <h3 class="text-center mb-4">Students</h3>

    <div class="row justify-content-center">
        <!-- Loop through each student and display their profile image in a vertical column -->
        @foreach($students as $student)
            <div class="col-12 mb-4">
                <div class="card">
                    <img src="{{
                        $student->profile_image ? asset('storage/profile_images/' . $student->profile_image) : asset('storage/profile_images/default.png')
                    }}" alt="Profile Image" class="card-img-top" style="width: 100px; height: 100px; margin: 0 auto;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $student->first_name }} {{ $student->last_name }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection
