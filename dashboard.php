<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

$stmt = $pdo->query("SELECT * FROM produtos");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']) ?>!</h1>

    <h2>Lista de produtos</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['id_produto']) ?></td>
                    <td><?= htmlspecialchars($product['nome_produto']) ?></td>
                    <td><?= htmlspecialchars($product['preco_produto']) ?></td>
                    <td><?= htmlspecialchars($product['desc_produto']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Selecione um produto</h2>
    <form>
        <select>
            <?php foreach ($products as $product): ?>
                <option value="<?= htmlspecialchars($product['id_produto']) ?>">
                    <?= htmlspecialchars($product['nome_produto']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <br>
    <form method="POST" action="logout.php">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
