<div id="block-loading" class="d-none">
    <div class="fa-5x">
        <i class="fas fa-spinner fa-pulse"></i>
    </div>
</div>
<script>
    let loading = document.getElementById('block-loading');
    function showLoading()
    {
        loading.classList.remove('d-none');
    }

    function hideLoading()
    {
        loading.classList.add('d-none');
    }
</script>
