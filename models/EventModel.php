<?php
    namespace App\Models;

    use App\Core\DatabaseConnection;
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\BitValidator;

    class EventModel extends Model{
       /*private $dbc;*/

       protected function getFields(): array {
        return [
            'event_id' => new Field((new NumberValidator())->setIntegerLength(10), false),
            'created_at' => new Field((new DateTimeValidator())->allowDate()->allowTime() , false),

            'title' => new Field((new StringValidator())->setMaxLength(255) ),
            'description' => new Field((new StringValidator())->setMaxLength(64*1024) ),
            'location_id' => new Field((new NumberValidator())->setIntegerLength(10)),
            'place_name' => new Field((new StringValidator())->setMaxLength(255) ),
            'place_address' => new Field((new StringValidator())->setMaxLength(255) ),
            
            'start_event' => new Field((new DateTimeValidator())->allowDate()->allowTime()),
            'start_time' => new Field((new DateTimeValidator())->allowTime()),
            'end_event' => new Field((new DateTimeValidator())->allowDate()->allowTime()),
            'end_time' => new Field((new DateTimeValidator())->allowTime()),
            'ticket_price' => new Field((new NumberValidator())->setDecimal()
                                                                 ->setUnsigned()
                                                                 ->setIntegerLength(7)
                                                                 ->setMaxDecimalDigits(2) ),
            'url' => new Field((new StringValidator())->setMaxLength(255) ),
            'user_id' => new Field((new NumberValidator())->setIntegerLength(10)),
            'category_id' => new Field((new NumberValidator())->setIntegerLength(10)),
            'is_active' => new Field(new BitValidator()),              
        ];
    }

       /*protected function getFields(): array {
        return [                
            'event_id' => Field::readonlyInteger(10),
            'created_at' => Field::readonlyDateTime(),

            'title' => Field::editableString(256),            
            'description' => Field::editableString(64*1024),
            'location_id' => Field::editableInteger(10),            
            'starts_event' => Field::editableDateTime(),
            'ends_event' => Field::editableDateTime(),
            'ticket_price' => Field::editableMaxDecimal(7, 2),
            'url' => Field::editableString(256),
            'user_id' => Field::editableInteger(10),
            'category_id' => Field::editableInteger(10),
            'is_activ' => Field::editableBit(),
            
        ];
    }*/
       
       
       /*public function __construct(DatabaseConnection &$dbc) {
           $this->dbc = $dbc;
       }

       public function getById(int $eventId) {
           $sql = 'SELECT * FROM event WHERE event_id = ?;';           
           $prep = $this->dbc->getConnection()->prepare($sql);
           $res = $prep->execute([$eventId]);
           $event = NULL;
           if ($res) {
               $event = $prep->fetch(\PDO::FETCH_OBJ);
           }
           return $event;
       }

       public function getAll(): array {
           $sql = 'SELECT * FROM event;';
           $prep = $this->dbc->getConnection()->prepare($sql);
           $res = $prep->execute();
           $events = [];
           if ($res) {
               $events = $prep->fetchAll(\PDO::FETCH_OBJ);
           }
           return $events;
       }*/
       
       /*public function getAllByCategoryId(int $categoryId): array {
        $sql = 'SELECT * FROM event WHERE category_id = ?;';
        $prep = $this->getConnection()->prepare($sql);
        $res = $prep->execute([$categoryId]);
        $events = [];
        if ($res) {
            $events = $prep->fetchAll(\PDO::FETCH_OBJ);
        }
        return $events;
        }  */
        
        public function getAllByCategoryId(int $categoryId): array {
            return $this->getAllByFieldName('category_id',$categoryId);            
        }

        public function getAllByUserId(int $userId): array {
            return $this->getAllByFieldName('user_id',$userId);            
        }
        
        public function getAllBySearch(string $keywords) {
            $sql = 'SELECT * FROM `event` WHERE `title` LIKE ? OR `description` LIKE ?;';

            $keywords = '%' . $keywords . '%';

            $prep = $this->getConnection()->prepare($sql);
            if (!$prep) {
                return [];
            }

            $res = $prep->execute([$keywords, $keywords]);
            if (!$res) {
                return [];
            }

            return $prep->fetchAll(\PDO::FETCH_OBJ);
        }
    }
