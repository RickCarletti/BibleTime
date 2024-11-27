<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'database.php';

class Teste {

    public static function getAll() {
        $conn = getDbConnection();
        $query = 'SELECT * FROM public.teste';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function insert($descricao) {
        $conn = getDbConnection();
        $query = 'INSERT INTO public.teste (descricao) VALUES (:descricao)';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->execute();
    }

    public static function delete($id) {
        $conn = getDbConnection();
        $query = 'DELETE FROM public.teste WHERE id = :id';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public static function getById($id) {
        $conn = getDbConnection();
        $query = 'SELECT * FROM public.teste WHERE id = :id';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function update($id, $descricao) {
        $conn = getDbConnection();
        $query = 'UPDATE public.teste SET descricao = :descricao WHERE id = :id';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
