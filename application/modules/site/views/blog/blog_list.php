<?php
		
		$result = '';
		
		//if users exist display them
	
		if ($query->num_rows() > 0)
		{	
			//get all administrators
			$administrators = $this->users_model->get_all_administrators();
			if ($administrators->num_rows() > 0)
			{
				$admins = $administrators->result();
			}
			
			else
			{
				$admins = NULL;
			}
			
			foreach ($query->result() as $row)
			{
				$post_id = $row->post_id;
				$blog_category_name = $row->blog_category_name;
				$blog_category_id = $row->blog_category_id;
				$post_title = $row->post_title;
				$post_status = $row->post_status;
				$post_views = $row->post_views;
				$image = base_url().'assets/images/posts/'.$row->post_image;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
				$categories_query = $this->blog_model->get_all_post_categories($blog_category_id);
				$description = $row->post_content;
				$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
				$created = $row->created;
				$day = date('j',strtotime($created));
				$month = date('M Y',strtotime($created));
				
				$categories = '';
				$count = 0;
				//get all administrators
				$administrators = $this->users_model->get_all_administrators();
				if ($administrators->num_rows() > 0)
				{
					$admins = $administrators->result();
					
					if($admins != NULL)
					{
						foreach($admins as $adm)
						{
							$user_id = $adm->user_id;
							
							if($user_id == $created_by)
							{
								$created_by = $adm->first_name;
							}
						}
					}
				}
				
				else
				{
					$admins = NULL;
				}
				
				foreach($categories_query->result() as $res)
				{
					$count++;
					$category_name = $res->blog_category_name;
					$category_id = $res->blog_category_id;
					
					if($count == $categories_query->num_rows())
					{
						$categories .= '<a href="'.site_url().'blog/category/'.$category_id.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>';
					}
					
					else
					{
						$categories .= '<a href="'.site_url().'blog/category/'.$category_id.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>, ';
					}
				}
				$comments_query = $this->blog_model->get_post_comments($post_id);
				//comments
				$comments = 'No Comments';
				$total_comments = $comments_query->num_rows();
				if($total_comments == 1)
				{
					$title = 'comment';
				}
				else
				{
					$title = 'comments';
				}
				
				if($comments_query->num_rows() > 0)
				{
					$comments = '';
					foreach ($comments_query->result() as $row)
					{
						$post_comment_user = $row->post_comment_user;
						$post_comment_description = $row->post_comment_description;
						$date = date('jS M Y H:i a',strtotime($row->comment_created));
						
						$comments .= 
						'
							<div class="user_comment">
								<h5>'.$post_comment_user.' - '.$date.'</h5>
								<p>'.$post_comment_description.'</p>
							</div>
						';
					}
				}
				
				$result .= 
				'
				<article id="post-734" class="post-734 post type-post status-publish format-image has-post-thumbnail hentry category-history blist">
						<div class="blog-mask">
							<div class="blog-image">
								<div class="blog-large-image">
									<a href="'.site_url().'news/view-single/'.$post_id.'"><img width="770" height="512" src="'.$image.'" class="attachment-homeland_theme_large wp-post-image" alt="web-IMG_5274"></a>
									<a href="'.site_url().'news/view-single/'.$post_id.'" class="continue">
										Learn More →
									</a>	
								</div>					
							</div>		
						</div>
						<div class="blog-list-desc clear">
							<div class="blog-text">
								<h4><a href="'.site_url().'news/view-single/'.$post_id.'">'.$post_title.'</a></h4>	
								<div class="blog-icon">
									<i class="fa fa-picture-o fa-lg"></i>			
								</div>
							</div>
							<div class="blog-action">
								<ul class="clear">
									<li><i class="fa fa-calendar"></i>'.$day.' '.$month.'</li>
									<li><i class="fa fa-user"></i>admin</li>
									<li><i class="fa fa-folder-o"></i>'.$categories.'</li>
									<li><i class="fa fa-comment"></i><a href="'.site_url().'news/view-single/'.$post_id.'#comments">'.$total_comments.' '.$title.'</a></li>				
								</ul>			
							</div>		
						</div>
					</article>
				
				';
			}
		}
		
		else
		{
			$result .= "There are no posts :-(";
		}
?>

<div class="col-sm-12 col-md-12 col-xs-12">
	<section class="theme-pages">
		<div class="inside clear">
			<!--LEFT CONTAINER-->			
			<div class="col-sm-9 col-md-9 col-xs-9">				
				<div class="blog-list clear">
					<?php echo $result;?>			
				</div>
			</div>
			<div class="col-sm-3 col-md-3 col-xs-3">
			<!--SIDEBAR-->	
			<?php echo $this->load->view('property/sidebar.php', '', TRUE); ?>
			</div>
	
		</div>
	</section>
</div>