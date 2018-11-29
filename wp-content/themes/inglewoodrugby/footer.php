<section class="sponsors-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 nopadding">
                <h2>Thank you to our sponsors</h2>
                <p>If you are interested in becoming a sponsor, <a href="' . get_page_link(54) . '">click here</a></p>
                <?=do_shortcode('[sponsors]')?>
            </div>
        </div>
    </div>
</section>
<section class="google-map">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 nopadding">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3093.8965775582715!2d174.21056991571822!3d-39.15433387953186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d1454ea259f46cd%3A0xc4665480db32820d!2sTET+Stadium+%26+Events+Centre!5e0!3m2!1sen!2snz!4v1543268567995" width="2000" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
<section id="copyright">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                &copy; Copyright <?=date('Y')?> <?=get_bloginfo('name')?> <i>-</i> <span>Website by <a href="https://www.azwebsolutions.co.nz/" target="_blank">A-Z Web Solutions Ltd</a></span>
            </div>
        </div>
    </div>
</section>
<?php wp_footer(); ?>
</body>
</html>