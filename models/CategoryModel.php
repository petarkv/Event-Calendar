<?php
    namespace App\Models;

    use App\Core\DatabaseConnection;
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;

    class CategoryModel extends Model {
       /*private $dbc;*/

       protected function getFields(): array {
        return [ 
            'category_id' => new Field((new NumberValidator())->setIntegerLength(11), false),
            'name' => new Field((new StringValidator(0, 255)) )
            
            /*'category_id' => Field::readonlyInteger(10),
            
            'name' => Field::editableString(50)*/
        ];
    }
       
       /*public function __construct(DatabaseConnection &$dbc) {
           $this->dbc = $dbc;
       }

       public function getById(int $categoryId) {
           $sql = 'SELECT * FROM category WHERE category_id = ?;';
           $prep = $this->dbc->getConnection()->prepare($sql);
           $res = $prep->execute([$categoryId]);
           $category = NULL;
           if ($res) {
               $category = $prep->fetch(\PDO::FETCH_OBJ);
           }
           return $category;
       }

       public function getAll(): array {
           $sql = 'SELECT * FROM category;';
           $prep = $this->dbc->getConnection()->prepare($sql);
           $res = $prep->execute();
           $categories = [];
           if ($res) {
               $categories = $prep->fetchAll(\PDO::FETCH_OBJ);
           }
           return $categories;
       }*/       
    }
