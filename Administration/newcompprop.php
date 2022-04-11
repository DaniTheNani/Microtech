<?php

class newcompprop
{

    public function insert_comp_prop($post)
    {
        $insertCompProp = new Database();
        $db = new Database();
        $compprop = new Database();
        $catprop = new Database();
        $properties = $db->read('properties');
        $components = $db->read('components');
        $data['id'] = $post['compprop'];
        var_dump($data);

        foreach($components as $key){
            $key['id'] = $data;
        }
        var_dump($key['cat_id']);
        die();
        foreach($catprop->cat_prop_inner($data['cat_id']) as $result){

        }
        die();
        foreach($properties as $key){
            $key['name'];
            var_dump($key['id']);
        }
        die();
    }
}
