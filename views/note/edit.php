

<h1>Note</h1>

    <form action="<?php echo URL;?>note/editSave/<?php echo $this->note['note_id'];?>" method="post" class="form-horizontal">
        <div class="form-group">
            <label for="title" class="control-label col-sm-1">Title</label>
            <div class="col-sm-5">
                 <input type="text" id="title" name="title" class="form-control" value="<?php echo $this->note['title'];?>"/>
            </div>
        </div>
        <div class="form-group">
            <label for="note" class="control-label col-md-1 ">Note</label>
            <div class="col-sm-5">
                <textarea name="content" id="note" class="form-control" rows="3">
                    <?php echo $this->note['content']; ?>
                </textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-7">
                <button type="submit" class="btn btn-default">Create</button>
            </div>
        </div>
    </form>


<?php

//var_dump($this->note);
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 07.04.15
 * Time: 0:24
 */