<html>
    <head>
        <title>
            Update Land Details
        </title>
        <link rel="stylesheet" href="/assets/css/update.css">
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
            <h1>Update Land Details</h1>
            <div class="form-container">
                <form action="/land/update/<?= $lotId ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="lot_no">Lot No.:</label>
                        <input type="text" id="lot_no" name="lot_no" value="<?= set_value('lot_no', isset($lot['lot_no']) ? $lot['lot_no'] : '') ?>">
                    </div>     
                    
                    <div class="form-group">
                        <label for="size_of_area">Size of Area:</label>
                        <input type="text" id="size_of_area" name="size_of_area" value="<?= set_value('size_of_area', isset($lot['size_of_area']) ? $lot['size_of_area'] : '') ?>">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->hasError('size_of_area')): ?>
                            <p class="error"><?= $validation->getError('size_of_area') ?></p>
                        <?php endif; ?>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="cad_no">Cad No.:</label>
                        <input type="text" id="cad_no" name="cad_no" value="<?= set_value('cad_no', isset($lot['cad_no']) ? $lot['cad_no'] : '') ?>">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->hasError('cad_no')): ?>
                            <p class="error"><?= $validation->getError('cad_no') ?></p>
                        <?php endif; ?>
                    </div>
                    </div>
                 
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" value="<?= set_value('location', isset($lot['location']) ? $lot['location'] : '') ?>">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->hasError('location')): ?>
                            <p class="error"><?= $validation->getError('location') ?></p>
                        <?php endif; ?>
                    </div>
                    </div>
                  
                    <div class="form-group">
                        <label for="phase">Phase:</label>
                        <input type="text" id="phase" name="phase" value="<?= set_value('phase', isset($lot['phase']) ? $lot['phase'] : '') ?>">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->hasError('phase')): ?>
                            <p class="error"><?= $validation->getError('phase') ?></p>
                        <?php endif; ?>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="land_owner">Land Owner:</label>
                        <input type="text" id="land_owner" name="land_owner" value="<?= set_value('land_owner', isset($lot['land_owner']) ? $lot['land_owner'] : '') ?>">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->hasError('land_owner')): ?>
                            <p class="error"><?= $validation->getError('land_owner') ?></p>
                        <?php endif; ?>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <input type="text" id="status" name="status" value="<?= set_value('status', isset($lot['status']) ? $lot['status'] : '') ?>">
                        <div class="validation-errors">
                        <?php if (isset($validation) && $validation->hasError('status')): ?>
                            <p class="error"><?= $validation->getError('status') ?></p>
                        <?php endif; ?>
                    </div>
                    </div>
                   <!-- Update the form inputs for distances -->
                    <div class="divider">
                        <h2>Distance</h2>
                    </div>
                    <div id="distanceContainer">
                        <?php foreach ($propertyDistance as $index => $distance): ?>
                            <input type="hidden" name="propertyDistances[<?= $index ?>][id]" value="<?= $distance['id'] ?>">
                            <div class="form-group">
                                <label for="propertyDistances[<?= $index ?>][bllm]">BLLM:</label>
                                <input type="text" id="bllm<?= $index ?>" name="propertyDistances[<?= $index ?>][bllm]" value="<?= $distance['bllm'] ?>">
                                <div class="validation-errors">
                                <?php if (isset($validation) && $validation->hasError("propertyDistances.{$index}.bllm")): ?>
                                    <p class="error"><?= $validation->getError("propertyDistances.{$index}.bllm") ?></p>
                                <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="distance_to_point1<?= $index ?>">Distance to Point 1:</label>
                                <input type="text" id="distance_to_point1<?= $index ?>" name="propertyDistances[<?= $index ?>][distance_to_point1]" value="<?= $distance['distance_to_point1'] ?>">
                                <div class="validation-errors">
                                <?php if (isset($validation) && $validation->hasError("propertyDistances.{$index}.distance_to_point1")): ?>
                                    <p class="error"><?= $validation->getError("propertyDistances.{$index}.distance_to_point1") ?></p>
                                <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" id="initialDistanceButton" class="btn btn-primary">Add Distance</button>

                    <!-- Update the form inputs for valuations -->
                    <div class="divider">
                        <h2>Valuation</h2>
                    </div>
                    <div id="valuationContainer">
                        <?php foreach ($propertyValuation as $index => $valuation): ?>
                            <input type="hidden" name="propertyValuations[<?= $index ?>][id]" value="<?= $valuation['id'] ?>">
                            <div class="form-group">
                                <label for="valuation_amount<?= $index ?>">Lot Valuation Amount:</label>
                                <input type="text" id="valuation_amount<?= $index ?>" name="propertyValuations[<?= $index ?>][valuation_amount]" value="<?= $valuation['valuation_amount'] ?>">
                                <div class="validation-errors">
                                <?php if (isset($validation) && $validation->hasError("propertyValuations.{$index}.valuation_amount")): ?>
                                    <p class="error"><?= $validation->getError("propertyValuations.{$index}.valuation_amount") ?></p>
                                <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tree_valuation_amount<?= $index ?>">Tree Valuation Amount:</label>
                                <input type="text" id="tree_valuation_amount<?= $index ?>" name="propertyValuations[<?= $index ?>][tree_valuation_amount]" value="<?= $valuation['tree_valuation_amount'] ?>">
                                <div class="validation-errors">
                                <?php if (isset($validation) && $validation->hasError("propertyValuations.{$index}.tree_valuation_amount")): ?>
                                    <p class="error"><?= $validation->getError("propertyValuations.{$index}.tree_valuation_amount") ?></p>
                                <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="disturbance_amount<?= $index ?>">Disturbance Amount:</label>
                                <input type="text" id="disturbance_amount<?= $index ?>" name="propertyValuations[<?= $index ?>][disturbance_amount]" value="<?= $valuation['disturbance_amount'] ?>">
                                <div class="validation-errors">
                                <?php if (isset($validation) && $validation->hasError("propertyValuations.{$index}.disturbance_amount")): ?>
                                    <p class="error"><?= $validation->getError("propertyValuations.{$index}.disturbance_amount") ?></p>
                                <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="house_structure_amount<?= $index ?>">House Structure Amount:</label>
                                <input type="text" id="house_structure_amount<?= $index ?>" name="propertyValuations[<?= $index ?>][house_structure_amount]" value="<?= $valuation['house_structure_amount'] ?>">
                                <div class="validation-errors">
                                <?php if (isset($validation) && $validation->hasError("propertyValuations.{$index}.house_structure_amount")): ?>
                                    <p class="error"><?= $validation->getError("propertyValuations.{$index}.house_structure_amount") ?></p>
                                <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" id="initialValuationButton" class="btn btn-primary">Add Valuation</button>

                    

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

        <script src="/assets/js/update.js"></script>
        
    </body>
