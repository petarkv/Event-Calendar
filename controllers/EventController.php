<?php
    namespace App\Controllers;

    use App\Core\Controller;
    use App\Models\CategoryModel;
    use App\Models\EventModel;
    use App\Models\LocationModel;
    use App\Models\EventViewModel;
    
    class EventController extends Controller {
        
        public function show($id) {             
            $eventModel = new EventModel($this->getDatabaseConnection());
            $event = $eventModel->getById($id);

            if (!$event) {
                header('Location: /EventCalendar/');
                exit;
            }

            $this->set('event', $event);

            $eventPlace = $this->getPlace($id);            
            $this->set('eventPlace', $eventPlace);

            #$eventAddress = $this->getAddress($id);
            #$this->set('eventAddress', $eventAddress);
            
            


            $eventViewModel = new EventViewModel($this->getDatabaseConnection());

            $ipAddress = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
            $userAgent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');

            $eventViewModel->add(
                [
                    'event_id' => $id,
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent                                   
                ]
            );
        }


        


        private function getPlace($eventId) {
            $locationModel = new LocationModel($this->getDatabaseConnection());
            $location = $locationModel->getEventLocation($eventId);
            $place = $location->name;            
            
            return $place;            
        }

        /*private function getAddress($eventId) {
            $locationModel = new LocationModel($this->getDatabaseConnection());
            $locationAddress = $locationModel->getEventAddress($eventId);
            $address = $locationAddress->address;            
            
            return $address;            
        }*/

        private function normaliseKeywords(string $keywords): string {
            $keywords = trim($keywords);
            $keywords = preg_replace('/ +/', ' ', $keywords);
            return $keywords;
        }

        public function postSearch() {
            $eventModel = new EventModel($this->getDatabaseConnection());

            $q = filter_input(INPUT_POST, 'q', FILTER_SANITIZE_STRING);

            $keywords = $this->normaliseKeywords($q);

            $events = $eventModel->getAllBySearch($q);

            /*print_r($events);
            exit;*/

            $this->set('events', $events);
        }
        
    }