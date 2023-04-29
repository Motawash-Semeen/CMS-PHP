<div class="row">
                <div class="col-md-12">

                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Content</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_post = "SELECT * FROM posts";
                            $result_post = $conn->query($sql_post);
                            if ($result_post->num_rows > 0) {
                                $i = 1;
                                while ($row = $result_post->fetch_array()) {
                                    $cat_id = $row['post_cat_id'];
                                    $sql_cat = "SELECT * FROM categories WHERE cat_id = $cat_id";
                                    $result_cat = $conn->query($sql_cat);
                                    $cat_title = $result_cat->fetch_array();

                                    echo "<tr>
                                                <td>{$i}</td>
                                                <td>{$row['post_author']}</td>
                                                <td>{$row['post_date']}</td>
                                                <td>{$row['post_title']}</td>
                                                <td>{$cat_title['cat_title']}</td>
                                                <td>{$row['post_status']}</td>
                                                <td>
                                                <img src='../images/{$row['post_img']}' width='130'>
                                                </td>
                                                <td width='530'>{$row['post_content']}</td>
                                                <td>{$row['post_tags']}</td>
                                                <td>{$row['post_comment']}</td>
                                                <td class='text-right'>
                                                    <a href='' class='btn btn-link btn-warning btn-just-icon edit'>
                                                                    EDIT
                                                    </a>
                                                    <a href='' class='btn btn-link btn-danger btn-just-icon remove'>
                                                                    DELETE
                                                    </a>
                                                </td>
                                            </tr>";
                                    $i++;
                                }
                            }
                            else{
                                echo"<tr>
                                <td colspan='11' style='text-align: center'>No Data Found</td>
                                </tr>";
                                
                            }
                            ?>
                            <!-- <tr>
                                <td>10</td>
                                <td>Tonmoy</td>
                                <td>25 May 2023</td>
                                <td>Bootstrap</td>
                                <td>Bootstrap</td>
                                <td>Status</td>
                                <td>Image</td>
                                <td>Tags</td>
                                <td>Comments</td>
                                <td>Comments</td>
                                <td>Comments</td>
                            </tr> -->
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- /.container-fluid -->
