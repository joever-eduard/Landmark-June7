var initialDistanceContainer = null;
            var previousDistanceContainer = null;
            var initialValuationContainer = null;
            var previousValuationContainer = null;
            var distanceCount = 1
            var valuationCount = 1

            function addMoreDistance() {
                var container = document.createElement('div');
                container.className = 'added-fields-container';

                var heading = document.createElement('h2');
                heading.textContent = 'Distance';

                var input1 = document.createElement('input');
                input1.type = 'text';
                input1.name = `distance[${distanceCount}][bllm]`;  // Changed to an array name
                input1.placeholder = 'BLLM :';
                input1.className = 'added-field';

                var input2 = document.createElement('input');
                input2.type = 'text';
                input2.name = `distance[${distanceCount}][distance_to_point1]`;  // Changed to an array name
                input2.placeholder = 'Distance to Point 1 :';
                input2.className = 'added-field';

                container.appendChild(heading);
                container.appendChild(input1);
                container.appendChild(input2);

                var distanceContainer = document.getElementById('distanceContainer');
                distanceContainer.appendChild(container);

                var functionButton = document.createElement('button');
                functionButton.type = 'button';
                functionButton.textContent = 'Add more Distance';
                functionButton.onclick = addMoreDistance;
                functionButton.className = 'function-button';

                container.appendChild(functionButton);

                // Remove the function button from the previous container
                if (previousDistanceContainer) {
                    var previousFunctionButton = previousDistanceContainer.querySelector('.function-button');
                    if (previousFunctionButton) {
                        previousFunctionButton.remove();
                    }
                }

                distanceCount++;
                

                // Remove the function button from the initial container
                if (initialDistanceContainer === null) {
                    initialDistanceContainer = container;
                } else {
                    var initialFunctionButton = initialDistanceContainer.querySelector('.function-button');
                    if (initialFunctionButton) {
                        initialFunctionButton.remove();
                    }
                }

                previousDistanceContainer = container;
            }

            function addMoreValuation() {
                var container = document.createElement('div');
                container.className = 'added-fields-container';

                var heading = document.createElement('h2');
                heading.textContent = 'Valuation';

                var input1 = document.createElement('input');
                input1.type = 'text';
                input1.name = `valuation[${valuationCount}][valuation_amount]`;  // Changed to an array name
                input1.placeholder = 'Lot Valuation Amount :';
                input1.className = 'added-field';

                var input2 = document.createElement('input');
                input2.type = 'text';
                input2.name = `valuation[${valuationCount}][tree_valuation_amount]`;  // Changed to an array name
                input2.placeholder = 'Tree Valuation Amount :';
                input2.className = 'added-field';

                var input3 = document.createElement('input');
                input3.type = 'text';
                input3.name = `valuation[${valuationCount}][disturbance_amount]`;  // Changed to an array name
                input3.placeholder = 'Disturbance Amount :';
                input3.className = 'added-field';

                var input4 = document.createElement('input');
                input4.type = 'text';
                input4.name = `valuation[${valuationCount}][house_structure_amount]`;  // Changed to an array name
                input4.placeholder = 'House Structure Amount :';
                input4.className = 'added-field';

                container.appendChild(heading);
                container.appendChild(input1);
                container.appendChild(input2);
                container.appendChild(input3);
                container.appendChild(input4);

                var valuationContainer = document.getElementById('valuationContainer');
                valuationContainer.appendChild(container);

                var functionButton = document.createElement('button');
                functionButton.type = 'button';
                functionButton.textContent = 'Add more Valuation';
                functionButton.onclick = addMoreValuation;
                functionButton.className = 'function-button';

                container.appendChild(functionButton);

                // Remove the function button from the previous container
                if (previousValuationContainer) {
                    var previousFunctionButton = previousValuationContainer.querySelector('.function-button');
                    if (previousFunctionButton) {
                        previousFunctionButton.remove();
                    }
                }

                valuationCount++;

                // Remove the function button from the initial container
                if (initialValuationContainer === null) {
                    initialValuationContainer = container;
                } else {
                    var initialFunctionButton = initialValuationContainer.querySelector('.function-button');
                    if (initialFunctionButton) {
                        initialFunctionButton.remove();
                    }
                }

                previousValuationContainer = container;
            }