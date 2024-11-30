<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'database.php';

class PersonPerson {
    public static function getAll() {
        $conn = getDbConnection();
        $query = 'SELECT * FROM public.person_person ORDER BY id';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getById($id) {
        $conn = getDbConnection();
        $query = 'SELECT * FROM public.person_person WHERE id = :id';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function insert($data) {
        try {
            $conn = getDbConnection();
            $query = 'INSERT INTO public.person_person 
                (id_person_1, id_person_2, relationship) 
                VALUES 
                (:id_person_1, :id_person_2, :relationship)';

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_person_1', $data['id_person_1']);
            $stmt->bindParam(':id_person_2', $data['id_person_2']);
            $stmt->bindParam(':relationship', $data['relationship']);
            $stmt->execute();
            return true; // Sucesso
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false; // Falha
        }
    }

    public static function delete($id) {
        try {
            $conn = getDbConnection();
            $query = 'DELETE FROM public.person_person WHERE id = :id';
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true; // Sucesso
            }
            return false; // Nenhuma linha foi excluída
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false; // Falha na execução
        }
    }

    public static function update($id, $data) {
        try {
            $conn = getDbConnection();
            $query = 'UPDATE public.person_person SET 
                id_person_1 = :id_person_1,
                id_person_2 = :id_person_2,
                relationship = :relationship
                WHERE id = :id';

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':id_person_1', $data['id_person_1']);
            $stmt->bindParam(':id_person_2', $data['id_person_2']);
            $stmt->bindParam(':relationship', $data['relationship']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true; // Sucesso
            }
            return false; // Nenhuma linha foi atualizada
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false; // Falha na execução
        }
    }

    public static function deleteByPersonId($personId) {
        try {
            $conn = getDbConnection();
            $query = 'DELETE FROM public.person_person 
                      WHERE id_person_1 = :id_person_1 OR id_person_2 = :id_person_2';

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_person_1', $personId);
            $stmt->bindParam(':id_person_2', $personId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public static function getByPersonId($personId) {
        try {
            $conn = getDbConnection();
            $query = 'SELECT * FROM public.person_person 
                      WHERE id_person_1 = :id_person_1 OR id_person_2 = :id_person_2';

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_person_1', $personId);
            $stmt->bindParam(':id_person_2', $personId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
