<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'database.php';

class Person {
    public static function getAll() {
        $conn = getDbConnection();
        $query = 'SELECT * FROM public.person ORDER BY id';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function insert($data) {
        try {
            $conn = getDbConnection();
            $conn->beginTransaction();

            // Inserir a pessoa
            $query = 'INSERT INTO public.person 
                (name, start_dt_year, start_dt_month, start_dt_day, end_dt_year, end_dt_month, end_dt_day, id_group, sex, update_str, generation, start_unknown, end_unknown)
                VALUES 
                (:name, :start_dt_year, :start_dt_month, :start_dt_day, :end_dt_year, :end_dt_month, :end_dt_day, :id_group, :sex, :update_str, :generation, :start_unknown, :end_unknown)';

            $stmt = $conn->prepare($query);

            // Mapeamento de parâmetros para substituição
            $params = [
                ':name' => $data['name'],
                ':start_dt_year' => $data['start_dt_year'],
                ':start_dt_month' => $data['start_dt_month'],
                ':start_dt_day' => $data['start_dt_day'],
                ':end_dt_year' => $data['end_dt_year'],
                ':end_dt_month' => $data['end_dt_month'],
                ':end_dt_day' => $data['end_dt_day'],
                ':id_group' => $data['id_group'],
                ':sex' => $data['sex'],
                ':update_str' => $data['update_str'],
                ':generation' => $data['generation'],
                ':start_unknown' => $data['start_unknown'] ? 'TRUE' : 'FALSE',
                ':end_unknown' => $data['end_unknown'] ? 'TRUE' : 'FALSE',
            ];

            // Bind dos parâmetros
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            // Gerar o SQL final substituindo os placeholders
            $finalQuery = $query;
            foreach ($params as $key => $value) {
                if ($value === null) {
                    $value = 'NULL';
                } elseif (is_string($value)) {
                    $value = "'" . addslashes($value) . "'";
                }
                $finalQuery = str_replace($key, $value, $finalQuery);
            }

            // Salvar a query final em um arquivo
            error_log($finalQuery);

            // Executar a query
            $stmt->execute();

            $personId = $conn->lastInsertId();

            // Inserir os relacionamentos
            if (!empty($data['relationships'])) {
                error_log(print_r($data));
                foreach ($data['relationships'] as $relationship) {
                    $relationship['id_person_1'] = $personId;
                    PersonPerson::insert($relationship);
                }
            }

            $conn->commit();

            if (!empty($data['update_str'])) {
                $conn->beginTransaction();
                $stmt = $conn->prepare($data['update_str']);
                $stmt->bindParam(':id', $personId);
                $stmt->execute();
                $conn->commit();
            }
            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log($e->getMessage());
            return false;
        }
    }

    public static function delete($id) {
        try {
            $conn = getDbConnection();
            $conn->beginTransaction();

            // Remover os relacionamentos
            PersonPerson::deleteByPersonId($id);

            // Remover a pessoa
            $query = 'DELETE FROM public.person WHERE id = :id';
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $conn->commit();
            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log($e->getMessage());
            return false;
        }
    }

    public static function getById($id) {
        $conn = getDbConnection();
        $query = 'SELECT * FROM public.person WHERE id = :id';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function update($id, $data) {
        try {
            $conn = getDbConnection();
            $conn->beginTransaction();

            // Atualizar a pessoa
            $query = 'UPDATE public.person SET 
                name = :name,
                start_dt_year = :start_dt_year,
                start_dt_month = :start_dt_month,
                start_dt_day = :start_dt_day,
                end_dt_year = :end_dt_year,
                end_dt_month = :end_dt_month,
                end_dt_day = :end_dt_day,
                id_group = :id_group,
                sex = :sex,
                update_str = :update_str,
                generation = :generation,
                start_unknown = :start_unknown,
                end_unknown = :end_unknown
                WHERE id = :id';

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':start_dt_year', $data['start_dt_year']);
            $stmt->bindParam(':start_dt_month', $data['start_dt_month']);
            $stmt->bindParam(':start_dt_day', $data['start_dt_day']);
            $stmt->bindParam(':end_dt_year', $data['end_dt_year']);
            $stmt->bindParam(':end_dt_month', $data['end_dt_month']);
            $stmt->bindParam(':end_dt_day', $data['end_dt_day']);
            $stmt->bindParam(':id_group', $data['id_group']);
            $stmt->bindParam(':sex', $data['sex']);
            $stmt->bindParam(':update_str', $data['update_str']);
            $stmt->bindParam(':generation', $data['generation']);
            $stmt->bindParam(':start_unknown', $data['start_unknown'], PDO::PARAM_BOOL);
            $stmt->bindParam(':end_unknown', $data['end_unknown'], PDO::PARAM_BOOL);
            $stmt->execute();

            // Atualizar relacionamentos
            PersonPerson::deleteByPersonId($id);
            if (!empty($data['relationships'])) {
                foreach ($data['relationships'] as $relationship) {
                    PersonPerson::insert($relationship);
                }
            }

            $conn->commit();

            if (!empty($data['update_str'])) {
                $conn->beginTransaction();
                $stmt = $conn->prepare($data['update_str']);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $conn->commit();
            }

            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log($e->getMessage());
            return false;
        }
    }

    public static function updateAllStr() {
        try {
            $conn = getDbConnection();
            $conn->beginTransaction();

            $persons = Person::getAll();

            foreach ($persons as $person) {
                if (!empty($person->update_str)) {
                    $stmt = $conn->prepare($person->update_str);
                    $stmt->bindParam(':id', $person->id);
                    $stmt->execute();
                }
            }

            $conn->commit();

            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log($e->getMessage());
            return false;
        }
    }
}
