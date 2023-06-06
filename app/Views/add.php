<html>
    <head>
        <title>
            Add Land Details
        </title>
        <link rel="stylesheet" href="/assets/css/add.css">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>
    <body>
        <Header>
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
        </Header>
            
        <div class="wrapper" style="background-color: 0054A5;">
            <h1>Add Land Details</h1>
            <div >
                <form action="/land/add" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="lot_no">Lot No.:</label>
                        <input type="text" name="lot_no" placeholder="Lot No. :">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->getError('lot_no')) : ?>
                            <span class="error"><?= $validation->getError('lot_no') ?></span>
                        <?php endif; ?>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="size_of_area">Size of Area :</label>
                        <input type="text" name="size_of_area" placeholder="Size of Area :">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->getError('size_of_area')) : ?>
                            <span class="error"><?= $validation->getError('size_of_area') ?></span>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cad_no">Cad No. :</label>
                        <input type="text" name="cad_no" placeholder="Cad No. :">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->getError('cad_no')) : ?>
                            <span class="error"><?= $validation->getError('cad_no') ?></span>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location">Location :</label>
                        <input type="text" name="location" placeholder="Location :">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->getError('location')) : ?>
                            <span class="error"><?= $validation->getError('location') ?></span>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phase">Phase :</label>
                        <input type="text" name="phase" placeholder="Phase :">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->getError('phase')) : ?>
                            <span class="error"><?= $validation->getError('phase') ?></span>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="land_owner">Land Owner :</label>
                        <input type="text" name="land_owner" placeholder="Land Owner :">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->getError('land_owner')) : ?>
                            <span class="error"><?= $validation->getError('land_owner') ?></span>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status :</label>
                        <input type="text" name="status" placeholder="Status :">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->getError('status')) : ?>
                            <span class="error"><?= $validation->getError('status') ?></span>
                        <?php endif; ?>
                        </div>
                    </div>


                    <!-- Divider with heading "Distance" -->
                    <div class="divider">
                        <h2>Distance</h2>
                    </div>
                    <div class="form-group">
                        <label for="distance[0][bllm]">BLLM :</label>
                        <input type="text" name="distance[0][bllm]" placeholder="BLLM :">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->getError('distance.0.bllm')) : ?>
                            <span class="error"><?= $validation->getError('distance.0.bllm') ?></span>
                        <?php endif; ?>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="distance[0][distance_to_point1]">Distance to Point 1 :</label>
                        <input type="text" name="distance[0][distance_to_point1]" placeholder="Distance to Point 1 :">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->getError('distance.0.distance_to_point1')) : ?>
                            <span class="error"><?= $validation->getError('distance.0.distance_to_point1') ?></span>
                        <?php endif; ?>
                        </div>
                    </div>
                    
                    <button type="button" onclick="addMoreDistance()">Add more Distance</button>
                    <div id="distanceContainer"></div> <!-- Container for dynamically added distance fields -->
                    
                    <!-- Divider with heading "Valuation" -->
                    <div class="divider">
                        <h2>Valuation</h2>
                    </div>
                    <div class="form-group">
                        <label for="valuation[0][valuation_amount]">Lot Valuation Amount :</label>
                        <input type="text" name="valuation[0][valuation_amount]" placeholder="Lot Valuation Amount :">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->getError('valuation.0.valuation_amount')) : ?>
                            <span class="error"><?= $validation->getError('valuation.0.valuation_amount') ?></span>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="valuation[0][tree_valuation_amount]">Tree Valuation Amount :</label>
                        <input type="text" name="valuation[0][tree_valuation_amount]" placeholder="Tree Valuation Amount :">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->getError('valuation.0.tree_valuation_amount')) : ?>
                            <span class="error"><?= $validation->getError('valuation.0.tree_valuation_amount') ?></span>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="valuation[0][disturbance_amount]">Disturbance Amount :</label>
                        <input type="text" name="valuation[0][disturbance_amount]" placeholder="Disturbance Amount :">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->getError('valuation.0.disturbance_amount')) : ?>
                            <span class="error"><?= $validation->getError('valuation.0.disturbance_amount') ?></span>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="valuation[0][house_structure_amount]">House Structure Amount :</label>
                        <input type="text" name="valuation[0][house_structure_amount]" placeholder="House Structure Amount :">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->getError('valuation.0.house_structure_amount')) : ?>
                            <span class="error"><?= $validation->getError('valuation.0.house_structure_amount') ?></span>
                        <?php endif; ?>
                        </div>
                    </div>
                    <button type="button" onclick="addMoreValuation()">Add more Valuation</button>
                    <div id="valuationContainer"></div> <!-- Container for dynamically added valuation fields -->

                        <div class="file-upload">
                            <label for="fileToUpload">Select PDF file to upload:</label>
                            <input type="file" name="fileToUpload" id="fileToUpload" accept="application/pdf">
                        </div>

                    <div class="submit-container">
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    
        <script src="/assets/js/add.js"></script>

</body>
