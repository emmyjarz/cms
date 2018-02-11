<?php
if (isset($_POST['update_post'])) {
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
    $query = "INSERT INTO posts(post_title, post_author, post_category_id, post_status, post_tags, post_content, post_date, post_comment_count) ";
    $query .= "VALUES ('{$post_title}', '{$post_author}', {$post_category_id}, '{$post_status}', '{$post_tags}', '{$post_content}', now(), '{$post_comment_count}') ";
    $create_post_query = mysqli_query($connection, $query);
    confirm($create_post_query);
    header("Location: posts.php");

}

?>
<?php
if(isset($_GET['p_id'])){
    $get_post_id = $_GET['p_id'];
$query = "SELECT * FROM posts WHERE post_id = {$get_post_id} ";
$select_post = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_post)){
    print_r($row);

?>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="">Title</label>
    <input type="text" class="form-control" name="post_title" value = "<?php echo $row['post_title'] ?>">
</div>
<div class="form-group">
    <label for="">Author</label>
    <input type="text" class="form-control" name="post_author" value = "<?php echo $row['post_author'] ?>">
</div>
<div class="form-group">
    <label for="">Category Id</label>
    <input type="text" class="form-control" name="post_category_id" value = "<?php echo $row['post_category_id'] ?>">
</div>
<div class="form-group">
    <label for="">Status</label>
    <input type="text" class="form-control" name="post_status" value = "<?php echo $row['post_status'] ?>">
</div>
<div class="form-group">
   <img id="preview" width="100px" src="../images/<?php echo $row['post_image'] ?>
" alt="">
</div>
<div class="form-group">
    <label for="">Image</label>
    <input type="file" class="form-control" name="post_image" onChange = "previewImage(this)">
</div>
<div class="form-group">
    <label for="">Tags</label>
    <input type="text" class="form-control" name="post_tags" value = "<?php echo $row['post_tags'] ?>">
</div>
<div class="form-group">
    <label for="">Content</label>
    <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $row['post_content'] ?></textarea>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" name="update_post" value="Publish Post">
</div>

</form>
<?php
}
}
?>
<script type="text/javascript">
function previewImage(image) {
        if (image.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#preview").attr("src", e.target.result);
            }
        }
        reader.readAsDataURL(image.files[0]);
    }
</script>