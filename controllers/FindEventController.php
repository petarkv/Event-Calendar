<?php
    namespace App\Controllers;

    use App\Core\Controller;
    use App\Core\Model;
    use App\Models\LocationModel;

    
    class FindEventController extends Controller {
        
        public function getFindEvent() {
            $locationModel = new \App\Models\LocationModel($this->getDatabaseConnection());
            $locations = $locationModel->getAll();
            $this->set('locations', $locations);

            
                       
        }

        public function postFindEventCity() {
            $eventModel = new \App\Models\FindEventModel($this->getDatabaseConnection()); 
            
            $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING); 
             
            $eventscities = $eventModel->getAllByCity($city);
            #print_r($eventscities);
            #exit;            
            $this->set('eventscities', $eventscities); 
            
            
            #$locationModel = new \App\Models\LocationModel($this->getDatabaseConnection());
            #$locations = $locationModel->getAll();
            #$this->set('locations', $locations);
           
            #$eventPlace = $this->getPlace($city);            
            #$this->set('eventPlace', $eventPlace);
        }


        /*private function getPlace(int $locationId) {
            $locationModel = new LocationModel($this->getDatabaseConnection());
            $location = $locationModel->getByFieldName($locationId);
            $place = $location->name;            
            
            return $place;            
        }*/
    }