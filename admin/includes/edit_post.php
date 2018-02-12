 <?php
 if(isset($_GET['p_id'])){
 $get_post_id = $_GET['p_id'];
$query = "SELECT * FROM posts WHERE post_id = $get_post_id";
$select_posts_id = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_posts_id)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $get_post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $get_post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
}
}

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
    //in order to still keep the image in database
if(empty($post_image)){
    // $query = "SELECT * FROM posts WHERE post_id = $post_id ";
    // $select_image = mysqli_query($connection, $query);
    // confirm($select_image);
    // while($row = mysqli_fetch_assoc($select_image)){
    //     $post_image = $row['post_image'];
    // }
    $post_image = $get_post_image;
}
if(empty($post_category_id)){
$post_category_id = $get_post_category_id;
}
    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_date = now() ";
    $query .= "WHERE post_id = {$post_id} ";
    $update_post_query = mysqli_query($connection, $query);
    confirm($update_post_query);
    header("Location: posts.php");

}
?>
    <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
            </div>
            <div class="form-group">
                <label for="">Author</label>
                <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
            </div>
            <div class="form-group">
                <select name="post_category_id" id="">
<?php
$query = "SELECT * FROM categories WHERE cat_id = $get_post_category_id ";
$cat_query = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($cat_query)){
    $cat_title = $row['cat_title'];
   echo "<option value='{$cat_id}'>{$cat_title}</option>";
}
?>
                   
                    <?php
$query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);
        confirm($select_categories);
        while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<option value='$cat_id'>{$cat_title}</option>";
        }
        ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
            </div>
            <div class="form-group">
                <img id="preview" width="100px" src="../images/<?php echo $get_post_image; ?>
" alt="Please upload an image">
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <input type="file" class="form-control" name="post_image" onChange="previewImage(this)">
            </div>
            <div class="form-group">
                <label for="">Tags</label>
                <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>">
            </div>
            <div class="form-group">
                <label for="">Content</label>
                <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
            </div>

    </form>
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