<?php
?>

<div class="aia">
    <div class="aia__container">
        <div class="aia_form__fields">
            <div class="aia_form__fow">
                <label for="aia-title">
                    <?php _e('Topic', AIA_DOMAIN); ?>
                </label>
                <input id="aia-title" name="aia-title" placeholder="<?php _e('Put a Topic', AIA_DOMAIN); ?>">
            </div>
            <div class="aia_form__fow">
                <label for="aia-keywords">
                    <?php _e('Keywords', AIA_DOMAIN); ?>
                </label>
                <input id="aia-keywords" name="aia-keywords" placeholder="<?php _e('Put Keywords', AIA_DOMAIN); ?>">
            </div>
            <div class="aia_form__fow">
                <label for="aia-tone-voice">
                    <?php _e('Tone of Voice', AIA_DOMAIN); ?>
                </label>
                <input id="aia-tone-voice" name="aia-tone-voice" placeholder="<?php _e('Put Tone of Voice', AIA_DOMAIN); ?>">
            </div>
            <div class="aia_form__fow">
                <label for="aia-language">
                    <?php _e('Point of View', AIA_DOMAIN); ?>
                </label>
                <select name="aia-language" id="aia-language">
                    <option value="">
                        <?php _e('Select Language', AIA_DOMAIN); ?>
                    </option>
                    <option value="first-person">
                        <?php _e('First Person (I, me, mine, we, us, our)', AIA_DOMAIN); ?>
                    </option>
                    <option value="second-person">
                        <?php _e('Second Person (you, your, yours)', AIA_DOMAIN); ?>
                    </option>
                    <option value="third-person">
                        <?php _e('Third Person (he, she, they)', AIA_DOMAIN); ?>
                    </option>
                </select>
            </div>
            <div class="aia_form__fow">
                <label for="aia-language">
                    <?php _e('Language', AIA_DOMAIN); ?>
                </label>
                <select name="aia-language" id="aia-language">
                    <option value="">
                        <?php _e('Select Language', AIA_DOMAIN); ?>
                    </option>
                    <option value="en">EN</option>
                    <option value="fr">FR</option>
                    <option value="de">DE</option>
                </select>
            </div>
            <div class="aia_form__fow">
                <div class="aia_form__submit">
                    <?php _e('Get Response', AIA_DOMAIN); ?>
                </div>
            </div>
        </div>
        <div class="aia__response"></div>
    </div>
</div>
