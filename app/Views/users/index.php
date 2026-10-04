<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Users</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background: #f5f5f5;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #3674B5;
            color: white;
        }

        tr:nth-child(even) {
            background: #f8f8f8;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>User List</h1>

    <?php if (empty($users)): ?>

        <p>No users found.</p>

    <?php else: ?>

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                
                </tr>
            </thead>

            <tbody>

                <?php foreach ($users as $user): ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars($user['id']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($user['Username']) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>

</body>
</html>