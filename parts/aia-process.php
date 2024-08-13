<?php
$post = get_post();
?>

<div class="aia">
    <div class="aia__container">
        <div class="aia_form__fields">
            <div class="aia_form__fow">
                <label for="aia-topic">
                    <?php _e('Topic', AIA_DOMAIN); ?>*
                </label>
                <input type="text" id="aia-topic" name="aia-topic" placeholder="<?php _e('Put a Topic', AIA_DOMAIN); ?>">
            </div>
            <div class="aia_form__fow">
                <label for="aia-keywords">
                    <?php _e('Keywords', AIA_DOMAIN); ?>
                </label>
                <input type="text" id="aia-keywords" name="aia-keywords" placeholder="<?php _e('Put Keywords', AIA_DOMAIN); ?>">
            </div>
            <div class="aia_form__fow">
                <label for="aia-tone-voice">
                    <?php _e('Tone of Voice', AIA_DOMAIN); ?>
                </label>
                <input type="text" id="aia-tone-voice" name="aia-tone-voice" placeholder="<?php _e('Put Tone of Voice', AIA_DOMAIN); ?>">
            </div>
            <?php if (!empty(AIA_Helper::point_of_view_list())) { ?>
                <div class="aia_form__fow">
                    <label for="aia-point-of-view">
                        <?php _e('Point of View', AIA_DOMAIN); ?>
                    </label>
                    <select name="aia-point-of-view" id="aia-point-of-view">
                        <option value="">
                            <?php _e('Choose Point of View...', AIA_DOMAIN); ?>
                        </option>
                        <?php foreach (AIA_Helper::point_of_view_list() as $key => $val) { ?>
                            <option value="<?php echo esc_attr($key); ?>">
                                <?php echo esc_html($val); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            <?php } ?>
            <?php if (!empty(AIA_Helper::languages_list())) { ?>
                <div class="aia_form__fow">
                    <label for="aia-language">
                        <?php _e('Language', AIA_DOMAIN); ?>
                    </label>
                    <select name="aia-language" id="aia-language">
                        <option value="">
                            <?php _e('Select Language...', AIA_DOMAIN); ?>
                        </option>
                        <?php foreach (AIA_Helper::languages_list() as $langKey => $langVal) { ?>
                            <option value="<?php echo esc_attr($langKey) ?>">
                                <?php echo esc_html($langVal); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            <?php } ?>
            <div class="aia_form__fow">
                <label for="aia-words-count">
                    <?php _e('Words Count', AIA_DOMAIN); ?>
                </label>
                <input type="number" id="aia-words-count" name="aia-words-count" min="1" placeholder="<?php _e('Put max amount of Words', AIA_DOMAIN); ?>">
            </div>
            <div class="aia_form__fow">
                <div class="aia_form__submit" data-id="<?php echo $post->ID; ?>" data-type="<?php echo $post->post_type; ?>">
                    <?php _e('Get Response', AIA_DOMAIN); ?>
                </div>
            </div>
        </div>
        <div class="aia__content">
            <div class="aia__response" contenteditable="true"></div>
            <div class="aia__error"></div>
        </div>
    </div>
</div>
