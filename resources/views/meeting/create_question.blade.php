<h3 class="mt-2">Добавить вопрос</h3>
<form method="POST" action="{{ route('store_question') }}">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control mt-3" name="question_name" placeholder="Вопрос">
    </div>
    <select class="form-control mt-3" name="user_id">
        <option disabled selected>Выберите сотрудника</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}
            </option>
        @endforeach
    </select>
    <div class="form-group">
        <input type="hidden" class="form-control" value="{{ $meeting->meeting_id }}" name="meeting_id" >
    </div>
    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif
    @error('any')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
    @enderror
    <button type="submit" class="btn btn-primary mt-3">Создать</button>
</form>