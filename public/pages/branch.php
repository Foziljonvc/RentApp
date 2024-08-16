<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/main.css" rel="stylesheet">
    <title>Rent App</title>
</head>
<body>
<div class="min-h-full">
    <?php
    location('/public/partials/navbar.php');
    ?>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Branch</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <?php
            location('/public/partials/body.php');
            location('/public/partials/content.php');
            location('/public/partials/footer.php');
            ?>
        </div>
    </main>
</div>

</body>
</html>