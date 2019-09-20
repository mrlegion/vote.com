<?php


namespace app\controllers;


use yii\base\Controller;

class ParseController extends Controller
{
    public function actionIndex() {
        $second = $this->get_node('http://cikrf.ru/services/lk_tree/');
        //$this->get_tree($second[0]['children']);
        $this->tree($second[0]['children']);
        return $this->render('index');
    }

    function tree($node) {
        if (empty($node)) return;
        $this->print_child($node);
        foreach ($node as $child) {
            $children = $this->get_json_to_array(['id' => $child['id']]);
            $this->print_child($children);
            $this->tree($children);
        }
    }

    function print_child($arr) {
        foreach ($arr as $item) {
            $this->print_name($item);
        }
    }

    function print_name($arr) {
        echo 'ID: { ' . $arr['id'] . ' };  TEXT: { ' . $arr['text'] . ' };<br>';
    }

    function normJsonStr($str){
        $str = preg_replace_callback('/\\\\u([a-f0-9]{4})/i', create_function('$m', 'return chr(hexdec($m[1])-1072+224);'), $str);
        return iconv('cp1251', 'utf-8', $str);
    }

    function get_json(array $post, $useGet = false) {
        //get json
        $connection = curl_init();
        $url = 'http://cikrf.ru/services/lk_tree/';
        if ($useGet) {
            $url .= '?';
            foreach ($post as $key => $value)
                $url .= $key . '=' . $value . '&';
            $url = rtrim($url, '&');
        }
        curl_setopt($connection, CURLOPT_URL, $url);
        if (!$useGet)
            curl_setopt($connection, CURLOPT_POSTFIELDS, $post);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1); // return the result, do not print
        curl_setopt($connection, CURLOPT_TIMEOUT, 20);

        $json_return = $this->normJsonStr(curl_exec($connection));

        curl_close($connection);

        return json_decode($json_return);
    }

    function get_json_to_array(array $request) {
        $connection = curl_init();
        $url = 'http://cikrf.ru/services/lk_tree/?';
        foreach ($request as $key => $value)
            $url .= $key . '=' . $value . '&';
        $url = rtrim($url, '&');
        curl_setopt($connection, CURLOPT_URL, $url);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1); // return the result, do not print
        curl_setopt($connection, CURLOPT_TIMEOUT, 20);
        $json_return = $this->normJsonStr(curl_exec($connection));
        curl_close($connection);
        return json_decode($json_return, true);
    }

    function get_tree(array $node) {
        $url = 'http://cikrf.ru/services/lk_tree/';
        if (!empty($node)) {
            foreach ($node as $item) {
                echo $item['id'] . ' : ' . $item['text'] . '<br>';
                $this->get_tree($this->get_json_to_array(['id' => $item['id']]));
            }
        }
    }

    function get_node($url) : array {
        $content = file_get_contents($url);
        return json_decode($this->normJsonStr($content), true);
    }

}