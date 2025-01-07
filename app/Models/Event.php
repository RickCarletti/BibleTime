<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'database.php';

class Event {

    public static function getAll() {
        $conn = getDbConnection();
        $query = 'SELECT * FROM public.event ORDER BY id';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function insert($data) {
        try {
            $conn = getDbConnection();
            $query = 'INSERT INTO public.event (name, day, month, year, update_str) 
                      VALUES (:name, :day, :month, :year, :update_str)';
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':day', $data['day']);
            $stmt->bindParam(':month', $data['month']);
            $stmt->bindParam(':year', $data['year']);
            $stmt->bindParam(':update_str', $data['update_str']);
            $stmt->execute();

            $eventId = $conn->lastInsertId();

            if (!empty($data['update_str'])) {
                $conn->beginTransaction();
                $stmt = $conn->prepare($data['update_str']);
                $stmt->bindParam(':id', $eventId);
                $stmt->execute();
                $conn->commit();
            }
            return true; // Sucesso
        } catch (PDOException $e) {
            // Lidar com o erro
            error_log($e->getMessage());
            return false; // Falha
        }
    }

    public static function delete($id) {
        try {
            $conn = getDbConnection();
            $query = 'DELETE FROM public.event WHERE id = :id';
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

    public static function getById($id) {
        $conn = getDbConnection();
        $query = 'SELECT * FROM public.event WHERE id = :id';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function update($id, $data) {
        try {
            $conn = getDbConnection();
            $query = 'UPDATE public.event SET 
                        name = :name, 
                        day = :day, 
                        month = :month, 
                        year = :year, 
                        update_str = :update_str
                      WHERE id = :id';
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':day', $data['day']);
            $stmt->bindParam(':month', $data['month']);
            $stmt->bindParam(':year', $data['year']);
            $stmt->bindParam(':update_str', $data['update_str']);
            $stmt->execute();

            if (!empty($data['update_str'])) {
                $conn->beginTransaction();
                $stmt = $conn->prepare($data['update_str']);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $conn->commit();
            }
            
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false; // Falha na execução
        }
    }
}
