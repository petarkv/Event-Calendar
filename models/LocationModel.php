<?php
    namespace App\Models;

    use App\Core\DatabaseConnection;
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    

    class LocationModel extends Model {
       /*private $dbc;*/

       protected function getFields(): array {
        return [ 
            'location_id' => new Field((new NumberValidator())->setIntegerLength(11), false),
            'name' => new Field((new StringValidator(0, 255)) ),
            #'address' => new Field((new StringValidator(0, 255)) ),
            #'coordinates' => new Field((new StringValidator(0, 255)) )
            
            /*'location_id' => Field::readonlyInteger(10),            
            'name' => Field::editableString(50),
            'address' => Field::editableString(256),
            'coordinates' => Field::editableString(256),*/
        ];
    }
       
        /*public function __construct(DatabaseConnection &$dbc) {
           $this->dbc = $dbc;
        }

        public function getById(int $locationId) {
           $sql = 'SELECT * FROM location WHERE location_id = ?;';           
           $prep = $this->dbc->getConnection()->prepare($sql);
           $res = $prep->execute([$eventId]);
           $location = NULL;
           if ($res) {
               $location = $prep->fetch(\PDO::FETCH_OBJ);
           }
           return $location;
        }

        public function getAll(): array {
           $sql = 'SELECT * FROM location;';
           $prep = $this->dbc->getConnection()->prepare($sql);
           $res = $prep->execute();
           $locations = [];
           if ($res) {
               $locations = $prep->fetchAll(\PDO::FETCH_OBJ);
           }
           return $locations;
        }*/
       
        /*public function getAllByEventId(int $eventId): array {
        $sql = 'SELECT * FROM event WHERE location_id = ? ORDER BY start_event ASC;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute([$eventId]);
        $locations = [];
        if ($res) {
            $locations = $prep->fetchAll(\PDO::FETCH_OBJ);
        }
        return $locations;
        }*/

        public function getEventLocation(int $eventId) {
            $sql = 'SELECT name FROM location JOIN event WHERE location.location_id = event.location_id and event.event_id = ?;';
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([$eventId]);
            $location = NULL;
            if ($res) {
                $location = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $location;
        }
        
        /*public function getEventAddress(int $eventId) {
            $sql = 'SELECT address FROM location JOIN event WHERE event_id = ?;';
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([$eventId]);
            $locationAddress = NULL;
            if ($res) {
                $locationAddress = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $locationAddress;
        } */    
    }       

