<?php $name = "Word";
$db = Typecho_Db::get();
if (isset($_POST['type'])) {
    if ($_POST["type"] == "备份设置") {
        $value = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name))['value'];
        if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . '_backup'))) {
            $db->query($db->update('table.options')->rows(array('value' => $value))->where('name = ?', 'theme:' . $name . '_backup')); ?>
            <div class="success" style="text-align: center;">已更新，请 <a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">刷新</a></div>
            <script>
                window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);
            </script>
        <?php } else { ?>
            <?php
            if ($value) {
                $db->query($db->insert('table.options')->rows(array('name' => 'theme:' . $name . '_backup', 'user' => '0', 'value' => $value)));
            ?>
                <div class="success" style="text-align: center;">已备份，请 <a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">刷新</a></div>
                <script>
                    window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);
                </script>
            <?php }
        }
    }
    if ($_POST["type"] == "还原备份") {
        if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . '_backup'))) {
            $_value = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . '_backup'))['value'];
            $db->query($db->update('table.options')->rows(array('value' => $_value))->where('name = ?', 'theme:' . $name)); ?>
            <div class="success" style="text-align: center;">已还原，请 <a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">刷新</a></div>
            <script>
                window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);
            </script>
        <?php } else { ?>
            <div class="success" style="text-align: center;">无备份，还原不了</div>
            <script>
                window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);
            </script>
        <?php } ?>
    <?php } ?>
    <?php if ($_POST["type"] == "删除备份") {
        if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . '_backup'))) {
            $db->query($db->delete('table.options')->where('name = ?', 'theme:' . $name . '_backup')); ?>
            <div class="success" style="text-align: center;">已删除，请 <a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">刷新</a></div>
            <script>
                window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);
            </script>
        <?php } else { ?>
            <div class="success" style="text-align: center;">无备份，删除不了</div>
            <script>
                window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);
            </script>
        <?php } ?>
    <?php } ?>
<?php } ?>
<?php
echo '
    <form class="backup" action="?Joe_backup" method="post">
        <input type="submit" name="type" value="备份设置" />
        <input type="submit" name="type" value="还原备份" />
        <input type="submit" name="type" value="删除备份" />
    </form>';
