<h1>Note</h1>

    <form action="<?php echo URL;?>note/create" method="post" class="form-horizontal">
        <div class="form-group">
            <label for="title" class="control-label col-sm-1">Title</label>
            <div class="col-sm-5">
                 <input type="text" id="title" name="title" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label for="note" class="control-label col-md-1 ">Note</label>
            <div class="col-sm-5">
                <textarea name="content" id="note" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-7">
                <button type="submit" class="btn btn-default">Create</button>
            </div>
        </div>
    </form>

<table class="table table-hover">
<?php

//print_r($this->noteList);

foreach($this->noteList as $key => $value){

    echo '<tr>';
    echo '<td>' . $value['user_id'] . '</td>';
    echo '<td>' . $value['title'] . '</td>';
    echo '<td>' . $value['content'] . '</td>';
    echo '<td>' . $value['date'] . '</td>';
    echo '<td> <a href="' . URL . 'note/edit/' . $value['note_id'] . '" class="btn btn-warning">Edit</a></td>';
    echo '<td> <a href="' . URL . 'note/delete/' . $value['note_id'] . '" class="btn btn-danger">Delete</a></td>';
    echo '</tr>';
}
?>
</table>