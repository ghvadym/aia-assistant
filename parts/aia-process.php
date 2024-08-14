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
                <div class="aia_form__submit">
                    <?php _e('Get Response', AIA_DOMAIN); ?>
                </div>
            </div>
        </div>
        <div class="aia__content">
            <div class="aia__response" contenteditable="true"></div>
            <div class="aia__error"></div>
            <div class="aia__actions">
                <div class="aia__action_clear">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.05 11.25L6 7.2L1.95 11.25L0.75 10.05L4.8 6L0.75 1.95L1.95 0.75L6 4.8L10.05 0.75L11.25 1.95L7.2 6L11.25 10.05L10.05 11.25Z" fill="#000"/>
                    </svg>
                </div>
                <div class="aia__action_copy">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5903 13.4103C11.0003 13.8003 11.0003 14.4403 10.5903 14.8303C10.2003 15.2203 9.56031 15.2203 9.17031 14.8303C7.22031 12.8803 7.22031 9.71031 9.17031 7.76031L12.7103 4.22031C14.6603 2.27031 17.8303 2.27031 19.7803 4.22031C21.7303 6.17031 21.7303 9.34031 19.7803 11.2903L18.2903 12.7803C18.3003 11.9603 18.1703 11.1403 17.8903 10.3603L18.3603 9.88031C19.5403 8.71031 19.5403 6.81031 18.3603 5.64031C17.1903 4.46031 15.2903 4.46031 14.1203 5.64031L10.5903 9.17031C9.41031 10.3403 9.41031 12.2403 10.5903 13.4103ZM13.4103 9.17031C13.8003 8.78031 14.4403 8.78031 14.8303 9.17031C16.7803 11.1203 16.7803 14.2903 14.8303 16.2403L11.2903 19.7803C9.34031 21.7303 6.17031 21.7303 4.22031 19.7803C2.27031 17.8303 2.27031 14.6603 4.22031 12.7103L5.71031 11.2203C5.70031 12.0403 5.83031 12.8603 6.11031 13.6503L5.64031 14.1203C4.46031 15.2903 4.46031 17.1903 5.64031 18.3603C6.81031 19.5403 8.71031 19.5403 9.88031 18.3603L13.4103 14.8303C14.5903 13.6603 14.5903 11.7603 13.4103 10.5903C13.0003 10.2003 13.0003 9.56031 13.4103 9.17031Z" fill="#000"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
