      <?php wp_footer(); ?>

      <footer class="footer-section valign-wrapper">
        <div class="container-fluid">
          <p class="copyright">Copyright 2016 <?php bloginfo( 'name' ); ?> All Rights Reserved.</p>
          <p class="copyright">Theme by <a href="https://hodalog.com">Hoda</a>.</p>
        </div>
      </footer>

    <div id="scroll-to-top">
      <a href="#top">
        <div class="scroll-to-top-control-line"></div>
        <div class="scroll-to-top-control-line"></div>
      </a>
    </div>

    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/custom.js<?php echo '?' . date('Ymd'); ?>">
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

  </body>
</html>
