<?php

class Stat
{
    private $conn;
    private $user_id;
    private $date;
    private $hour;
    private $impressions;
    private $conversions;
    private $payout;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function hours($user_id)
    {
        $query = "SELECT DAYNAME(datetime) as stat_day, HOUR(datetime) as stat_hour, COUNT(impressions.impression_id) as count_impressions, (SELECT COUNT(*) FROM conversions WHERE user_id = $user_id and datetime and HOUR(datetime) = HOUR(impressions.datetime)) as count_conversions, (SELECT SUM(payout) FROM conversions WHERE user_id = $user_id and HOUR(datetime) = HOUR(impressions.datetime)) as sum_payout FROM impressions WHERE impressions.user_id = $user_id GROUP BY HOUR(datetime);";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function month()
    {
        $query = "SELECT impressions.user_id, COUNT(impressions.impression_id) as count_impressions, (SELECT COUNT(*) FROM conversions WHERE user_id = impressions.user_id) as count_conversions, (SELECT SUM(payout) FROM conversions WHERE user_id = impressions.user_id) as sum_payout FROM impressions GROUP BY impressions.user_id;";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function year()
    {
        $query = "SELECT MONTH(datetime) as month, COUNT(impressions.impression_id) as count_impressions, (SELECT COUNT(*) FROM conversions WHERE datetime and MONTH(datetime) = MONTH(impressions.datetime)) as count_conversions, (SELECT SUM(payout) FROM conversions WHERE MONTH(datetime) = MONTH(impressions.datetime)) as sum_payout FROM impressions GROUP BY MONTH(datetime);";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    // For testing

    public function getImpressions()
    {
        $query = 'SELECT * FROM impressions';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;       
    }

    public function getConversions()
    {
        $query = 'SELECT * FROM conversions';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;  
    }
    

}

?>