<?php


class Action
{
    public static function getActions($count=10)
    {

        $db = Db::getConnection();
        $query = $db->prepare('SELECT * FROM actions ORDER BY id DESC LIMIT '.$count.';');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $actions = $query->fetchAll();

        return $actions;
    }

    public static function addAction($amount, $from, $to, $result)
    {
        $db = Db::getConnection();

        $insert_row = $db->prepare("INSERT INTO actions ( amount, cur_from, cur_to, result, date ) VALUES( :amount, :cur_from, :cur_to, :result, :date )");
        $insert_row->execute(array('amount'=>$amount,'cur_from'=>$from,'cur_to'=>$to, 'result'=>$result, 'date'=>date("Y-m-d H:i:s")));

        return true;
    }

}