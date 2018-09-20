<?php

class Post
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function setImpression($user_id)
    {
        $query = "INSERT INTO impressions (user_id) VALUES ($user_id);";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
        {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function setConversion($user_id, $payout)
    {
        $query = "INSERT INTO conversions (user_id, payout) VALUES ($user_id, $payout);";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
        {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

}