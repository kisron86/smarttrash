<script type="text/javascript">
var map;
var directionsDisplay = null;
var directionsService;
var polylinePath;

var nodes = [];
var prevNodes = [];
var markers = [];
var durations = [];

$(function() {
  var url;
  url= "<?php echo base_url('Data_ketinggian/getAlat'); ?>"

        $.ajax(
          {
            type: "GET",
            url: url,
          }
        ).done(function( data )
        {
          var jsonObj = JSON.parse(data);
          var count = Object.keys(jsonObj).length;
		  var myjson = JSON.stringify(jsonObj);
		  var lat_lng;
		  
		  //document.getElementById('demo').innerHTML = myjson;
          setTimeout(function () {
              for (var i = 0; i < count; i++) {
               
			   if(i==0){
				   lat_lng = new google.maps.LatLng(-7.276378, 112.793888);
				   nodes.push(lat_lng);
			
					// Update destination count
					$('#destinations-count').html(nodes.length);
			   }
			   lat_lng = new google.maps.LatLng(jsonObj[i].lt,jsonObj[i].lg);
               var nama ="'"+jsonObj[i].lokasi+"'";
               var a = i+1;
               var sContent = '<h4>'+jsonObj[i].lokasi+'</h4>';
                  addMarker(nama,lat_lng,sContent,a*200,jsonObj[i].id_sensor,jsonObj[i].status);
				  
				if(jsonObj[i].status==1){
					nodes.push(lat_lng);
			
					// Update destination count
					$('#destinations-count').html(nodes.length);
				}
              }
          }, 3000);
        });
})
function addMarker(nm,location,sContent, timeout,id_sensor,status) {

console.log(location);
  if (status==1) {
    var image = "<?php echo base_url().'assets/img/icon-penuh.png' ?>";
  }else {
    var image = "<?php echo base_url().'assets/img/icon-aman.png' ?>";
  }
  var marker = new google.maps.Marker({
    position: location,
    map: map,
    icon:image,
    info:sContent,
    visible: true,
    title: nm,
    animation: google.maps.Animation.DROP
  });

  window.setTimeout(function() {
  markers.push(marker);
  }, timeout);

  var infowindow = new google.maps.InfoWindow({
          content: sContent
  });

  marker.addListener('click', function() {
          infowindow.open(map, marker);
          check(id_sensor,nm);
        });
// marker.setMap(map);
}
function check(id,nm) {
  $.ajax({
  type:"GET",
  url: "<?php echo base_url('Data_ketinggian/getTable/'); ?>"+id,
  }).done(function(data) {
    $('#wrapper-table').html(data);
  });
}
// Initialize google maps
function initializeMap() {
	var time_now = new Date().getHours();

        var style_map;
        if (time_now >= 6 && time_now < 18){
            style_map=[
                {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
                {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
                {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
                {
                    featureType: 'administrative',
                    elementType: 'geometry.stroke',
                    stylers: [{color: '#c9b2a6'}]
                },
                {
                    featureType: 'administrative.land_parcel',
                    elementType: 'geometry.stroke',
                    stylers: [{color: '#dcd2be'}]
                },
                {
                    featureType: 'administrative.land_parcel',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#ae9e90'}]
                },
                {
                    featureType: 'landscape.natural',
                    elementType: 'geometry',
                    stylers: [{color: '#dfd2ae'}]
                },
                {
                    featureType: 'poi',
                    elementType: 'geometry',
                    stylers: [{color: '#dfd2ae'}]
                },
                {
                    featureType: 'poi',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#93817c'}]
                },
                {
                    featureType: 'poi.park',
                    elementType: 'geometry.fill',
                    stylers: [{color: '#a5b076'}]
                },
                {
                    featureType: 'poi.park',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#447530'}]
                },
                {
                    featureType: 'road',
                    elementType: 'geometry',
                    stylers: [{color: '#f5f1e6'}]
                },
                {
                    featureType: 'road.arterial',
                    elementType: 'geometry',
                    stylers: [{color: '#fdfcf8'}]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry',
                    stylers: [{color: '#f8c967'}]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry.stroke',
                    stylers: [{color: '#e9bc62'}]
                },
                {
                    featureType: 'road.highway.controlled_access',
                    elementType: 'geometry',
                    stylers: [{color: '#e98d58'}]
                },
                {
                    featureType: 'road.highway.controlled_access',
                    elementType: 'geometry.stroke',
                    stylers: [{color: '#db8555'}]
                },
                {
                    featureType: 'road.local',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#806b63'}]
                },
                {
                    featureType: 'transit.line',
                    elementType: 'geometry',
                    stylers: [{color: '#dfd2ae'}]
                },
                {
                    featureType: 'transit.line',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#8f7d77'}]
                },
                {
                    featureType: 'transit.line',
                    elementType: 'labels.text.stroke',
                    stylers: [{color: '#ebe3cd'}]
                },
                {
                    featureType: 'transit.station',
                    elementType: 'geometry',
                    stylers: [{color: '#dfd2ae'}]
                },
                {
                    featureType: 'water',
                    elementType: 'geometry.fill',
                    stylers: [{color: '#b9d3c2'}]
                },
                {
                    featureType: 'water',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#92998d'}]
                }
            ];
        } else {
            style_map=[
                {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                {
                    featureType: 'administrative.locality',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#d59563'}]
                },
                {
                    featureType: 'poi',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#d59563'}]
                },
                {
                    featureType: 'poi.park',
                    elementType: 'geometry',
                    stylers: [{color: '#263c3f'}]
                },
                {
                    featureType: 'poi.park',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#6b9a76'}]
                },
                {
                    featureType: 'road',
                    elementType: 'geometry',
                    stylers: [{color: '#38414e'}]
                },
                {
                    featureType: 'road',
                    elementType: 'geometry.stroke',
                    stylers: [{color: '#212a37'}]
                },
                {
                    featureType: 'road',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#9ca5b3'}]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry',
                    stylers: [{color: '#746855'}]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry.stroke',
                    stylers: [{color: '#1f2835'}]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#f3d19c'}]
                },
                {
                    featureType: 'transit',
                    elementType: 'geometry',
                    stylers: [{color: '#2f3948'}]
                },
                {
                    featureType: 'transit.station',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#d59563'}]
                },
                {
                    featureType: 'water',
                    elementType: 'geometry',
                    stylers: [{color: '#17263c'}]
                },
                {
                    featureType: 'water',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#515c6d'}]
                },
                {
                    featureType: 'water',
                    elementType: 'labels.text.stroke',
                    stylers: [{color: '#17263c'}]
                }
            ];
        }
    // Map options
    var opts = {
        center: new google.maps.LatLng(-7.281036,112.788105),
        zoom: 12,
        disableDefaultUI: true, //The zoom value.
		zoomControlOptions: { position: google.maps.ControlPosition.LEFT_CENTER },
		fullscreenControlOptions: { position: google.maps.ControlPosition.LEFT_TOP },
		styles: style_map
    };
    map = new google.maps.Map(document.getElementById('map'), opts);
	console.log(map);

    // Create map click event
    /*google.maps.event.addListener(map, 'click', function(event) {
        // Add destination (max 9)
        if (nodes.length >= 9) {
            alert('Max destinations added');
            return;
        }

        // If there are directions being shown, clear them
        clearDirections();
        
        // Add a node to map
        marker = new google.maps.Marker({position: event.latLng, map: map});
        markers.push(marker);
        
        // Store node's lat and lng
        nodes.push(event.latLng);
        
        // Update destination count
        $('#destinations-count').html(nodes.length);
    });*/

    // Add "my location" button
    var myLocationDiv = document.createElement('div');
    new getMyLocation(myLocationDiv, map);

    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(myLocationDiv);
    
    /*function getMyLocation(myLocationDiv, map) {
        var myLocationBtn = document.createElement('button');
        myLocationBtn.innerHTML = 'My Location';
        myLocationBtn.className = 'large-btn';
        myLocationBtn.style.margin = '5px';
        myLocationBtn.style.opacity = '0.95';
        myLocationBtn.style.borderRadius = '3px';
        myLocationDiv.appendChild(myLocationBtn);
    
        google.maps.event.addDomListener(myLocationBtn, 'click', function() {
            navigator.geolocation.getCurrentPosition(function(success) {
                map.setCenter(new google.maps.LatLng(success.coords.latitude, success.coords.longitude));
                map.setZoom(12);
            });
        });
    }*/
}

// Get all durations depending on travel type
function getDurations(callback) {
    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix({
        origins: nodes,
        destinations: nodes,
        travelMode: google.maps.TravelMode[$('#travel-type').val()],
        avoidHighways: parseInt($('#avoid-highways').val()) > 0 ? true : false,
        avoidTolls: false,
    }, function(distanceData) {
        // Create duration data array
        var nodeDistanceData;
        for (originNodeIndex in distanceData.rows) {
            nodeDistanceData = distanceData.rows[originNodeIndex].elements;
            durations[originNodeIndex] = [];
            for (destinationNodeIndex in nodeDistanceData) {
                if (durations[originNodeIndex][destinationNodeIndex] = nodeDistanceData[destinationNodeIndex].duration == undefined) {
                    alert('Error: couldn\'t get a trip duration from API');
                    return;
                }
                durations[originNodeIndex][destinationNodeIndex] = nodeDistanceData[destinationNodeIndex].duration.value;
            }
        }

        if (callback != undefined) {
            callback();
        }
    });
}

// Removes markers and temporary paths
function clearMapMarkers() {
    for (index in markers) {
        markers[index].setMap(null);
    }

    prevNodes = nodes;
    nodes = [];

    if (polylinePath != undefined) {
        polylinePath.setMap(null);
    }
    
    markers = [];
    
    $('#ga-buttons').show();
}
// Removes map directions
function clearDirections() {
    // If there are directions being shown, clear them
    if (directionsDisplay != null) {
        directionsDisplay.setMap(null);
        directionsDisplay = null;
    }
}
// Completely clears map
function clearMap() {
    clearMapMarkers();
    clearDirections();
    
    $('#destinations-count').html('0');
}

// Initial Google Maps
google.maps.event.addDomListener(window, 'load', initializeMap);

// Create listeners
$(document).ready(function() {
    $('#clear-map').click(clearMap);

    // Start GA
    $('#find-route').click(function() {    
        if (nodes.length < 2) {
            if (prevNodes.length >= 2) {
                nodes = prevNodes;
            } else {
                alert('Tempat sampah masih aman !!!');
                return;
            }
        }

        if (directionsDisplay != null) {
            directionsDisplay.setMap(null);
            directionsDisplay = null;
        }
        
        $('#ga-buttons').hide();

        // Get route durations
        getDurations(function(){
            $('.ga-info').show();

            // Get config and create initial GA population
            ga.getConfig();
            var pop = new ga.population();
            pop.initialize(nodes.length);
            var route = pop.getFittest().chromosome;

            ga.evolvePopulation(pop, function(update) {
                $('#generations-passed').html(update.generation);
                $('#best-time').html((update.population.getFittest().getDistance() / 60).toFixed(2) + ' Mins');
            
                // Get route coordinates
                var route = update.population.getFittest().chromosome;
                var routeCoordinates = [];
                for (index in route) {
                    routeCoordinates[index] = nodes[route[index]];
                }
                routeCoordinates[route.length] = nodes[route[0]];

                // Display temp. route
                if (polylinePath != undefined) {
                    polylinePath.setMap(null);
                }
                polylinePath = new google.maps.Polyline({
                    path: routeCoordinates,
                    strokeColor: "#0066ff",
                    strokeOpacity: 0.75,
                    strokeWeight: 2,
                });
                polylinePath.setMap(map);
            }, function(result) {
                // Get route
                route = result.population.getFittest().chromosome;

                // Add route to map
                directionsService = new google.maps.DirectionsService();
                directionsDisplay = new google.maps.DirectionsRenderer();
                directionsDisplay.setMap(map);
                var waypts = [];
                for (var i = 1; i < route.length; i++) {
                    waypts.push({
                        location: nodes[route[i]],
                        stopover: true
                    });
                }
                
                // Add final route to map
                var request = {
                    origin: nodes[route[0]],
                    destination: nodes[route[0]],
                    waypoints: waypts,
                    travelMode: google.maps.TravelMode[$('#travel-type').val()],
                    avoidHighways: parseInt($('#avoid-highways').val()) > 0 ? true : false,
                    avoidTolls: false
                };
                directionsService.route(request, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                    }
                    clearMapMarkers();
                });
            });
        });
    });
});

// GA code
var ga = {
    // Default config
    "crossoverRate": 0.5,
    "mutationRate": 0.1,
    "populationSize": 50,
    "tournamentSize": 5,
    "elitism": true,
    "maxGenerations": 50,
    
    "tickerSpeed": 60,

    // Loads config from HTML inputs
    "getConfig": function() {
        ga.crossoverRate = parseFloat($('#crossover-rate').val());
        ga.mutationRate = parseFloat($('#mutation-rate').val());
        ga.populationSize = parseInt($('#population-size').val()) || 50;
        ga.elitism = parseInt($('#elitism').val()) || false;
        ga.maxGenerations = parseInt($('#maxGenerations').val()) || 50;
    },
    
    // Evolves given population
    "evolvePopulation": function(population, generationCallBack, completeCallBack) {        
        // Start evolution
        var generation = 1;
        var evolveInterval = setInterval(function() {
            if (generationCallBack != undefined) {
                generationCallBack({
                    population: population,
                    generation: generation,
                });
            }

            // Evolve population
            population = population.crossover();
            population.mutate();
            generation++;
            
            // If max generations passed
            if (generation > ga.maxGenerations) {
                // Stop looping
                clearInterval(evolveInterval);
                
                if (completeCallBack != undefined) {
                    completeCallBack({
                        population: population,
                        generation: generation,
                    });
                }
            }
        }, ga.tickerSpeed);
    },

    // Population class
    "population": function() {
        // Holds individuals of population
        this.individuals = [];
    
        // Initial population of random individuals with given chromosome length
        this.initialize = function(chromosomeLength) {
            this.individuals = [];
    
            for (var i = 0; i < ga.populationSize; i++) {
                var newIndividual = new ga.individual(chromosomeLength);
                newIndividual.initialize();
                this.individuals.push(newIndividual);
            }
        };
        
        // Mutates current population
        this.mutate = function() {
            var fittestIndex = this.getFittestIndex();

            for (index in this.individuals) {
                // Don't mutate if this is the elite individual and elitism is enabled 
                if (ga.elitism != true || index != fittestIndex) {
                    this.individuals[index].mutate();
                }
            }
        };

        // Applies crossover to current population and returns population of offspring
        this.crossover = function() {
            // Create offspring population
            var newPopulation = new ga.population();
            
            // Find fittest individual
            var fittestIndex = this.getFittestIndex();

            for (index in this.individuals) {
                // Add unchanged into next generation if this is the elite individual and elitism is enabled
                if (ga.elitism == true && index == fittestIndex) {
                    // Replicate individual
                    var eliteIndividual = new ga.individual(this.individuals[index].chromosomeLength);
                    eliteIndividual.setChromosome(this.individuals[index].chromosome.slice());
                    newPopulation.addIndividual(eliteIndividual);
                } else {
                    // Select mate
                    var parent = this.tournamentSelection();
                    // Apply crossover
                    this.individuals[index].crossover(parent, newPopulation);
                }
            }
            
            return newPopulation;
        };

        // Adds an individual to current population
        this.addIndividual = function(individual) {
            this.individuals.push(individual);
        };

        // Selects an individual with tournament selection
        this.tournamentSelection = function() {
            // Randomly order population
            for (var i = 0; i < this.individuals.length; i++) {
                var randomIndex = Math.floor(Math.random() * this.individuals.length);
                var tempIndividual = this.individuals[randomIndex];
                this.individuals[randomIndex] = this.individuals[i];
                this.individuals[i] = tempIndividual;
            }

            // Create tournament population and add individuals
            var tournamentPopulation = new ga.population();
            for (var i = 0; i < ga.tournamentSize; i++) {
                tournamentPopulation.addIndividual(this.individuals[i]);
            }

            return tournamentPopulation.getFittest();
        };
        
        // Return the fittest individual's population index
        this.getFittestIndex = function() {
            var fittestIndex = 0;

            // Loop over population looking for fittest
            for (var i = 1; i < this.individuals.length; i++) {
                if (this.individuals[i].calcFitness() > this.individuals[fittestIndex].calcFitness()) {
                    fittestIndex = i;
                }
            }

            return fittestIndex;
        };

        // Return fittest individual
        this.getFittest = function() {
            return this.individuals[this.getFittestIndex()];
        };
    },

    // Individual class
    "individual": function(chromosomeLength) {
        this.chromosomeLength = chromosomeLength;
        this.fitness = null;
        this.chromosome = [];

        // Initialize random individual
        this.initialize = function() {
            this.chromosome = [];

            // Generate random chromosome
            for (var i = 0; i < this.chromosomeLength; i++) {
                this.chromosome.push(i);
            }
            for (var i = 0; i < this.chromosomeLength; i++) {
                var randomIndex = Math.floor(Math.random() * this.chromosomeLength);
                var tempNode = this.chromosome[randomIndex];
                this.chromosome[randomIndex] = this.chromosome[i];
                this.chromosome[i] = tempNode;
            }
        };
        
        // Set individual's chromosome
        this.setChromosome = function(chromosome) {
            this.chromosome = chromosome;
        };
        
        // Mutate individual
        this.mutate = function() {
            this.fitness = null;
            
            // Loop over chromosome making random changes
            for (index in this.chromosome) {
                if (ga.mutationRate > Math.random()) {
                    var randomIndex = Math.floor(Math.random() * this.chromosomeLength);
                    var tempNode = this.chromosome[randomIndex];
                    this.chromosome[randomIndex] = this.chromosome[index];
                    this.chromosome[index] = tempNode;
                }
            }
        };
        
        // Returns individuals route distance
        this.getDistance = function() {
            var totalDistance = 0;

            for (index in this.chromosome) {
                var startNode = this.chromosome[index];
                var endNode = this.chromosome[0];
                if ((parseInt(index) + 1) < this.chromosome.length) {
                    endNode = this.chromosome[(parseInt(index) + 1)];
                }

                totalDistance += durations[startNode][endNode];
            }
            
            totalDistance += durations[startNode][endNode];
            
            return totalDistance;
        };

        // Calculates individuals fitness value
        this.calcFitness = function() {
            if (this.fitness != null) {
                return this.fitness;
            }
        
            var totalDistance = this.getDistance();

            this.fitness = 1 / totalDistance;
            return this.fitness;
        };

        // Applies crossover to current individual and mate, then adds it's offspring to given population
        this.crossover = function(individual, offspringPopulation) {
            var offspringChromosome = [];

            // Add a random amount of this individual's genetic information to offspring
            var startPos = Math.floor(this.chromosome.length * Math.random());
            var endPos = Math.floor(this.chromosome.length * Math.random());

            var i = startPos;
            while (i != endPos) {
                offspringChromosome[i] = individual.chromosome[i];
                i++

                if (i >= this.chromosome.length) {
                    i = 0;
                }
            }

            // Add any remaining genetic information from individual's mate
            for (parentIndex in individual.chromosome) {
                var node = individual.chromosome[parentIndex];

                var nodeFound = false;
                for (offspringIndex in offspringChromosome) {
                    if (offspringChromosome[offspringIndex] == node) {
                        nodeFound = true;
                        break;
                    }
                }

                if (nodeFound == false) {
                    for (var offspringIndex = 0; offspringIndex < individual.chromosome.length; offspringIndex++) {
                        if (offspringChromosome[offspringIndex] == undefined) {
                            offspringChromosome[offspringIndex] = node;
                            break;
                        }
                    }
                }
            }

            // Add chromosome to offspring and add offspring to population
            var offspring = new ga.individual(this.chromosomeLength);
            offspring.setChromosome(offspringChromosome);
            offspringPopulation.addIndividual(offspring);
        };
    },
};
</script>
  <div>
    <table>
        <tr>
            <td>
				<input type="hidden" id="travel-type" value="DRIVING"></input>
            </td>
        </tr>
        <tr>
            <td>
                <input type="hidden" id="avoid-highways" value="0"></input>
            </td>
        </tr>
        <tr>
            <td>
				<input type="hidden" id="population-size" value="50"></input>
            </td>
        </tr>
        <tr>
            <td>
				<input type="hidden" id="mutation-rate" value="0.1"></input>
            </td>
        </tr>
        <tr>
            <td>
				<input type="hidden" id="crossover-rate" value="0.5"></input>
            </td>
        </tr>
        <tr>
            <td>
				<input type="hidden" id="elitism" value="1"></input>
            </td>
        </tr>
        <tr>
            <td>
				<input type="hidden" id="maxGenerations" value="50"></input>
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>Generate Jalur Pengambilan</b></td>
        </tr>
        <tr>
            <td>Destinations Count: </td>
            <td id="destinations-count">0</td>
        </tr>
        <tr class="ga-info" style="display:none;">
            <td>Generations: </td><td id="generations-passed">0</td>
        </tr>
        <tr class="ga-info" style="display:none;">
            <td>Best Time: </td><td id="best-time">?</td>
        </tr>
        <tr id="ga-buttons">
            <td colspan="2"><button id="find-route">Start</button> <button id="clear-map">Clear</button></td>
        </tr>
    </table>
  </div>