<?php


class newcat
{
    public function insert_cat($post)
    {
        $data['name'] = $post['catname'];

        $insertCat = new Database();

        $ExistCat = $insertCat->getItemByValue('categories', 'name', $data['name']);

        if($ExistCat){
            foreach($ExistCat as $key){
                $key['name'] = $data['name'];
            }
            $wrongcat = "Már van ilyen kategória";
            echo $wrongcat;
        }else{
            $insertCat->insert('categories', $data);
            header('Location:#new-category');
        }
    }
}
