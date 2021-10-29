<?php

use App\Core\Database;

class itemsmodel extends Database {
        function all($page = 0, $limit = 12){
            if($page === 0) {
                $sql = "SELECT * FROM ITEMS";
                $result = $this->db->query($sql);
                if($result->num_rows >0){
                    return $result->fetch_all(MYSQLI_ASSOC);
                }else{
                    return false;
                }
            } else{
                $index = ($page-1) *$limit;
                $sql = "SELECT *FROM ITEMS ORDER BY ID ASC LIMIT $limit OFFSET $index";

                $result = $this->db->query($sql);
                if($result->num_rows >0){
                    return $result->fetch_all(MYSQLI_ASSOC);
                }else{
                    return false;
                }
            }
        }
        function totalPage($limit){
            $sql = "SELECT *FROM ITEMS";
                $result = $this->db->query($sql);
                $totalItems = $result->num_rows;

                $totalPage = ceil($totalItems / $limit);
                return $totalPage;
        }
        function getItemsPromotion(){
            $stmt = $this->db->prepare("SELECT * FROM ITEMS");

            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }else{
                return false;
            }
        }
        function getByItems($id){
            $id = intval($id);
            $stmt = $this->db->prepare("SELECT * FROM ITEMS WHERE id = ?");
            $stmt->bind_param("i", $id);

            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }else{
                return false;
            }
        }

        function getById($id){
            $stmt = $this->db->prepare("SELECT * FROM ITEMS WHERE id = ?");
            $stmt->bind_param("i", $id);

            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows >0){
                return $result->fetch_assoc();
            }else{
                return false;
            }
        }

        function getByKeyword($keyword){
            $keyword = '%' . $keyword . '%';
            $stmt = $this->db->prepare("SELECT * FROM ITEMS WHERE name like ?");
            $stmt->bind_param("s", $keyword);

            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }else{
                return false;
            }
        }

        function comment($id, $data){
            // var_dump($data);
            $idItem = $data['idItem'];
            $comment = $data['comment'];
            $stmt = $this->db->prepare("INSERT INTO COMMENT(id_user, id_item, comment) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $id, $idItem, $comment);

            $stmt->execute();
            if ($stmt->error) {
                $error = $stmt->error;
            }
            return true;
        }
        function getComment($idItems){
            $idItems = intval($idItems);
            $stmt = $this->db->prepare("SELECT COMMENT.comment, USERS.fullname FROM COMMENT JOIN USERS ON COMMENT.id_user = USERS.id WHERE id_item = ?");
            $stmt->bind_param("i", $idItems);

            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }else{
                return false;
            }
        }

        //admin
        function allItem(){
            $sql = 'SELECT * FROM ITEMS';
            $result = $this->db->query($sql);
            if($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }else{
                return false;
            }
        }
        function store($data){
            $name = $data['name'];
            $categoryId = $data['categoryId'];
            $price = $data['price'];
            $description = $data['description'];
            $imageName = $data['image'];

            $stmt = $this->db->prepare("INSERT INTO ITEMS(name, id_sport_type, price, description, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("siiss", $name, $categoryId, $price, $description, $imageName);

            $stmt->execute();
            $result = $stmt->affected_rows;

            if ($result < 1) {
            return false;
            } else {
            return true;
            }
        }
        function delete($id){
            $stmt = $this->db->prepare("DELETE FROM ITEMS WHERE id = $id");
            $stmt->bind_param("i", $id);
            $isSuccess = $stmt->execute();
            if(!$isSuccess){
                return $stmt->error;
            } else if($stmt->affected_rows <= 0){
                return "không thể xóa";
            }
        }
        function update($data){
            $name = $data['name'];
            $categoryId = $data['categoryId'];
            $price = $data['price'];
            $description = $data['description'];
            $imageName = $data['image'];
            $id = $data['id'];

            $stmt = $this->db->prepare("UPDATE ITEMS set name = ?, id_sport_type = ?, price = ?, description = ?, image = ? WHERE id = ?");
            $stmt->bind_param("siissi", $name, $categoryId, $price, $description, $imageName, $id);
        
            $stmt->execute();
            $result = $stmt->affected_rows;

            if ($result < 1) {
            return false;
            } else {
            return true;
            }
        }
        function getAllNumber(){
            $sql = "SELECT COUNT(*) FROM ITEMS";

            $result = $this->db->query($sql);

            if ($result->num_rows > 0) {
            return $result->fetch_row()[0];
            } else {
            return false;
            }
            return true;
        }
    }
?>