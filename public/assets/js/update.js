// Update the form inputs for distances
var distanceCount = document.querySelectorAll('#distanceContainer .form-group').length;
var distanceContainer = document.getElementById('distanceContainer');
var initialDistanceButton = document.getElementById('initialDistanceButton');

initialDistanceButton.addEventListener('click', function () {
    addDistanceInput();
});

function addDistanceInput() {
    var index = distanceCount;
    var distanceHtml = `
        <input type="hidden" name="propertyDistances[${index}][id]" value="">
        <div class="form-group">
            <label for="propertyDistances[${index}][bllm]">BLLM:</label>
            <input type="text" id="bllm${index}" name="propertyDistances[${index}][bllm]" value="">
        </div>
        <div class="form-group">
            <label for="distance_to_point1${index}">Distance to Point 1:</label>
            <input type="text" id="distance_to_point1${index}" name="propertyDistances[${index}][distance_to_point1]" value="">
        </div>
    `;
    distanceContainer.insertAdjacentHTML('beforeend', distanceHtml);
    distanceCount++;
}

// Update the form inputs for valuations
var valuationCount = document.querySelectorAll('#valuationContainer .form-group').length;
var valuationContainer = document.getElementById('valuationContainer');
var initialValuationButton = document.getElementById('initialValuationButton');

initialValuationButton.addEventListener('click', function () {
    addValuationInput();
});

function addValuationInput() {
    var index = valuationCount;
    var valuationHtml = `
        <input type="hidden" name="propertyValuations[${index}][id]" value="">
        <div class="form-group">
            <label for="valuation_amount${index}">Lot Valuation Amount:</label>
            <input type="text" id="valuation_amount${index}" name="propertyValuations[${index}][valuation_amount]" value="">
        </div>
        <div class="form-group">
            <label for="tree_valuation_amount${index}">Tree Valuation Amount:</label>
            <input type="text" id="tree_valuation_amount${index}" name="propertyValuations[${index}][tree_valuation_amount]" value="">
        </div>
        <div class="form-group">
            <label for="disturbance_amount${index}">Disturbance Amount:</label>
            <input type="text" id="disturbance_amount${index}" name="propertyValuations[${index}][disturbance_amount]" value="">
        </div>
        <div class="form-group">
            <label for="house_structure_amount${index}">House Structure Amount:</label>
            <input type="text" id="house_structure_amount${index}" name="propertyValuations[${index}][house_structure_amount]" value="">
        </div>
    `;
    valuationContainer.insertAdjacentHTML('beforeend', valuationHtml);
    valuationCount++;
}
