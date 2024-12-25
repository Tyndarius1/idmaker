@extends('student-layouts.header')
@section('content')

<style>
    .pinakamain {
        display: flex;
        align-items: center;
        justify-content: space-around;
        gap: 60px;
    }
    .main-container {
        display: flex;
        flex-direction: column;
        width: 260px;
        height: 380px;
        background: #ffffff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
    }
    .main-one {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .main-two {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-right: 10px;
        margin: 20px 10px;
        color: whitesmoke;
    }
    .main-two .date p {
        margin-top: 36px;
    }
    .numcourse {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: white;
        position: absolute;
        bottom: 15%;
        padding-right: 161px;
    }
    .numcourse .course h5 {
        position: absolute;
        right: 3%;
        bottom: 0%;
    }
    .last {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: absolute;
        bottom: -10%;
        gap: 80%;
        margin: 6px;
    }
    .logo {
        text-align: center;
        margin: 10px 5px;
    }
    .logo img {
        width: 48px;
        height: 48px;
    }
    .logo p {
        font-size: 8px;
    }
    .qr-code img {
        width: 94px;
        height: 94px;
        position: absolute;
        top: 25%;
        left: 2%;
    }
    .signature img {
        width: 140px;
        height: 140px;
        position: absolute;
        top: 35%;
        left: 2%;
    }
    .image img {
        width: 250px;
        height: 250px;
        position: absolute;
        left: 20%;
        top: 2%;
    }
    .date p {
        font-size: 8px;
    }
    .last p {
        font-size: 8px;
    }
    .mainconsaubos {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 150px;
        background: #ff6f00;
        clip-path: polygon(0% 30%, 100% 0%, 100% 100%, 0% 100%);
    }
    #student_address {
        font-size: 10px;
    }
    #first_name {
        font-weight: bold;
    }
    .save-btn {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
    .save-btn button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }
    .save-btn button:hover {
        background-color: #45a049;
    }
    .upload-btn {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .upload-btn input[type="file"] {
        padding: 10px;
        cursor: pointer;
    }
</style>

<div class="container" style="margin-top: 3.5rem;">

    <div class="upload-btn">
        <input type="file" id="profile_image_upload" accept="image/*">
    </div>

    <form id="studentForm" method="POST" action="{{ route('create') }}" enctype="multipart/form-data">
        @csrf
        <div class="pinakamain">
            <div class="main-container">
                <div class="main-one">
                    <div class="one">
                        <div class="logo">
                            <img src="{{ asset('/images/MLG_Logo.19b958c1.png') }}" alt="">
                            <p>MLG COLLEGE <br> OF LEARNING,INC<br> Brgy.Atabay,Hilongos,Leyte</p>
                        </div>
                        <div class="qr-code">
                            <img id="qr_code_img" src="" alt="QR Code">
                        </div>
                    </div>
                    <div class="main-image">

                        <img id="profile_image"
                             src="{{ asset('storage/profile_images/' . (isset($student->profile_image) ? $student->profile_image : 'default.png')) }}"
                             alt="Profile Image">
                    </div>
                </div>
                <div class="mainconsaubos">
                    <div class="main-two">
                        <div class="date">
                            <p>Date of birth: <br><span id="birth_date"></span></p>
                        </div>
                        <div class="main-name">
                            <div class="name" id="first_name"></div>
                            <div class="brgy" id="student_address"></div>
                        </div>
                    </div>
                    <div class="numcourse">
                        <div class="number">
                            <h5 id="student_id"></h5>
                        </div>
                        <div class="course">
                            <h5 id="student_course"></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="save-btn">
            <button type="submit">Save Student Data</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.getElementById('profile_image_upload').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profile_image').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        const apiKey = @json(config('system.api_key') ?? '');
        if (!apiKey) {
            console.error('API key is missing.');
            return;
        }

        const url = new URL(window.location.href);
        const pathname = url.pathname;
        const studentId = pathname.split('/').pop();

        fetch('https://api-portal.mlgcl.edu.ph/api/external/student-list', {
            method: 'GET',
            headers: {
                'Origin': window.location.origin,
                'x-api-key': apiKey,
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            const student = data.data.find(student =>
                student.student_identification_number.some(idObj => idObj.student_id == studentId)
            );

            if (student) {
                document.getElementById('first_name').innerHTML = `
                    ${student.last_name.toUpperCase()}<br>
                    ${student.first_name.toUpperCase()} ${student.middle_name ? student.middle_name.charAt(0).toUpperCase() + '.' : ''}`;
                document.getElementById('student_address').textContent = `Brgy. ${student.address.barangay}, ${student.address.municipality}`;
                document.getElementById('birth_date').textContent = new Date(student.birthdate).toLocaleDateString();
                document.getElementById('student_id').textContent = student.student_identification_number[0].student_id;
                document.getElementById('student_course').textContent = student.course.code;

                document.getElementById('studentForm').insertAdjacentHTML('beforeend', `
                    <input type="hidden" name="student_id" value="${student.student_identification_number[0].student_id}">
                    <input type="hidden" name="first_name" value="${student.first_name}">
                    <input type="hidden" name="last_name" value="${student.last_name}">
                    <input type="hidden" name="address" value="Brgy. ${student.address.barangay}, ${student.address.municipality}">
                    <input type="hidden" name="birth_date" value="${student.birthdate}">
                    <input type="hidden" name="course" value="${student.course.code}">
                `);
            }
        });


        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @elseif(session('message'))
            Swal.fire({
                title: 'Info',
                text: '{{ session('message') }}',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>

@endsection
