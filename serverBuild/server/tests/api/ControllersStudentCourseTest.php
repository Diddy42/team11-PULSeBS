<?php
use PHPUnit\Framework\TestCase;

class ControllersStudentCourseTest extends TestCase
{
    private $db;
    private $controller;
    private $id;

    protected function setUp(): void
    {
        $this->db = new SQLite3("./tests/dbCourses.db");
    }

    //get courses ok
    public function testGetAListOfValidCoures()
    {
        $this->id = 1;
        $this->controller = new Server\api\ControllersStudentCourse("GET", $this->db, "studentCourses", 1);
        $result = $this->controller->processRequest();
        $this->assertIsArray(json_decode($result));
        $this->assertCount(2, json_decode($result));
    }

    public function testGetAEmptyListOfCourses()
    {
        $this->controller = new Server\api\ControllersStudentCourse("GET", $this->db, "studentCourses", 2);
        $result = $this->controller->processRequest();
        $this->assertEquals($result, 0);
    }

    // get courses with wrong method
    public function testUseWrongMethod()
    {
        $this->controller = new Server\api\ControllersStudentCourse("POST", $this->db, "studentCourses", 1);
        $result = $this->controller->processRequest();
        $this->assertEquals($result, "Invalid request method.");
    }

    //use wrong endpoint
    public function testUseWrongEndpoint()
    {
        $this->controller = new Server\api\ControllersStudentCourse("GET", $this->db, "stiudentcorsi", 1);
        $result = $this->controller->processRequest();
        $this->assertEquals($result, "Invalid endpoint.");
    }
}
