<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document List</title>
    <link rel="stylesheet" href="/assets/css/documents.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<body>
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
                <li><a href="/homepage" onclick="logout()">Logout</a></li>
            </ul>
        </li>
    </ul>
</div>

<div class="document-page">
    <h1>Document List</h1>

    <div class="table-container">
        <table>
            <thead>
            <tr>
                <th>Lot Number</th>
                <th>Land Owner</th>
                <th>Size of Area</th>
                <th>Location</th>
                <th>View</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lots as $lot) { ?>
                <tr>
                    <td><?= isset($lot['lot_no']) ? esc($lot['lot_no']) : '' ?></td>
                    <td><?= isset($lot['land_owner']) ? esc($lot['land_owner']) : '' ?></td>
                    <td><?= isset($lot['size_of_area']) ? esc($lot['size_of_area']) : '' ?></td>
                    <td><?= isset($lot['location']) ? esc($lot['location']) : '' ?></td>
                    <td>
                        <a href="/documents/view/<?= isset($lot['id']) ? esc($lot['id']) : '' ?>" class="view-link">View</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="button-container">
        <a href="land/add" class="button-link">Add Land Details</a>
    </div>
</div>
</body>
</html>
