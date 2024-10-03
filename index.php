<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>PHP Hotel</title>
</head>

<body>
    <?php

    $hotels = [
        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ]
    ];
    ?>
    <h1 class="text-center">Hotel</h1>
    <div class="container">
        <?php
        // Filtro parcheggio
        $filter_parking = isset($_GET['parking']) ? $_GET['parking'] : '';
        // Filtro voto minimo
        $filter_vote = isset($_GET['vote']) ? $_GET['vote'] : 0;
        ?>

        <!-- Tabella degli hotel -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto</th>
                    <th>Distanza dal centro (km)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($hotels as $hotel) {
                    // Applica il filtro parcheggio
                    if ($filter_parking && !$hotel['parking']) {
                        continue;
                    }
                    // Applica il filtro voto minimo
                    if ($filter_vote > 0 && $hotel['vote'] < $filter_vote) {
                        continue;
                    }
                    echo "<tr>";
                    echo "<td>{$hotel['name']}</td>";
                    echo "<td>{$hotel['description']}</td>";
                    echo "<td>" . ($hotel['parking'] ? 'Sì' : 'No') . "</td>";
                    echo "<td>{$hotel['vote']}</td>";
                    echo "<td>{$hotel['distance_to_center']} km</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- Form per il filtro -->
        <form method="GET" class="mb-4 filter">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="parking" id="parking" value="1"
                    <?php if ($filter_parking) echo 'checked'; ?>>
                <label class="form-check-label" for="parking">Solo hotel con parcheggio</label>
            </div>
            <div class="mb-3">
                <label for="vote" class="form-label">Voto minimo</label>
                <input type="number" class="form-control" id="vote" name="vote" min="1" max="5"
                    value="<?php echo $filter_vote; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Filtra</button>
        </form>
    </div>
</body>

</html>