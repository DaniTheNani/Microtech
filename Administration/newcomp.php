<?php


class newcomp
{
    public function insert_comp($post, $files)
    {
        $img_name = $files['compimage']['name'];
        $img_size = $files['compimage']['size'];
        $tmp_name = $files['compimage']['tmp_name'];
        $error = $files['compimage']['error'];
        if ($error === 0) {
            if ($img_size > 125000) {
                $em = "Túl nagy a kép mérete!";
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png", "jfif");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . "." . $img_ex;
                    $img_upload_path = '../files/component-image/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                }
            }
        }
        $data['name'] = $post['compname'];
        $data['cat_id'] = $post['compcat'];
        $data['image'] = $new_img_name;

        $insertComp = new Database();

        $ExistComp = $insertComp->getItemByValue('components', 'name', $data['name']);

        if ($ExistComp) {
            foreach ($ExistComp as $key) {
                $key['name'] = $data['name'];
            }
            $wrongcomp = "Már van ilyen Alkatrész";
            echo $wrongcomp;
        } else {
            $insertComp->insert('components', $data);
            header('Location:#new-components');
        }
    }
}
