<?php
    namespace App\Models;

    use App\Core\DatabaseConnection;
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\BitValidator;

    class FindEventModel extends Model{
       /*private $dbc;*/

       protected function getFields(): array {
        return [
            
            
            'location_id' => new Field((new NumberValidator())->setIntegerLength(10)),
            'start' => new Field((new DateTimeValidator())->allowDate()),
            'end' => new Field((new DateTimeValidator())->allowDate()),
                     
        ];
    }       
            
        public function getAllByCity(int $locationId): array {
        $sql = 'SELECT * FROM event JOIN location WHERE event.location_id = location.location_id AND location.location_id = ?;';
        #$prep = $this->getConnection()->prepare($sql);
        #$res = $prep->execute([$locationId]);
        #$cities = [];
        #if ($res) {
            #$cities = $prep->fetchAll(\PDO::FETCH_OBJ);
        #}
        #return $cities;

        $prep = $this->getConnection()->prepare($sql);
        if (!$prep) {
            return [];
        }

        $res = $prep->execute([$locationId]);
        if (!$res) {
            return [];
        }
        return $prep->fetchAll(\PDO::FETCH_OBJ);
        }
        
        
        public function getAllByCityDate(int $locationId): array {
            $sql = 'SELECT * FROM event JOIN location WHERE event.location_id = location.location_id AND location.location_id = ?;';
            #$prep = $this->getConnection()->prepare($sql);
            #$res = $prep->execute([$locationId]);
            #$cities = [];
            #if ($res) {
                #$cities = $prep->fetchAll(\PDO::FETCH_OBJ);
            #}
            #return $cities;
    
            $prep = $this->getConnection()->prepare($sql);
            if (!$prep) {
                return [];
            }
    
            $res = $prep->execute([$locationId]);
            if (!$res) {
                return [];
            }
            return $prep->fetchAll(\PDO::FETCH_OBJ);
            }    
        
    }
