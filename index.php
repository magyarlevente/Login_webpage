<?php
require_once 'db.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $decoded_passwords = get_passwords('password.txt');

    if (isset($decoded_passwords[$username]))
    {
        if ($decoded_passwords[$username] === $password)
        {
            $query = $db->prepare("SELECT Titkos FROM tabla WHERE Username = ?");
            $query->bind_param("s", $username);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $color = $row['Titkos'];
                show_color_page($color);
            } else
            {
                die("Hiba: Nincs ilyen felhasználó az adatbázisban.");
            }
        } else
        {
            header("Refresh: 3; url=https://police.hu");
            die("Hibás jelszó! Átirányítás a police.hu-ra...");
        }
    }
    else
    {
        die("Nincs ilyen felhasználó!");
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }
        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }
        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 16px;
            opacity: 0.9;
        }
        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #444;
            text-align: center;
            margin-bottom: 25px;
            font-size: 22px;
        }
        input {
            display: block;
            margin: 15px 0;
            padding: 12px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border 0.3s;
            box-sizing: border-box;
        }
        input:focus {
            border-color: #2575fc;
            outline: none;
        }
        button {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: white;
            font-size: 14px;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Magyar Levente</h1>
            <p>JKTFEX</p>
        </div>
        <form method="POST">
            <h2>Bejelentkezés</h2>
            <input type="text" name="username" placeholder="Felhasználónév" required>
            <input type="password" name="password" placeholder="Jelszó" required>
            <button type="submit">Belépés</button>
        </form>
    </div>
</body>
</html>