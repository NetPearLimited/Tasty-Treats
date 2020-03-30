<?php
namespace Phppot;



class Member
{

    private $dbConn;

    private $ds;

    function __construct()
    {
        require_once "./DataSource.php";
        $this->ds = new DataSource();
    }

    function getMemberByName($name)
    {
        $query = "select * FROM tb_users WHERE name = ?";
        // $paramType = "ss";
        $paramType = "s";
        $paramArray = array($name);
        
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        
        return $memberResult;
    }
    
    public function processLogin($username, $password) {
        //$passwordHash = md5($password);

        $query = "select * FROM tb_users WHERE name = ? AND password = ?";
        $paramType = "ss";
        $paramArray = array($username, $password);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);

        if(!empty($memberResult)) {
            $_SESSION["name"] = $memberResult[0]["name"];
            return true;
        }
    }
}