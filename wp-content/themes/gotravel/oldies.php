<?php
				echo ' My trip:  ';
				$boatPrice = boatPrice();
				if($myTrip->boat !== null  ){

					// si no es paseo en lancha sumamos
					if( $_SESSION['boat'] != 'speedboat'    ){

						if( isset( $_SESSION['storedTour']) ){
							echo ' + ';
						//	'stored tour';
							$tourPrice += tourPrice($_SESSION['storedTour'][1], $_SESSION['storedTour'][0] , $adults, $children)	;
						}
						//chequeamos si es deporte acuatico
						if( $isWaterSport ){
							echo ' + ';
							$tourPrice += tourPrice( get_the_title(), mkdf_tours_get_tour_price(get_the_ID()) , $waterSports, 0 )	;
						}else{
							echo ' + ';
							$tourPrice += tourPrice( get_the_title(), mkdf_tours_get_tour_price(get_the_ID()) , $adults, $children)	;
						}				    
					
					}
					totalPrice($boatPrice,$tourPrice);		
											
				}

				
				?>