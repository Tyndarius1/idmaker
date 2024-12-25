@extends('student-layouts.header')

@section('content')

<div class="container" style="margin-top: 3.5rem;">

    <style>
        button {
            background-color: #4e45ff;
            border-radius: 10px;
            padding: 10px 16px;
        }
    </style>

    <div class="container mt-4">
        <h2>Student List</h2>
        <table id="student-table" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic rows will be appended here -->
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const apiKey = @json(config('system.api_key') ?? '');

            if (!apiKey) {
                console.error('API key is missing.');
                return; // Stop execution if no API key
            }

            fetch('https://api-portal.mlgcl.edu.ph/api/external/student-list', {
                method: 'GET',
                headers: {
                    'Origin': window.location.origin,
                    'x-api-key': apiKey,
                    'Content-Type': 'application/json'
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                const tableBody = document.querySelector('#student-table tbody');
                tableBody.innerHTML = ''; // Clear existing rows

                data.data.forEach(student => {
                    const row = `
                        <tr>
                            <td>${student.student_identification_number[0]?.student_id || 'N/A'}</td>
                            <td>${student.first_name}</td>
                            <td>${student.last_name}</td>
                            <td>
                                <button class="btn btn-primary create-id-btn" data-student-id="${student.student_identification_number[0]?.student_id}">
                                    Create ID
                                </button>
                            </td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });

                // Initialize DataTable
                $('#student-table').DataTable();

                // Attach event listener after table is populated
                document.querySelectorAll('.create-id-btn').forEach(button => {
                    button.addEventListener('click', function () {
                        const studentId = this.dataset.studentId;
                        const targetUrl = `/student-id/${studentId}`;
                        window.location.href = targetUrl;
                    });
                });
            })
            .catch(error => {
                console.error('Error fetching students:', error);
            });
        });
    </script>


@endsection
