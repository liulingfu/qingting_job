<?php

/**
 * FineCMS 公益软件
 *
 * @策划人 李睿
 * @开发组自愿者  邢鹏程 刘毅 陈锦辉 孙华军
 */
	
class QtUser_model extends CI_Model {
    public function shoucanglist($arrObj){
        $tableName = "qtshoucang";
        $userId= $arrObj["userId"];
        $jobType = $arrObj["jobType"];
        if(isset($userId) && isset($jobType)) {
            $sql = "SELECT * FROM fn_$tableName WHERE user_id = ? and job_type = ? ";
            $query = $this->db->query($sql, array($userId,$jobType));
            $row = $query->row_array();
            return $row;
        }
        return array();
    }
    public function shoucang($arrObj){
        $tableName = "qtshoucang";
        $userId= $arrObj["userId"];
        $jobId= $arrObj["jobId"];
        $jobType = $arrObj["jobType"];
        if(isset($userId) && isset($jobId)) {
            $sql = "SELECT count(1) as cnt FROM fn_$tableName WHERE user_id = ? and job_id=? and job_type=? ";
            $query = $this->db->query($sql, array($userId,$jobId,$jobType));
            $row = $query->row_array();
            if($row["cnt"]>0){
                return false;
            }
            $data = array(
                'user_id' => $userId,
                'job_id' => $jobId,
                'job_type' => $jobType
            );
            $fetchrow = $this->db->insert($tableName, $data);
            return $fetchrow;
        }
        return 0;
    }
    public function login($arrObj,&$resultRow){
        $tableName = "qtuser";
        $username= $arrObj["username"];
        $password= $arrObj["password"];
        if(isset($username) && isset($password)) {
            $sql = "SELECT * FROM fn_$tableName WHERE username = ? and password=? ";
            $query = $this->db->query($sql, array($username,$password));
            $resultRow = $query->row_array();
            if (count($resultRow)>0) {
                return true;
            }
        }
        return false;
    }
	 public function register($arrObj){
	     $tableName = "qtuser";
	     $username= $arrObj["username"];
         $password= $arrObj["password"];
         if(isset($username) && isset($password)){
             $sql = "SELECT count(1) as cnt FROM fn_$tableName WHERE username = ? ";
             $query = $this->db->query($sql, array($username));
             $row = $query->row_array();
             if($row["cnt"]>0){
                 return false;
             }
             $this->db->insert($tableName,array(
                 "username"=>$username,
                 "password" => $password
             ));
             return true;
         }
         return false;
     }
}