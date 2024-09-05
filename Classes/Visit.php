<?php

namespace MyApp\Classes; 

class Visit extends Db {
    public $con;
    public function __construct() {
        $this->con = $this->con();
    }
    public function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            ob_start();
            session_start();
        }
    }
    public function endSession() {
        session_unset();
        session_destroy();
    }
    public function unique_visitors_count() {
        $stmt = $this->con->prepare("SELECT COUNT(DISTINCT ip_address) AS unique_visitors FROM visits");

        $stmt->execute();
        $result = $stmt->get_result();
        echo $result->fetch_assoc()['unique_visitors'];
    }
    public function track_site_visit() {

        if(!isset($_SESSION['first_visit'])) {
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $date_time = datetime_now();
            
            // Set the session
            $_SESSION['first_visit'] = $date_time;

            $stmt = $this->con->prepare("INSERT INTO visits (ip_address, date_time) VALUES (?, ?)");
            $stmt->bind_param("ss", $ip_address, $date_time);
            $stmt->execute();
            $stmt->close();
        } else {
            return;
        }


    }
    public function last_month_unique_visit() {
        // Get the current year and month
        $year = date('Y');
        $month = date('m');

        // Calculate the start and end dates for last month
        $start_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month - 1, 1, $year));
        $end_date = date('Y-m-d H:i:s', mktime(23, 59, 59, $month - 1, date('t', strtotime("-1 month")), $year));

        // Query your database for unique visitors that occurred between the two dates
        $stmt = $this->con->prepare("SELECT COUNT(DISTINCT ip_address) AS unique_visitors FROM visits WHERE date_time BETWEEN ? AND ?");
        $stmt->bind_param('ss', $one_month_ago, $current_date);
        $stmt->execute();
        $result = $stmt->get_result();
        echo $result->fetch_assoc()['unique_visitors'];
    }
    public function last_twelve_month_unique_visit() {
        // Get the current year and month
        $year = date('Y');
        $month = date('m');
    
        // Calculate the start and end dates for last twelve months
        $start_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, 1, $year - 1));
        $end_date = date('Y-m-d H:i:s', mktime(23, 59, 59, $month, date('t', strtotime($start_date)), $year));
    
        // Query your database for visitors that occurred between the two dates
        $stmt = $this->con->prepare("SELECT COUNT(DISTINCT ip_address) AS unique_visitors FROM visits WHERE date_time BETWEEN ? AND ?");
        $stmt->bind_param('ss', $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['unique_visitors'];
    }
    
    public function last_twelve_month_visit() {
        // Get the current year and month
        $year = date('Y');
        $month = date('m');
    
        // Calculate the start and end dates for last twelve months
        $start_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, 1, $year - 1));
        $end_date = date('Y-m-d H:i:s', mktime(23, 59, 59, $month, date('t', strtotime($start_date)), $year));
    
        // Query your database for visitors that occurred between the two dates
        $stmt = $this->con->prepare("SELECT COUNT(ip_address) AS visitors FROM visits WHERE date_time BETWEEN ? AND ?");
        $stmt->bind_param('ss', $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['visitors'];
    }
    
    public function last_month_visit() {
        // Get the current year and month
        $year = date('Y');
        $month = date('m');

        // Calculate the start and end dates for last month
        $start_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month - 1, 1, $year));
        $end_date = date('Y-m-d H:i:s', mktime(23, 59, 59, $month - 1, date('t', strtotime("-1 month")), $year));

        // Query your database for unique visitors that occurred between the two dates
        $stmt = $this->con->prepare("SELECT COUNT(ip_address) AS visitors FROM visits WHERE date_time BETWEEN ? AND ?");
        $stmt->bind_param('ss', $one_month_ago, $current_date);
        $stmt->execute();
        $result = $stmt->get_result();
        echo $result->fetch_assoc()['visitors'];
    }

    function getUniqueVisitorsByMonth() {
        // Initialize the result array
        $visitors_by_month = array();
    
        // Get the current date
        $current_date = date('Y-m-d');
    
        // Loop through the past 12 months
        for ($i = 0; $i < 12; $i++) {
            // Calculate the start and end dates for the current month
            $start_date = date('Y-m-01', strtotime("-$i months", strtotime($current_date)));
            $end_date = date('Y-m-t', strtotime($start_date));
    
            // Get the month name
            $month_name = date('M', strtotime($start_date));
            $month_name_2 = ucfirst($month_name);
    
            // Prepare the SQL statement
            $stmt = $this->con->prepare("SELECT COUNT(DISTINCT ip_address) AS unique_visitors FROM visits WHERE date_time BETWEEN ? AND ?");
            $stmt->bind_param('ss', $start_date, $end_date);
            $stmt->execute();
    
            // Get the result and add it to the result array
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $visitors_by_month[$month_name_2] = $row ? $row['unique_visitors'] : 0;
        }
    
        // Return the result array
        return $visitors_by_month;
    }
    
    
    function getVisitorsByMonth() {
        // Initialize the result array
        $visitors_by_month = array();
    
        // Get the current date
        $current_date = date('Y-m-d');
    
        // Loop through the past 12 months
        for ($i = 0; $i < 12; $i++) {
            $start_date = date('Y-m-01', strtotime("-$i months", strtotime($current_date)));
            $end_date = date('Y-m-t', strtotime($start_date));
    
            // Get the month name
            $month_name = date('M', strtotime($start_date));
            $month_name_2 = ucfirst($month_name);
    
            // Prepare the SQL statement
            $stmt = $this->con->prepare("SELECT COUNT(ip_address) AS visitors FROM visits WHERE date_time BETWEEN ? AND ?");
            $stmt->bind_param('ss', $start_date, $end_date);
            $stmt->execute();
    
            // Get the result and add it to the result array
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $visitors_by_month[$month_name_2] = $row ? $row['visitors'] : 0;
        }
    
        // Return the result array
        return $visitors_by_month;
    }
    function visitorsByMonthList() {
        $visitorsByMonth = $this->getVisitorsByMonth();
        return json_encode($visitorsByMonth);
    }
    function uniqueVisitorsByMonthList() {
        $uniqueVisitorsByMonth = $this->getUniqueVisitorsByMonth();
        return json_encode($uniqueVisitorsByMonth);
    }


    // Weeks
    function getUniqueVisitorsByWeek() {
        // Initialize the result array
        $visitors_by_week = array();
        
        // Get the current date
        $current_date = date('Y-m-d');
        
        // Loop through the past 12 weeks
        for ($i = 0; $i < 12; $i++) {
            // Calculate the start and end dates for the current week
            $start_date = date('Y-m-d', strtotime("-$i weeks", strtotime($current_date)));
            $end_date = date('Y-m-d', strtotime("+6 days", strtotime($start_date)));
        
            // Get the week number
            $week_number = date('W', strtotime($start_date));
        
            // Prepare the SQL statement
            $stmt = $this->con->prepare("SELECT COUNT(DISTINCT ip_address) AS unique_visitors FROM visits WHERE date_time BETWEEN ? AND ?");
            $stmt->bind_param('ss', $start_date, $end_date);
            $stmt->execute();
        
            // Get the result and add it to the result array
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $visitors_by_week[$week_number] = $row ? $row['unique_visitors'] : 0;
        }
        
        // Return the result array
        return $visitors_by_week;
    }
    function getVisitorsByWeek() {
        // Initialize the result array
        $visitors_by_week = array();
        
        // Get the current date
        $current_date = date('Y-m-d');
        
        // Loop through the past 12 weeks
        for ($i = 0; $i < 12; $i++) {
            // Calculate the start and end dates for the current week
            $start_date = date('Y-m-d', strtotime("-$i weeks", strtotime($current_date)));
            $end_date = date('Y-m-d', strtotime("+6 days", strtotime($start_date)));
        
            // Get the week number
            $week_number = date('W', strtotime($start_date));
        
            // Prepare the SQL statement
            $stmt = $this->con->prepare("SELECT COUNT(ip_address) AS visitors FROM visits WHERE date_time BETWEEN ? AND ?");
            $stmt->bind_param('ss', $start_date, $end_date);
            $stmt->execute();
        
            // Get the result and add it to the result array
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $visitors_by_week[$week_number] = $row ? $row['visitors'] : 0;
        }
        
        // Return the result array
        return $visitors_by_week;
    }
    function visitorsByWeekList() {
        $visitorsByWeek = $this->getVisitorsByWeek();
        return json_encode($visitorsByWeek);
    }
    function uniqueVisitorsByWeekList() {
        $uniqueVisitorsByWeek = $this->getUniqueVisitorsByWeek();
        return json_encode($uniqueVisitorsByWeek);
    }
    public function last_twelve_week_unique_visit() {
        // Calculate the start and end dates for last twelve weeks
        $end_date = date('Y-m-d H:i:s');
        $start_date = date('Y-m-d H:i:s', strtotime('-11 weeks', strtotime($end_date)));
    
        // Query your database for visitors that occurred between the two dates
        $stmt = $this->con->prepare("SELECT COUNT(DISTINCT ip_address) AS unique_visitors FROM visits WHERE date_time BETWEEN ? AND ?");
        $stmt->bind_param('ss', $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['unique_visitors'];
    }
    
    public function last_twelve_week_visit() {
        // Calculate the start and end dates for last twelve weeks
        $end_date = date('Y-m-d H:i:s');
        $start_date = date('Y-m-d H:i:s', strtotime('-11 weeks', strtotime($end_date)));
    
        // Query your database for visitors that occurred between the two dates
        $stmt = $this->con->prepare("SELECT COUNT(ip_address) AS visitors FROM visits WHERE date_time BETWEEN ? AND ?");
        $stmt->bind_param('ss', $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['visitors'];
    }    

    public function visits() {
        $current_date = date('Y-m-d');
        $current_month = date('M', strtotime($current_date));
        $current_month = ucfirst($current_month);
        $prev_month_date = date('Y-m-d', strtotime("-1 months", strtotime($current_date)));
        $prev_month = date('M', strtotime($prev_month_date));

        $getVisitorsByMonth = $this->getVisitorsByMonth();

        $curMonthVisitors = $getVisitorsByMonth[$current_month];
        $prevMonthVisitors = $getVisitorsByMonth[$prev_month];

        $abs_val = abs($curMonthVisitors - $prevMonthVisitors);
        $diff = $curMonthVisitors - $prevMonthVisitors;
        if($diff > 0) {
            $symbol = '+';
        } else {
            $symbol = '+';
        }

        echo "<h5 class='lh-1 mb-0'>Visitors</h5>
        <small>$curMonthVisitors ($symbol$abs_val)</small>";
    }
}