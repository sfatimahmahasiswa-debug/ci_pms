        <!-- /page-content -->
        </div>

        <!-- Footer -->
        <footer id="footer">
            <div class="footer-inner">
                <div class="footer-brand">
                    <i class="fa fa-medkit"></i>
                    Klinik Harmy Medika
                </div>
                <div class="footer-copy">
                    &copy; <?php echo date('Y'); ?> SCM &amp; CRM Harmy Medika &mdash; Semua hak dilindungi
                </div>
                <div class="footer-links">
                    <a href="<?php echo base_url(); ?>Main/enter"><i class="fa fa-home"></i> Dashboard</a>
                    <a href="<?php echo base_url(); ?>ShowForm/doctor/main"><i class="fa fa-user-md"></i> Antrean</a>
                    <a href="<?php echo base_url(); ?>main/logout"><i class="fa fa-sign-out-alt"></i> Keluar</a>
                </div>
            </div>
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

    /* Live clock update */
    var clockEl = document.getElementById('topbar-time');
    if (clockEl) {
        setInterval(function () {
            var now = new Date();
            var h = String(now.getHours()).padStart(2, '0');
            var m = String(now.getMinutes()).padStart(2, '0');
            clockEl.textContent = h + ':' + m;
        }, 10000);
    }
})();
</script>
</body>
</html>
