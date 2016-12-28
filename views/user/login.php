<div id="container">
    <h2>Connectez-vous</h2>
    <?php
        if(isset($errorLogin)) {
            echo "<font color=red>".$errorLogin."</font>";
        }
    ?>
    <form method="post">
    <label for="Login">Login:</label>
    <input type="text" id="Login" name="login">
    <label for="Password">Password:</label>
    <input type="password" id="Password" name="password">
    <input type="submit" value="Connexion">
    </form>
</div>