<?php

use \Admin\DataBase;
use \Admin\Init;

$data = false;
$disabled = true;
$time = DataBase::getUpdateTime();
$date = DataBase::getUpdateDate();
$admin_data = DataBase::getAdminData();
$table_name = DataBase::getTableName();
if (strtotime($date) <= strtotime(date("Y-m-d"))) {
    if (Init::countTheTime($time))
        $disabled = false;
}

if (count(DataBase::getData()) > 0) {
    $data = DataBase::getData();
} else {
    echo "
    <script>
    API.fetch();
    </script>";
}
?>

<div class="plugin_title block">
    <h1><?php _e("API Generator"); ?></h1>
    <h2 id="table_name_heading">
        <?php if ($table_name) : ?>
            <p><?php printf("%s", __($table_name)); ?></p>
        <?php endif; ?>
    </h2>

</div>
<div class="block">
    <form method="post">
        <table id="data_table" class="table">
            <tr id="data_headings"></tr>
            <?php if ($data) : ?>
                <input type="hidden" name="admin_id" value="<?= $admin_data ?>">
                <?php foreach ($data as $key => $value) : ?>

                    <tr id="row_id_<?php echo $value['id']; ?>">
                        <td><span class="dashicons dashicons-move"></span></td>
                        <td><input type="hidden" name="id[]" value="<?php echo $value['id']; ?>"></td>
                        <td><input type="text" name="data_id[]" value="<?php echo $value['data_id']; ?>"></td>
                        <td><input type="text" name="name[]" value="<?php echo $value['name']; ?>"></td>
                        <td><input type="text" name="lastname[]" value="<?php echo $value['lastname']; ?>"></td>
                        <td><input type="text" name="email[]" value="<?php echo $value['email']; ?>"></td>
                        <td><input type="text" name="date[]" value="<?php echo $value['date']; ?>"></td>
                        <td>
                            <button type="button" onclick="API.removeRow(<?php echo $value['id']; ?>)">
                                <span class="dashicons dashicons-trash"></span>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php
            else : ?>

                <input type="hidden" name="table_name" id="table_name">

            <?php endif; ?>
        </table>
        <div class="buttons">
            <input name="save" type="submit" value="<?php _e('Save') ?>" class="save_button">
            <button type="button" class="reload_button <?php echo $disabled ? 'disabled' : '' ?>" <?php echo $disabled ? 'disabled="disabled"' : '' ?> onclick="API.fetch()"><?php _e("Reload Data"); ?></button>
        </div>
    </form>
</div>