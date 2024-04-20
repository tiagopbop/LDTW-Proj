<?php

    function getAllVehicles($db) {
        $stmt = $db->prepare('SELECT Vehicle.*, COUNT(Review.IdReview) AS Reviews
                              FROM Vehicle LEFT JOIN
                                   Review ON Review.VehicleId = Vehicle.VehicleId
                              GROUP BY Vehicle.VehicleId
                              ORDER BY Vehicle.price ASC')

        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getVehicleItem($db, $id) {
        $stmt = $db->prepare('SELECT * FROM Vehicle WHERE VehicleId = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

?>