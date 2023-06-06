<!DOCTYPE html>
<html>
<head>
	<title>Lot Information</title>
	<link rel="stylesheet" href="/assets/css/viewlot.css">
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
            <li><a href="/profile">
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
    <div class="container">
        <h1>Land Information Details</h1>
    </div>
    <div class='action-container'>
        <a href="/land/update/<?= isset($lot['id']) ? esc($lot['id']) : '' ?>" class="edit-link">Edit</a>
        <a href="/land/delete/<?= isset($lot['id']) ? esc($lot['id']) : '' ?>" class="delete-link" onclick="return confirmDelete()">Delete</a>
    </div>
    <div class="box">
        <table>
            <tr>
                <th>Lot No. :</th>
                <td><?= isset($lot['lot_no']) ? esc($lot['lot_no']) : '' ?></td>
            </tr>
            <tr>
                <th>Size of Area :</th>
                <td><?= isset($lot['size_of_area']) ? esc($lot['size_of_area']) : '' ?></td>
            </tr>
            <tr>
                <th>Cad No. :</th>
                <td><?= isset($lot['cad_no']) ? esc($lot['cad_no']) : '' ?></td>
            </tr>
            <tr>
                <th>Location :</th>
                <td><?= isset($lot['location']) ? esc($lot['location']) : '' ?></td>
            </tr>
            <tr>
                <th>Phase :</th>
                <td><?= isset($lot['phase']) ? esc($lot['phase']) : '' ?></td>
            </tr>
            <tr>
                <th>Land Owner :</th>
                <td><?= isset($lot['land_owner']) ? esc($lot['land_owner']) : '' ?></td>
            </tr>
            <tr>
                <th>Status :</th>
                <td><?= isset($lot['status']) ? esc($lot['status']) : '' ?></td>
            </tr>
        </table>
    </div>

    <div class="box">
        <div class="divider">
            <h2 class="centered">Distance</h2>
        </div>

        <table>
            <!-- Iterate over property distances -->
            <?php foreach ($propertyDistances as $distance): ?>
            <tr>
                <th>BLLM :</th>
                <td><?= isset($distance['bllm']) ? esc($distance['bllm']) : '' ?></td>
            </tr>
            <tr>
                <th>Distance to Point 1 :</th>
                <td><?= isset($distance['distance_to_point1']) ? esc($distance['distance_to_point1']) : '' ?></td>
            </tr>
            <tr>
                <td colspan="2"><hr></td> <!-- Add a horizontal divider -->
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="box">
        <div class="divider">
            <h2 class="centered">Valuation</h2>
        </div>

        <table>
            <?php foreach ($propertyValuations as $valuation): ?>
            <tr>
                <th>Lot Valuation Amount :</th>
                <td><?= isset($valuation['valuation_amount']) ? esc($valuation['valuation_amount']) : '' ?></td>
            </tr>
            <tr>
                <th>Tree Valuation Amount :</th>
                <td><?= isset($valuation['tree_valuation_amount']) ? esc($valuation['tree_valuation_amount']) : '' ?></td>
            </tr>
            <tr>
                <th>Disturbance Amount :</th>
                <td><?= isset($valuation['disturbance_amount']) ? esc($valuation['disturbance_amount']) : '' ?></td>
            </tr>
            <tr>
                <th>House Structure Amount :</th>
                <td><?= isset($valuation['house_structure_amount']) ? esc($valuation['house_structure_amount']) : '' ?></td>
            </tr>
            <tr>
                <td colspan="2"><hr></td> <!-- Add a horizontal divider -->
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <h2 class="upload">Uploaded Files</h2>

    <div class="table-container">
        <table>
            <thead>
            <tr>
                <th>File Name</th>
                <th>Original Name</th>
                <th>Upload Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <!-- Start of PHP foreach loop -->
            <?php foreach ($documents as $document) { ?>
                <tr>
                    <td><?= isset($document['file_name']) ? esc($document['file_name']) : '' ?></td>
                    <td><?= isset($document['original_name']) ? esc($document['original_name']) : '' ?></td>
                    <td><?= isset($document['upload_date']) ? esc($document['upload_date']) : '' ?></td>
                    <td>
                        <a href="/documents/download/<?= isset($document['id']) ? esc($document['id']) : '' ?>" class="download-link">Download</a>
                        <a href="/documents/delete/<?= isset($document['id']) ? esc($document['id']) : '' ?>" class="delete-link" onclick="return confirmDelete()">Delete</a>
                        <a href="/documents/view/<?= isset($document['file_name']) ? esc($document['file_name']) : '' ?>" class="view-link">View</a>
                    </td>
                </tr>
            <?php } ?>
            <!-- End of PHP foreach loop -->
            </tbody>
        </table>
    </div>

    <!-- Success message section -->
    <?php if (session()->getFlashData('success')) { ?>
        <div class="success-message">
            <?php echo session()->getFlashData('success'); ?>
        </div>
    <?php } ?>

    <!-- Error message section -->
    <?php if (session()->getFlashData('error')) { ?>
        <div class="error-message">
            <?php echo session()->getFlashData('error'); ?>
        </div>
    <?php } ?>


    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this file?");
        }
    </script>
    <script src="/assets/js/transition.js"></script>

</div>
</body>
</html>
