<html>
    <head>
        <title>
            Reports
        </title>
        <link rel="stylesheet" href="/assets/css/totalarea.css">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>
    <body>
        <header>
            <div class="navbar">
                <img src="/assets/images/icon2.png" class="logo">
                <ul>
                    <li><a href="/adminhome">Home</a></li>
                    <li><a href="/adminabout">About</a></li>
                    <li><a href="/adminmap">Virtual Map</a></li>
                    <li><a href="/adminsearch">Search Land</a></li>
                    <li><a href="/documents">Land Documents</a></li>
                    <li><a href="/reports">Reports</a></li>
                    <li>
                        <a href="/profile">
                            <img src="/assets/images/user.png" alt="Profile" class="user">
                        </a>
                        <ul class="dropdown">
                            <li><a href="/" onclick="logout()">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>

        <div class="document-page">
            <h1>Generated Reports</h1>

            <main>
                <div class="report-container">
                    <div class="report-box">
                        <h3>Total number of owners: </h3>
                        <a href="/ownernumber">
                            <p id="total-area"><?php echo $totalLandOwners; ?></p>
                        </a>
                    </div>
                    <div class="report-box">
                        <h3>Number of lots owned by owners: </h3>
                        <a href="/lotowned">
                            <p id="total-lots"><?php echo $totalLot; ?></p>
                        </a>
                    </div>
                    <div class="report-box">
                        <h3>Total number of land titles: </h3>
                        <a href="/totaldoc">
                            <p id="total-reports"><?php echo $totalDocs; ?></p>
                        </a>
                    </div>
                    <div class="report-box">
                        <h3>Total area owned by Owners: </h3>
                        <a href="/totalarea">
                            <p id="total-no-paper"><?php echo $totalArea; ?> Sqm</p>
                        </a>
                    </div>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="3">Total Area owned by Land Owners: <?php echo $totalArea; ?> Sqm</th>
                            </tr>
                            <tr>
                                <th>Land Owner</th>
                                <th>Lot Number</th>
                                <th>Total Area</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ownerLots as $ownerName => $associatedLots): ?>
                                <?php $lotCount = count($associatedLots); ?>
                                <?php foreach ($associatedLots as $index => $lot): ?>
                                    <tr>
                                        <?php if ($index === 0): ?>
                                            <td rowspan="<?php echo $lotCount; ?>"><?php echo $ownerName; ?></td>
                                        <?php endif; ?>
                                        <td><?php echo $lot['lot_no']; ?></td>
                                        <td><?php echo $totalAreas[$ownerName][$lot['lot_no']] . " Sqm"; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </body>
</html>
