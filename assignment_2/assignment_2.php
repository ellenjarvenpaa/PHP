<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remember-me'])) {
        setcookie('username', $_POST['username']);
        // refresh page to update cookie
    } else {
        setcookie('username', '', time() - 3600);
        // refresh page to update cookie
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="username">Username</label>
    <input <?php
    if (isset($_COOKIE['username'])) {
        echo 'value="' . $_COOKIE['username'] . '"';
    }
    ?> type="text" name="username" id="username">

    <label for="remember-me">Remember me</label>
    <input
        <?php
        if (isset($_COOKIE['username'])) {
            echo 'checked';
        }
        ?> type="checkbox" name="remember-me" id="remember-me">

    <button type="submit">Submit</button>
</form>
