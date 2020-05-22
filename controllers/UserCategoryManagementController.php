<?php
    namespace App\Controllers;

    class UserCategoryManagementController extends \App\Core\Role\UserRoleController {
        public function categories() {
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);
        }

        public function getEdit($categoryId) {
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $category = $categoryModel->getById($categoryId);

            if (!$category) {
                $this->redirect('/EventCalendar/user/categories');
            }

            $this->set('category', $category);

            return $categoryModel;
        }

        public function postEdit($categoryId) {
            $categoryModel = $this->getEdit($categoryId);

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $categoryModel->editById($categoryId, [
                'name' => $name
            ]);

            $this->redirect('/EventCalendar/user/categories');
        }

        public function getAdd() {

        }

        public function postAdd() {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            
            $categoryId = $categoryModel->add([
                'name' => $name
            ]);

            if ($categoryId) {
                $this->redirect('/EventCalendar/user/categories');
            }

            $this->set('message', 'Error: You could not add this Category!');
        }
    }
