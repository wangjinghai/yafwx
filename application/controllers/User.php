<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/21
 * Time: 15:35
 */
class UserController extends Yaf\Controller_Abstract{
    public function showAction(){
        //echo 'show';
        $db = new db\mysqldb();
        $sql='select * from names';
        $db->conn();
        $rows = $db->query($sql);
        $this->getView()->assign("rows", $rows);


       // return false;
    }
    public function addAction(){
        $fdate = $_POST['fdata'];
        $ftime = $_POST['ftime'];
        $fname = $_POST['fname'];
        $fnum = $_POST['fnum'];
        $ftel = $_POST['ftel'];
        $farea = $_POST['farea'];
        $ffloor = $_POST['ffloor'];
        $fmemo = $_POST['fmemo'];
        $status = $_POST['status'];

        $db= new db\mysqldb();
        $db->conn();

        $sql = "insert into customer (fdate,ftime,fname,fnum,ftel,farea,ffloor,fmemo,status) values ('".$fdate."','".$ftime."','".$fname."','".$fnum."','".$ftel."','".$farea."','".$ffloor."','".$fmemo."','".$status."') ";
        $on = $db->execute($sql);
        if($on){
            echo '预约成功';
        }else{
            echo '预约失败';
        }
        return false;
    }
}