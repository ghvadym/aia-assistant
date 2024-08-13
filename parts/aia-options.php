<div class="wrap">
    <h2><?php echo get_admin_page_title() ?></h2>

    <form method="post" action="options.php">
        <?php
        settings_fields(AIA_SETTINGS_FIELDS);
        do_settings_sections(AIA_SETTINGS_FIELDS);

        /* Fields */
        include AIA_Helper::get_path('parts/aia-options-fields');

        submit_button();
        ?>
    </form>
</div>