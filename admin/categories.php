<?php include "includes/admin_header.php"?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>
                    <div class="col-xs-6">
                        <?php //ADD CATEGORY
if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
    if ($cat_title == "" || empty($cat_title)) {
        echo "This field cannot be empty";
    } else {
        $query = "INSERT INTO categories (cat_title) ";
        $query .= "VALUES ('{$cat_title}')";
        $create_category_query = mysqli_query($connection, $query);
        if (!$create_category_query) {
            die("FAIL" . mysqli_error($connection));
        }
    }
}
?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                            </div>
                        </form>
                        <!-- EDIT -->
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Edit Category</label>

                                <?php
if (isset($_GET['edit'])) {
    $cat_id = $_GET['edit'];
    $query = "SELECT * FROM categories WHERE cat_id = {$cat_id} ";
    $select_categories_id = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories_id)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        ?>
                                    <input type="text" class="form-control" name="cat_title" value="<?php if(isset($cat_title))echo $cat_title ?>">
                           


                            <?php

    }

}

?>
 </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Update Category">
                            </div>




                        </form>
                    </div>
                    <!-- Add Category Form -->
                    <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Catagory Title</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php //FIND ALL CATEGORIES QUERY
$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>EDIT</a></td>";
    echo "</tr>";
}
?>
                                <?php //DELETE QUERY
if (isset($_GET['delete'])) {
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
    $delete_query = mysqli_query($connection, $query);
    //refresh page
    header("Location: categories.php");
}
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php"?>