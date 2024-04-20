<?php

    function getVehicleReviews($db, $id) {
        $stmt = $db->prepare('SELECT *
                              FROM Review JOIN
                                   User USING (UserId)
                              WHERE VehicleId = ?')

        $stmt->execute();
        return $stmt->fetchAll();
    }
    
?>