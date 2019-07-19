<?php

/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019/7/18
 * Time: 16:38
 */
class PDOController
{

    public static $pdo;

    public function __construct()
    {
        $dbms='mysql';     //数据库类型
        $host='localhost'; //数据库主机名
        $dbName='RSSHub';    //使用的数据库
        $user='root';      //数据库连接用户名
        $pass='123456';          //对应的密码
        $dsn="$dbms:host=$host;dbname=$dbName";

        self::$pdo = new PDO($dsn, $user, $pass); //初始化一个PDO对象
    }

    public static function add(){
        $title = $_REQUEST['title']??'';
        $content = $_REQUEST['content']??'';
        if($title && $content){
            $arr = explode('__',$content);
            $sub = $arr[2];
            $url = $arr[3];

            $sql = "insert into rss (title,sub,url) VALUES ('$title','$sub','$url')";

            try {
                if(self::$pdo->exec($sql)){
                    echo self::$pdo->lastInsertId();
                }else{
                    echo 0;
                }
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
            die();
        }
        echo -1;
    }

    public static function detail(){
        $id = $_REQUEST['id']??'';
        if($id){

            $sql = "select * from rss where id = {$id} limit 1";

            try {
                foreach(self::$pdo->query($sql , PDO::FETCH_ASSOC) as $row){
                    echo json_encode($row);die();
                }
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
            die();
        }
        echo -1;
    }

    public static function route(){
        $sql = "select * from rss";
        $data = [];

        try {
            foreach(self::$pdo->query($sql , PDO::FETCH_ASSOC) as $row){
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}