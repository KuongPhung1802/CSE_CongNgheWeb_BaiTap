<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sinh viên</title>
</head>
<body>

<h2>Danh sách sinh viên</h2>
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<a href="{{ route('students.create') }}">➕ Thêm sinh viên</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>MSSV</th>
        <th>Email</th>
        <th>Trường</th>
        <th>Hành động</th>
    </tr>

    @foreach($students as $student)
    <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->full_name }}</td>
        <td>{{ $student->student_id }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->school->name }}</td>
        <td>
            <a href="{{ route('students.edit', $student->id) }}">✏️ Sửa</a>

            <form action="{{ route('students.destroy', $student->id) }}"
                  method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Xóa sinh viên?')">🗑 Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<br>
{{ $students->links() }}

</body>
</html>
