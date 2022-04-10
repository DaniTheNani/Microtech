<?php

class newcompprop
{

    public function insert_comp_prop($post)
    {

        $db = new Database();
        $compprop = new Database();
        $insertCompProp = new Database();
        $data['name'] = $post['compprop'];
        //$data['value'] = $post[''];
        $component = $db->getItemByValue('components', 'id', $data['name']);
        var_dump($component);
        foreach($component as $key){
        }
        die();
    }
}
