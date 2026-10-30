<?php
session_start();

$blad = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $haslo = $_POST["haslo"];

    if ($login === "admin" && $haslo === "1234") {

        $_SESSION["user"] = $login;

        if (isset($_POST["remember"])) {
            setcookie("saved_login", $login, time() + (7 * 24 * 60 * 60), "/");
        }

        header("Location: panel.php");
        exit();
    } else {
        $blad = "Nieprawidłowy login lub hasło!";
    }
}

$zapamietanyLogin = $_COOKIE["saved_login"] ?? "";
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
</head>
<body>

<h2>Logowanie</h2>

<?php
if ($blad != "") {
    echo "<p style='color:red;'>$blad</p>";
}
?>

<form method="post">
    <label>Login:</label><br>
    <input type="text" name="login" value="<?php echo htmlspecialchars($zapamietanyLogin); ?>"><br><br>

    <label>Hasło:</label><br>
    <input type="password" name="haslo"><br><br>

    <input type="checkbox" name="remember">
    <label>Zapamiętaj mnie</label><br><br>

    <input type="submit" value="Zaloguj">
</form>

</body>
</html>