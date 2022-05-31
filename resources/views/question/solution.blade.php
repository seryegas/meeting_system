<h3 class="mt-2 ms-3">Добавить решение</h3>
<form class="ms-3" method="POST" action="{{ route('store_solution') }}">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control mt-3" name="solution_desc" placeholder="Решили:">
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control" value="{{ $question->question_id }}" name="question_id" >
    </div>
    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif
    @error('any')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
    @enderror
    <button type="submit" class="btn btn-primary mt-3">Добавить решение</button>
</form>