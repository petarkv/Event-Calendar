<?php
    namespace App\Controllers;

    use App\Core\Controller;
    use App\Models\CategoryModel;
    use App\Models\EventModel;
    
    class CategoryController extends Controller {
        
        public function show($id) { 
            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $category = $categoryModel->getById($id);

            if (!$category) {
                header('Location: /EventCalendar/');
                exit;
            }

            $this->set('category', $category); 
            
            $eventModel = new EventModel($this->getDatabaseConnection());
            $eventsInCategory = $eventModel->getAllByCategoryId($id);            

            $this->set('eventsInCategory', $eventsInCategory);
        }
    }