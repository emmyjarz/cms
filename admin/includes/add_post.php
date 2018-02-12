<?php
if(isset($_POST['create_post'])){
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
$post_category_id = $_POST['post_category_id'];
$post_status = $_POST['post_status'];

$post_image = $_FILES['post_image']['name'];
$post_image_temp = $_FILES['post_image']['tmp_name'];

$post_tags = $_POST['post_tags'];
$post_content = $_POST['post_content'];
$post_date = date('d-m-y');
$post_comment_count = 4;

//move picture from temp location to location that we want.
move_uploaded_file($post_image_temp, "../images/$post_image");
$query = "INSERT INTO posts(post_title, post_author, post_category_id, post_status, post_image, post_tags, post_content, post_date, post_comment_count) ";
$query .= "VALUES ('{$post_title}', '{$post_author}', {$post_category_id}, '{$post_status}','{$post_image}' '{$post_tags}', '{$post_content}', now(), '{$post_comment_count}') ";
$create_post_query = mysqli_query($connection, $query);
confirm($create_post_query);
header("Location: posts.php");

}


?>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="">Title</label>
    <input type="text" class="form-control" name="post_title">
</div>
<div class="form-group">
    <label for="">Author</label>
    <input type="text" class="form-control" name="post_author">
</div>
<div class="form-group">
    <label for="">Category Id</label>
    <input type="text" class="form-control" name="post_category_id">
</div>
<div class="form-group">
    <label for="">Status</label>
    <input type="text" class="form-control" name="post_status">
</div>
<div class="form-group">
    <label for="">Image</label>
    <input type="file" class="form-control" name="post_image">
</div>
<div class="form-group">
    <label for="">Tags</label>
    <input type="text" class="form-control" name="post_tags">
</div>
<div class="form-group">
    <label for="">Content</label>
    <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
</div>

</form>



