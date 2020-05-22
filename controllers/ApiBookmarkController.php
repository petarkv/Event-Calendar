<?php
    namespace App\Controllers;

    use App\Core\ApiController;
    use App\Models\EventModel;

    class ApiBookmarkController extends ApiController {
        public function getBookmarks() {
            $bookmarks = $this->getSession()->get('bookmarks', []);
            $this->set('bookmarks', $bookmarks);
        }

        public function addBookmark($eventId) {
            $eventModel = new EventModel($this->getDatabaseConnection());
            $event = $eventModel->getById($eventId);

            if (!$event) {
                $this->set('error', -1);
                return;
            }

            $bookmarks = $this->getSession()->get('bookmarks', []);

            foreach ($bookmarks as $bookmark) {
                if ($bookmark->event_id == $eventId) {
                    $this->set('error', -2);
                    return;
                }
            }

            $bookmarks[] = $event;
            $this->getSession()->put('bookmarks', $bookmarks);

            $this->set('error', 0);
            return;
        }

        public function clear() {
            $this->getSession()->put('bookmarks', []);

            $this->set('error', 0);
        }
    }