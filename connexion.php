<?php
// Start session and include database connection
include("config.php");
session_start();

$error = "";

// Process form only if submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Check if login exists in administration table
    $sql = "SELECT * FROM administration WHERE login = '$login'";
    $result = mysqli_query($conn, $sql);
    $role = "admin";

    // If not found in administration, check in gestionnaire table
    if (!$result || mysqli_num_rows($result) === 0) {
        $sql = "SELECT * FROM gestionnaire WHERE login = '$login'";
        $result = mysqli_query($conn, $sql);
        $role = "gestionnaire";
    }

    // If exactly one user found
    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Check if password matches
        if ($password === $user["password"]) {
            // Store user info in session
            $_SESSION["user_id"] = ($role == "admin") ? $user["id_admin"] : $user["id_gestionnaire"];
            $_SESSION["login"] = $user["login"];
            $_SESSION["role"] = $role;
            // Redirect to home page
            header("Location: index.php");
            exit();
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Login inconnu.";
    }
}
?>
<?php include("header.php"); ?>

<h2>Connexion</h2>


<!-- Login form -->
<form method="POST">
    <label>Login</label>
    <input type="text" name="login" required>
    <label>Mot de passe</label>
    <input type="password" name="password" required>
    <button type="submit">Se connecter</button>
</form>

<?php include("footer.php"); ?>
