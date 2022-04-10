<?php


class newprop
{
    public function insert_prop($post)
    {
        $data['name'] = $post['propname'];

        $insertProp = new Database();

        $ExistProp = $insertProp->getItemByValue('properties', 'name', $data['name']);

        if($ExistProp){
            foreach($ExistProp as $key){
                $key['name'] = $data['name'];
            }
            $wrongprop = "Már van ilyen tulajdonság";
            echo $wrongprop;
        }else{
            $insertProp->insert('properties', $data);
            header('Location:#new-properties');
        }
    }
}
