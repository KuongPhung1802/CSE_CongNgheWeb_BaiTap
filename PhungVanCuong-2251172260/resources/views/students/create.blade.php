<h2>Sửa sinh viên</h2>

<form method="POST" action="{{ route('students.update', $student->id) }}">
    @csrf
    @method('PUT')

    <select name="school_id">
        @foreach($schools as $school)
            <option value="{{ $school->id }}"
                {{ $student->school_id == $school->id ? 'selected' : '' }}>
                {{ $school->name }}
            </option>
        @endforeach
    </select><br><br>

    <input name="full_name" value="{{ $student->full_name }}"><br><br>
    <input name="student_id" value="{{ $student->student_id }}"><br><br>
    <input name="email" value="{{ $student->email }}"><br><br>
    <input name="phone" value="{{ $student->phone }}"><br><br>

    <button>Cập nhật</button>
</form>
