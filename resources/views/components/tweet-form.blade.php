@props(['tweet' => null, 'categories', 'actionRoute'])

<form action="{{ $actionRoute }}" method="POST">
    @csrf
    @if($tweet) @method('PUT') @endif
    
    <x-form-errors />
    
    <div class="mb-3">
        <textarea 
            name="content" 
            class="form-control border-0" 
            placeholder="今何してる？"
            rows="3" 
            required
            maxlength="255"
        >{{ old('content', $tweet ? $tweet->content : '') }}</textarea>
        <div class="form-text text-end">
            <span id="charCount">0</span>/255
        </div>
    </div>
    
    <div class="mb-3">
        <label for="category_id" class="form-label">カテゴリ</label>
        <select name="category_id" id="category_id" class="form-select">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" 
                    {{ old('category_id', $tweet ? $tweet->category_id : '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="d-grid">
        {{ $slot }}
    </div>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.querySelector('textarea[name="content"]');
        const charCount = document.getElementById('charCount');
        
        function updateCount() {
            const count = textarea.value.length;
            charCount.textContent = count;
            
            if (count > 240) {
                charCount.classList.add('text-warning');
            } else {
                charCount.classList.remove('text-warning');
            }
            
            if (count > 255) {
                charCount.classList.add('text-danger');
            } else {
                charCount.classList.remove('text-danger');
            }
        }
        
        textarea.addEventListener('input', updateCount);
        updateCount(); // 初期表示時にも実行
    });
</script>
@endpush 