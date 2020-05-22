<?php
    namespace App\Controllers;

    class UserEventManagementController extends \App\Core\Role\UserRoleController {
        public function events() {
            $userId = $this->getSession()->get('user_id');
                        

            $eventModel = new \App\Models\EventModel($this->getDatabaseConnection());
            $events = $eventModel->getAllByUserId($userId);

            $this->set('events', $events);

            
        }

        /* ADD EVENT */
        public function getAdd() {
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);

            $locationModel = new \App\Models\LocationModel($this->getDatabaseConnection());
            $locations = $locationModel->getAll();
            $this->set('locations', $locations);
        }

        /*public function getAddLocation() {
            $locationModel = new \App\Models\LocationModel($this->getDatabaseConnection());
            $locations = $locationModel->getAll();
            $this->set('locations', $locations);
        }*/

        public function postAdd() {
            $addData = [
                'title' => filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING),
                'description' => filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING),
                'location_id' => filter_input(INPUT_POST, 'location_id', FILTER_SANITIZE_NUMBER_INT),
                'place_name' => filter_input(INPUT_POST, 'place_name', FILTER_SANITIZE_STRING),
                'place_address' => filter_input(INPUT_POST, 'place_address', FILTER_SANITIZE_STRING),
                'ticket_price' => sprintf("%.2f", filter_input(INPUT_POST, 'ticket_price', FILTER_SANITIZE_STRING)),
                'start_event' => filter_input(INPUT_POST, 'start_event', FILTER_SANITIZE_STRING),
                'start_time' => filter_input(INPUT_POST, 'start_time', FILTER_SANITIZE_STRING),
                'end_event' => filter_input(INPUT_POST, 'end_event', FILTER_SANITIZE_STRING),
                'end_time' => filter_input(INPUT_POST, 'end_time', FILTER_SANITIZE_STRING),
                'url' => filter_input(INPUT_POST, 'url', FILTER_SANITIZE_STRING),
                'category_id' => filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT),
                'user_id' => $this->getSession()->get('user_id')   
            ];

            #print_r($addData);
            #exit;

            $eventModel = new \App\Models\EventModel($this->getDatabaseConnection());
            $eventId = $eventModel->add($addData);  
            
            if (!$eventId) {
                $this->set('message', 'Event is not added.');
                return;
            }

            $uploadStatus = $this->doImageUpload('image', $eventId);
            if (!$uploadStatus) { 
                $this->set('message', 'Event is added, but image is not added');               
                return; 
            }

            $this->redirect('/EventCalendar/user/events');
        }
         


            

         /* EDIT EVENT */
        public function getEdit($eventId) {
            $eventModel = new \App\Models\EventModel($this->getDatabaseConnection());
            $event = $eventModel->getById($eventId);

            if (!$event) {
                $this->redirect('/EventCalendar/user/events');
                return;
            }

            if ($event->user_id != $this->getSession()->get('user_id')) {
                $this->redirect('/EventCalendar/user/events');
                return;
            }

            $event->start_event = str_replace(' ', 'T', substr($event->start_event, 0, 16));
            $event->end_event = str_replace(' ', 'T', substr($event->end_event, 0, 16));

            $this->set('event', $event);


            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);

            $locationModel = new \App\Models\LocationModel($this->getDatabaseConnection());
            $locations = $locationModel->getAll();
            $this->set('locations',$locations);
        }

        public function postEdit($eventId) {
            $this->getEdit($eventId);

            $editData = [
                'title' => filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING),
                'description' => filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING),
                'location_id' => filter_input(INPUT_POST, 'location_id', FILTER_SANITIZE_NUMBER_INT),
                'place_name' => filter_input(INPUT_POST, 'place_name', FILTER_SANITIZE_STRING),
                'place_address' => filter_input(INPUT_POST, 'place_address', FILTER_SANITIZE_STRING),
                'ticket_price' => sprintf("%.2f", filter_input(INPUT_POST, 'ticket_price', FILTER_SANITIZE_STRING)),
                'start_event' => filter_input(INPUT_POST, 'start_event', FILTER_SANITIZE_STRING),
                'start_time' => filter_input(INPUT_POST, 'start_time', FILTER_SANITIZE_STRING),
                'end_event' => filter_input(INPUT_POST, 'end_event', FILTER_SANITIZE_STRING),
                'end_time' => filter_input(INPUT_POST, 'end_time', FILTER_SANITIZE_STRING),
                'url' => filter_input(INPUT_POST, 'url', FILTER_SANITIZE_STRING),
                'category_id' => filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT),               
            ];

            $eventModel = new \App\Models\EventModel($this->getDatabaseConnection());

            $res = $eventModel->editById($eventId, $editData);
            
            if (!$res) {
                $this->set('message', 'Event is not edited.');
                return;
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $uploadStatus = $this->doImageUpload('image', $eventId);
                if(!$uploadStatus) {
                    return;
                }
            }
            
            $uploadStatus = $this->doImageUpload('image', $eventId);
            if (!$uploadStatus) { 
                #$this->set('message', 'Event is edited, but image is not added');               
                return; 
            }

            $this->redirect('/EventCalendar/user/events');
        }

        private function doImageUpload(string $fieldName, string $fileName): bool {

            unlink(\Configuration::UPLOAD_DIR . $fileName . '.jpg');

            $uploadPath = new \Upload\Storage\FileSystem(\Configuration::UPLOAD_DIR);
            $file = new \Upload\File($fieldName, $uploadPath);
            $file->setName($fileName);
            $file->addValidations([
                new \Upload\Validation\Mimetype("image/jpeg"),
                new \Upload\Validation\Size("3M"),
                #new \Upload\Validation\Dimensios(320, 240)
            ]);

            $data = array(
                'name'       => $file->getNameWithExtension(),
                'extension'  => $file->getExtension(),
                'mime'       => $file->getMimetype(),
                'size'       => $file->getSize(),
                'md5'        => $file->getMd5(),
                'dimensions' => $file->getDimensions()
            );

            try {
                $file->upload();
                return true;
            } catch (\Exception $e) {
                $this->set('message', 'Error: ' . \implode(', ', $file->getErrors()));
                return false;
            }
        }

            

            
            
        /*    $offerModel = new \App\Models\OfferModel($this->getDatabaseConnection());
            $offer = $offerModel->getAllByAuctionId($auctionId);
            if (count($offer) > 0) {
                $this->redirect( \Configuration::BASE . 'user/auctions' );
                return;

            
            }*/
        

            
            
    /*        

            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);
        }

        

        $uploadStatus = $this->doImageUpload('image', $auctionId);
            if (!$uploadStatus) {                
                return; 
            }

            

            
        }

        */
    }
