<?php
    namespace App\Models;

    use App\Core\DatabaseConnection;
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\BitValidator;

    class UserModel extends Model {
       /*private $dbc;*/

       protected function getFields(): array {   
        return [ 
            'user_id' => new Field((new NumberValidator())->setIntegerLength(10), false),
            'created_at' => new Field((new DateTimeValidator())->allowDate()->allowTime() , false),

            'username' => new Field((new StringValidator(0, 50)) ),
            'password' => new Field((new StringValidator(0, 50)) ),
            'email' => new Field((new StringValidator(0, 30)) ),
            'forename' => new Field((new StringValidator(0, 50)) ),
            'surname' => new Field((new StringValidator(0, 50)) ),
            'user_category' => new Field((new StringValidator(0, 50)) ),
            'is_active' => new Field((new BitValidator())),
            
            /*'user_id' => Field::readonlyInteger(10),
            'created_at' => Field::readonlyDateTime(),

            'username' => Field::editableString(50),
            'password' => Field::editableString(50),
            'email' => Field::editableString(50),
            'forename' => Field::editableString(50),
            'surname' => Field::editableString(50),
            'user_category' => Field::editableString(50),             
            'is_activ' => Field::editableBit(), */              
        ];
    }
       
       /*public function __construct(DatabaseConnection &$dbc) {
           $this->dbc = $dbc;
       }

       public function getById(int $userId) {
           $sql = 'SELECT * FROM user WHERE user_id = ?;';
           $prep = $this->dbc->getConnection()->prepare($sql);
           $res = $prep->execute([$userId]);
           $user = NULL;
           if ($res) {
               $user = $prep->fetch(\PDO::FETCH_OBJ);
           }
           return $user;
       }

       public function getAll(): array {
           $sql = 'SELECT * FROM user;';
           $prep = $this->dbc->getConnection()->prepare($sql);
           $res = $prep->execute();
           $users = [];
           if ($res) {
               $users = $prep->fetchAll(\PDO::FETCH_OBJ);
           }
           return $users;
       }

       public function getByUsername(string $username) {
        $sql = 'SELECT * FROM user WHERE username = ?;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute([$username]);
        $user = NULL;
        if ($res) {
            $user = $prep->fetch(\PDO::FETCH_OBJ);
        }
        return $user;
    }*/

    public function getByUsername(string $username) {
        return $this->getByFieldName('username', $username);        
    }

    public function getByUserCategory(string $user_category) {
        return $this->getByFieldName('user_category', $user_category);        
    }
}
