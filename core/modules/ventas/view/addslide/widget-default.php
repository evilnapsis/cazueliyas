<?php
        	$post = PostData::getById($_POST['post_id']);
        	$post->is_slide =1;
        	$x = $post->update();
        	print "<script>window.location='index.php?view=slider';</script>";
?>
