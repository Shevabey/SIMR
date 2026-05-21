</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('sidebarDropdownBtn');
    const sidebar = document.querySelector('.sidebar');
    if (!btn || !sidebar) return;

    btn.addEventListener('click', function () {
        sidebar.classList.toggle('mobile-open');
    });
});
</script>

</body>

</html>
