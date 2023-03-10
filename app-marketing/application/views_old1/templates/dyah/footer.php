 </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">

          <div class="rightbar-title">
            <a href="javascript:void(0);" class="right-bar-toggle float-right">
              <i class="dripicons-cross noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
          </div>

          <div class="slimscroll-menu rightbar-content">

            <div class="p-1">
              <div class="alert alert-primary" role="alert">
                <strong>Customize </strong> the overall color scheme, layout, sidebar menu, etc. Note that, Hyper stores the preferences in local storage.
              </div>
            </div>

            <!-- Settings -->
            <h5 class="pl-2">Color Scheme</h5>
            <hr class="mb-0" />

            <div class="p-2">
              <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light" id="light-mode-check" checked />
                <label class="custom-control-label" for="light-mode-check">Light Mode</label>
              </div>

              <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark" id="dark-mode-check" />
                <label class="custom-control-label" for="dark-mode-check">Dark Mode</label>
              </div>
            </div>

            <h5 class="pl-2">Layout</h5>
            <hr class="mb-0" />

            <div class="p-2">
              <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="layout" value="vertical" id="vertical-check" checked />
                <label class="custom-control-label" for="vertical-check">Vertical Layout (Default)</label>
              </div>

              <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="layout" value="horizontal" id="horizontal-check" />
                <label class="custom-control-label" for="horizontal-check">Horizontal Layout</label>
              </div>

              <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="layout" value="detached" id="detached-check" />
                <label class="custom-control-label" for="detached-check">Detached Layout</label>
              </div>
            </div>

            <h5 class="pl-2">Width</h5>
            <hr class="mb-0" />
            <div class="p-2">
              <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="width" value="fluid" id="fluid-check" checked />
                <label class="custom-control-label" for="fluid-check">Fluid</label>
              </div>
              <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="width" value="boxed" id="boxed-check" />
                <label class="custom-control-label" for="boxed-check">Boxed</label>
              </div>
            </div>

            <h5 class="pl-2">Left Sidebar</h5>
            <hr class="mb-0" />

            <div class="p-2">
              <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="theme" value="default" id="default-check" checked />
                <label class="custom-control-label" for="default-check">Default</label>
              </div>

              <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="theme" value="light" id="light-check" />
                <label class="custom-control-label" for="light-check">Light</label>
              </div>

              <div class="custom-control custom-switch mb-3">
                <input type="radio" class="custom-control-input" name="theme" value="dark" id="dark-check" />
                <label class="custom-control-label" for="dark-check">Dark</label>
              </div>

              <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="compact" value="fixed" id="fixed-check" checked />
                <label class="custom-control-label" for="fixed-check">Fixed</label>
              </div>

              <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="compact" value="condensed" id="condensed-check" />
                <label class="custom-control-label" for="condensed-check">Condensed</label>
              </div>

              <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="compact" value="scrollable" id="scrollable-check" />
                <label class="custom-control-label" for="scrollable-check">Scrollable</label>
              </div>
            </div>

            <div class="p-2 text-center">
              <button class="btn btn-primary btn-block" id="resetBtn">Reset to Default</button>
            </div>
          </div>
        </div>

        <div class="rightbar-overlay"></div>
        <!-- /Right-bar -->


        <!-- bundle -->
        <script src="assets/hyper/js/app.min.js"></script>

        <!-- third party js -->
        <script src="assets/hyper/js/vendor/Chart.bundle.min.js"></script>
        <script src="assets/hyper/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="assets/hyper/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="assets/hyper/js/pages/demo.dashboard.js"></script>
        <!-- end demo js-->
    </body>

</html>