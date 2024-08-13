<?php

$fieldsOptionKey = '';
$fields = AIA_Contents::settings_api_keys_data();

if (empty($fields)) {
    return;
}
?>

<table class="form-table">
    <?php foreach ($fields as $id => $data) {
        $title = $data['title'] ?? ''; ?>
        <tr>
            <th scope="row">
                <label for="<?php echo esc_attr($id); ?>">
                    <?php echo esc_html($title); ?>
                </label>
            </th>
            <td>
                <input type="text"
                       class="regular-text"
                       name="<?php echo esc_attr($id); ?>"
                       id="<?php echo esc_attr($id); ?>"
                       value="<?php echo esc_attr(get_option($id)); ?>">
            </td>
        </tr>
    <?php } ?>
</table>