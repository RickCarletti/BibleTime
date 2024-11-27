<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'database.php';

class Teste
{

    public static function getAll()
    {
        $conn = getDbConnection();
        $query = 'SELECT * FROM public.teste ORDER BY id';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function insert($descricao)
    {
        try {
            $conn = getDbConnection();
            $query = 'INSERT INTO public.teste (descricao) VALUES (:descricao)';
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->execute();
            return true; // Sucesso
        } catch (PDOException $e) {
            // Lidar com o erro
            return false; // Falha
        }
    }


    public static function delete($id)
    {
        try {
            $conn = getDbConnection();
            $query = 'DELETE FROM public.teste WHERE id = :id';
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true; // Sucesso
            }
            return false; // Nenhuma linha foi excluída
        } catch (PDOException $e) {
            return false; // Falha na execução
        }
    }


    public static function getById($id)
    {
        $conn = getDbConnection();
        $query = 'SELECT * FROM public.teste WHERE id = :id';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function update($id, $descricao)
    {
        try {
            $conn = getDbConnection();
            $query = 'UPDATE public.teste SET descricao = :descricao WHERE id = :id';
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true; // Sucesso
            }
            return false; // Nenhuma linha foi atualizada
        } catch (PDOException $e) {
            return false; // Falha na execução
        }
    }
}
