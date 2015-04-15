<h1>Edit <?php echo $this->user['login']; ?> </h1>

<?php
 //print_r($this->user);

?>

<form action="<?php echo URL;?>user/editSave/<?php echo $this->user['user_id'];?>" method="post" class="form-inline">
    <div class="form-group col-md-offset-1">
        <label for="login" class="control-label">Login</label>
        <input type="text" name="login" id="login" value="<?php echo $this->user['login'];?>"/>

        <label for="password" class="control-label">Password</label>
        <input type="password" name="password" id="password"/>
    </div>
    <div class="form-group ">
        <label for="role" class="control-label">Role</label>
        <select name="role">
            <option value="default" <?php if($this->user['role'] == 'default') echo 'selected' ;?>>Default</option>
            <option value="admin" <?php if($this->user['role'] == 'admin') echo 'selected' ;?>>Admin</option>
            <option value="owner" <?php if($this->user['role'] == 'owner') echo 'selected' ;?>>Owner</option>
        </select>
    </div>

    <div class="form-group">
        <div class="col-md-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Edit</button>
        </div>
    </div>
</form>