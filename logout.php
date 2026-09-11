<?php
session_start();
include 'loginconfig.php';
if (!isset($_SESSION['logged_out'])) {
    session_destroy();
    $_SESSION['logged_out'] = true;
}
?>
<script>
    window.location.href = 'index.php';
</script>


