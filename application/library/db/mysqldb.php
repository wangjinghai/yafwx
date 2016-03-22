<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/20
 * Time: 16:21
 */
namespace db;
class mysqldb{
    private $dbh;
    public function conn(){
        $dsn = "mysql:host=localhost;dbname=test";
        $this->dbh = new \PDO($dsn, 'root', 'root');
        if(!$this->dbh){
            echo '数据库连接错误';
        }
    }

    public function query($sql) {
       $query = $this->dbh->query($sql);
        $query->setFetchMode(\PDO::FETCH_ASSOC);    //设置结果集返回格式,此处为关联数组,即不包含index下标
        $rs = $query->fetchAll();
        return $rs;
    }

    public function execute($sql) {
        if($this->dbh->exec($sql)){
        $bool = '执行成功';
        }else{
            $bool = '执行失败';
        }
        return $bool;
    }
}