<?php /* footer.php */ ?>

<footer>
    <div class="container">
        <div class="row row-cols-1 d-flex justify-content-center">
            <div class="col">
                <div class="footer-box">
                    <span class="material-icons">mail_outline</span>
                    <p class="icon-text">info@dtema.com</p>
                </div>
                <div class="footer-box">
                    <span class="material-icons">room</span>
                    <p class="icon-text">Ulica Ivana Horvata 18/a 10000 Zagreb</p>
                </div>
                <div class="footer-box">
                    <a href="https://www.facebook.com/" target="_blank">
                        <img class="fb-logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/Facebook.png" alt="">
                    </a>
                    <a href="https://www.instagram.com/" target="_blank">
                        <img class="insta-logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/Instagram.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© <?php echo date("Y"); ?> dTema</p>
    </div>
</footer>

<?php wp_footer(); ?>


</body>
</html>