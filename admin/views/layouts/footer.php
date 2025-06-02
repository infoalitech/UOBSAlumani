</div> <!-- Close container -->

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

  <script src="<?= $basePath ?>/assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $basePath ?>/assets/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= $basePath ?>/assets/assets/vendor/aos/aos.js"></script>
  <script src="<?= $basePath ?>/assets/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= $basePath ?>/assets/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= $basePath ?>/assets/assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <!-- Main JS File -->
  <script src="<?= $basePath ?>/assets/assets/js/main.js"></script>

<style>
    .dropdown-menu-custom {
        display: none;
        position: absolute;
        background-color: #fff;
        box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        padding: 0.5rem 0;
        margin-top: 5px;
        list-style: none;
        border-radius: 4px;
        z-index: 1000;
    }

    .dropdown-menu-custom li {
        padding: 0.5rem 1rem;
    }

    .dropdown-menu-custom li:hover {
        background-color: #f8f9fa;
    }
</style>
<script>
    function setupDropdown(toggleId, menuId) {
        const btn = document.getElementById(toggleId);
        const menu = document.getElementById(menuId);

        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            const isOpen = menu.style.display === 'block';
            document.querySelectorAll('.dropdown-menu-custom').forEach(m => m.style.display = 'none');
            menu.style.display = isOpen ? 'none' : 'block';
        });

        document.addEventListener('click', function (e) {
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.style.display = 'none';
            }
        });
    }

    // Set up custom dropdowns
    setupDropdown('jobDropdownCustom', 'jobDropdownMenuCustom');
    setupDropdown('blogDropdownCustom', 'blogDropdownMenuCustom');
    setupDropdown('userDropdownCustom', 'userDropdownMenuCustom');
</script>



</body>
</html>
