<?php

require_once '../config/config.php';
require_once '../libs/form.php';
require_once '../libs/database.php';

if(isset($_REQUEST['run'])){

    try{
        $form = new Form();

        $form   ->post('name')
                ->validate('minLength', 2)
                ->post('age')
                ->validate('integer')
                ->validate('maxLength', 3)
                //->validate('fiddle')
                ->post('gender');

        $form   ->submit();
        echo 'The form passed';
        $data = $form->fetch();

        echo '<pre>';
        print_r($data);
        echo '</pre>';

        $db = new Database(DB_TYPE,DB_HOST,DB_NAME,DB_USER,DB_PASS);
        $db->insert('person', $data);


    } catch(Exception $e){
        echo $e->getMessage();
    }

  // print_r($form);

}
?>

<form action="?run" method="post">
    Name <input type="text" name="name"/>
    Age <input type="text" name="age"/>
    Gender <select name="gender" >
        <option value="m">male</option>
        <option value="f">female</option>
    </select>
    <button type="submit">Submit</button>
</form>

