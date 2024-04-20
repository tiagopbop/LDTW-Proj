<?php

    function getAllCategories($db) {
        $stmt = $db->prepare('SELECT Category.*
                              FROM Category
                              ORDER BY Category.categoryName ASC')

        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getCategoryItem($db, $id) {
        $stmt = $db->prepare('SELECT * FROM Category WHERE categoryId = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

?>