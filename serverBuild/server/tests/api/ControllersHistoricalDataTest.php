<?php
use PHPUnit\Framework\TestCase;

class ControllersHistoricalDataTest extends TestCase
{
    private $db;
    private $controller;

    public function testfindBookingsStatsFound()
    {
        $this->db = new SQLite3("./tests/dbStatistics.db");
        $filterTime = "L.idLesson";
        $filterCourse = "L.idCourse";
        $type = "1";
        $requestMethod = "GET";
        $value = "bookingStatistics";
        $this->controller = new Server\api\ControllersHistoricalData($requestMethod, $this->db, $value, $filterTime, $filterCourse, $type);
        $result = $this->controller->findBookingsStats($filterTime, $filterCourse);
        $this->assertTrue((json_decode($result, true) == null) ? false : true);
    }

    public function testfindBookingsStatsNotFound()
    {
        $this->db = new SQLite3("./tests/dbForTesting.db");
        $filterTime = "L.idLesson";
        $filterCourse = "L.idCourse";
        $type = "1";
        $requestMethod = "GET";
        $value = "bookingStatistics";
        $this->controller = new Server\api\ControllersHistoricalData($requestMethod, $this->db, $value, $filterTime, $filterCourse, $type);
        $result = $this->controller->findBookingsStats($filterTime, $filterCourse);
        $this->assertEquals(0, $result);
    }

    public function testProcessRequestStatsFound()
    {
        $this->db = new SQLite3("./tests/dbStatistics.db");
        $filterTime = "L.idLesson";
        $filterCourse = "L.idCourse";
        $type = "1";
        $requestMethod = "GET";
        $value = "bookingStatistics";
        $this->controller = new Server\api\ControllersHistoricalData($requestMethod, $this->db, $value, $filterTime, $filterCourse, $type);
        $output = $this->controller->processRequest();
        $this->assertNotEquals("0", $output);
        $this->assertFalse(empty($output));
    }

    public function testProcessRequestStatsNotFound()
    {
        $this->db = new SQLite3("./tests/dbForTesting.db");
        $filterTime = "L.idLesson";
        $filterCourse = "L.idCourse";
        $type = "1";
        $requestMethod = "GET";
        $value = "bookingStatistics";
        $this->controller = new Server\api\ControllersHistoricalData($requestMethod, $this->db, $value, $filterTime, $filterCourse, $type);
        $this->assertEquals("0", $this->controller->processRequest());
    }
}
