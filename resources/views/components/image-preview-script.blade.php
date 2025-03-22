@props(['target' => null])

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            document.querySelector('.profile-image').src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
        
        @if($target)
        // ファイル名を表示
        document.getElementById('{{ $target }}').textContent = input.files[0].name;
        @endif
    }
}
</script> 