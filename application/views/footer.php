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

            </div>
        </footer>

    </div><!-- /main-wrapper -->

</div><!-- /page-wrapper -->

<!-- Bootstrap JS -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>
<script>$(function(){ $('.selectpicker').selectpicker(); });</script>
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

    /* Live clock update — runs every 30 s to stay accurate while avoiding unnecessary repaints */
    var clockEl = document.getElementById('topbar-time');
    if (clockEl) {
        function updateClock() {
            var now = new Date();
            var h = String(now.getHours()).padStart(2, '0');
            var m = String(now.getMinutes()).padStart(2, '0');
            clockEl.textContent = h + ':' + m;
        }
        updateClock();
        setInterval(updateClock, 30000);
    }
})();
</script>
</body>
</html>
