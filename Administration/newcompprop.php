<?php

class newcompprop
{

    public function insert_comp_prop($post)
    {
        $data = array();
        $db = new Database();
        var_dump($post);
        die();
        foreach ($post as $result) {
            $properties = $db->getItemByValue('properties', 'id', $result['prop_id']);
            $comp_id = $db->getItemByValue('components', 'id', $result['comp_id']);
            $value = $result['value'];
            $data = [
                'prop_id' => $properties['id'],
                'comp_id' => $comp_id['id'],
                'value' => $value
            ];
            var_dump($data);

            die();
            if ($db->insert('comp_prop', $data)) header('location:../');
            unset($data);
        }
    }
}
