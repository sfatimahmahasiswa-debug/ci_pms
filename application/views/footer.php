        <!-- /page-content -->
        </div>

        <!-- Footer -->
        <footer id="footer">
            <p>&copy; SCM &amp; CRM Harmy Medika &nbsp;|&nbsp; <?php echo date('Y'); ?></p>
        </footer>

    </div><!-- /main-wrapper -->

</div><!-- /page-wrapper -->

<!-- Bootstrap JS -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script>
(function () {
    var sidebar   = document.getElementById('sidebar');
    var mainWrap  = document.getElementById('main-wrapper');
    var overlay   = document.getElementById('sidebar-overlay');
    var toggleBtn = document.getElementById('sidebar-toggle');

    if (!toggleBtn || !sidebar) return;

    var MOBILE_BP = 767;

    function isMobile() { return window.innerWidth <= MOBILE_BP; }

    toggleBtn.addEventListener('click', function () {
        if (isMobile()) {
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('active');
        } else {
            sidebar.classList.toggle('collapsed');
            mainWrap.classList.toggle('expanded');
        }
    });

    if (overlay) {
        overlay.addEventListener('click', function () {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
        });
    }
})();
</script>
</body>
</html>
