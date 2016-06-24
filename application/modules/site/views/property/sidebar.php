<?php

$categories_query = $this->blog_model->get_all_active_category_parents();
if($categories_query->num_rows() > 0)
{
	$categories = '';
	foreach($categories_query->result() as $res)
	{
		$category_id = $res->blog_category_id;
		$category_name = $res->blog_category_name;
		
		$categories .= '<li class="cat-item cat-item-2"><a href="'.site_url().'blog/category/'.$category_id.'" title="View all posts filed under '.$category_name.'">'.$category_name.'</a></li>';
	}
}

else
{
	$categories = 'No categories yet';
}

$comments_query = $this->blog_model->get_latest_comments();
if($comments_query->num_rows() > 0)
{
	$comments = '';
	foreach($comments_query->result() as $res)
	{
		$post_comment_id = $res->post_comment_id;
		$post_id = $res->post_id;
		$post_comment_description = implode(' ', array_slice(explode(' ', $res->post_comment_description), 0, 5));
		
		$comments .= '<li class="recentcomments">
				<a href="'.site_url().'news/view-single/'.$post_id.'" rel="external nofollow" class="url">'.$post_comment_description.'</a>
			</li>';
	}
}

else
{
	$comments = 'No comments yet';
}

$recent_query = $this->blog_model->get_recent_posts();

if($recent_query->num_rows() > 0)
{
	$recent_posts = '';
	
	foreach ($recent_query->result() as $row)
	{
		$post_id = $row->post_id;
		$post_title = $row->post_title;
		$image = base_url().'assets/images/posts/thumbnail_'.$row->post_image;
		$post_comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
		
		$recent_posts .= '
		<li>
			<a href="'.site_url().'news/view-single/'.$post_id.'" title="'.$post_title.'">'.$post_title.'</a>
		</li>
		';
	}
}

else
{
	$recent_posts = 'No posts yet';
}

?>
<div class="sidebar">
	<div id="recent-posts-2" class="widget widget_recent_entries">		
		<h5>Recent posts</h5>		
		<ul>
			<?php echo $recent_posts;?>
		</ul>
	</div>
	<div id="recent-comments-2" class="widget widget_recent_comments">
		<h5>Recent comments</h5>
		<ul id="recentcomments">
			<?php echo $comments;?>
		</ul>
	</div>
	<div id="categories-2" class="widget widget_categories"><h5>Categories</h5>		
		<ul>
        	<?php echo $categories;?>
		</ul>
	</div>
</div>