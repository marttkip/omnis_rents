<?php
	$post_id = $row->post_id;
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
	$day = date('jS',strtotime($created));
	$month = date('M Y',strtotime($created));
	$tiny_url = '';//$row->tiny_url;
	
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
			<div class="author-block clear">
						<img alt="" src="http://0.gravatar.com/avatar/40b602e6564375ffd02925dd8a94af99?s=100&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D100&amp;r=G" class="avatar avatar-100 photo" height="50" width="50">								<h3>'.$post_comment_user.'&nbsp;'.$date.'</h3>
					</div>					
					<!--COMMENTS TEMPLATE-->	
					<!--COMMENTS-->
					<div class="comments" id="comments">
						<!--<h3>Comments are closed.</h3>-->
						<p>'.$post_comment_description.'</p>
					</div>
			';
		}
	}
?>
<!-- Join  -->

<div class="col-xs-12">
	<section class="theme-pages">
		<div class="inside clear">
			<!--LEFT CONTAINER-->			
			<div class="left-container">				
				<div class="blog-list single-blog clear">
					<article id="post-734" class="post-734 post type-post status-publish format-image has-post-thumbnail hentry category-history blist">
						<div class="blog-mask">		
							<div class="blog-image">
								<img width="770" height="512" src="<?php echo $image;?>" class="attachment-homeland_theme_large wp-post-image" alt="web-IMG_5274">				
							</div>
						</div>
						<div class="blog-list-desc clear">
							<div class="blog-text">
								<h4><?php echo $post_title;?></h4>	
								<div class="blog-icon">
									<i class="fa fa-picture-o fa-lg"></i>												</div>
							</div>
							<div class="blog-action">
								<ul class="clear">
									<li><i class="fa fa-calendar"></i><?php echo $day." ".$month; ?></li>
									<li><i class="fa fa-user"></i>admin</li>
									<li><i class="fa fa-folder-o"></i><?php echo $categories;?></li>
									<li><i class="fa fa-comment"></i><a href=""><?php echo $total_comments;?> <?php echo $title;?></a>
									</li>				
								</ul>			
							</div>		
						</div>
						<?php echo $description;?>
					</article>	
                    
					<!--<div class="blog-tags"></div>
					<div class="share clear">
						<div class="pull-left">
						<span>Share<i class="fa fa-share fa-lg"></i></span>
						</div>
						<div class="pull-right">
							<ul class="clear">	
								<li><a href="#" target="_blank" title="Facebook"><i class="fa fa-facebook fa-lg"></i></a></li>
								<li><a href="#" target="_blank" title="Twitter"><i class="fa fa-twitter fa-lg"></i></a></li>
								<li><a href="#" target="_blank" title="Google+"><i class="fa fa-google-plus fa-lg"></i></a></li>
								<li><a href="#" target="_blank" title="Pinterest"><i class="fa fa-youtube fa-lg"></i></a></li>
							</ul>
						</div>
					</div>-->
                    <h3 class="content-title">Comments</h3>
					<?php echo $comments;?>
					<!--COMMENT FORM-->
                    
                    <div class="widget">
                
                        <h3 class="content-title">Leave a comment</h3>
                		<?php
							$validation_errors = validation_errors();
							$errors = $this->session->userdata('error_message');
							$success = $this->session->userdata('success_message');
							
							if(!empty($validation_errors))
							{
								echo '<div style="color:red;">'.$validation_errors.'</div>';
							}
							
							if(!empty($errors))
							{
								echo '<div style="color:red;">'.$errors.'</div>';
								$this->session->unset_userdata('error_message');
							}
							
							if(!empty($success))
							{
								echo '<div style="color:green;">'.$success.'</div>';
								$this->session->unset_userdata('success_message');
							}
							$title = 'Comment(s)';
							$total_comments = $comments_query->num_rows();
                        ?>
                        <form method="post" action="<?php echo site_url().'blog/add-comment/'.$post_id;?>" class="af-form row">
                
                            <div class="col-sm-6 af-outer af-required">
                                <div class="form-group af-inner">
                                    <input type="text" name="name" id="name" size="30" value="" placeholder="Name" class="form-control placeholder" />
                                    <label class="error" for="name" id="name_error">Name is required.</label>
                                </div>
                            </div>
                
                            <div class="col-sm-6 af-outer af-required">
                                <div class="form-group af-inner">
                                    <input type="text" name="email" id="email" size="30" value="" placeholder="Email *" class="form-control placeholder" />
                                    <label class="error" for="email" id="email_error">Email is required.</label>
                                </div>
                            </div>
                
                            <!--<div class="col-sm-4 af-outer af-required">
                                <div class="form-group af-inner">
                                    <input type="text" name="email" id="subject" size="30" value="" placeholder="Subject" class="form-control placeholder" />
                                    <label class="error" for="email" id="subject_error">Email is required.</label>
                                </div>
                            </div>-->
                
                            <div class="col-sm-12 af-outer af-required">
                                <div class="form-group af-inner">
                                    <textarea name="post_comment_description" id="input-message" cols="30" placeholder="Message *" class="form-control placeholder"></textarea>
                                    <label class="error" for="input-message" id="message_error">Message is required.</label>
                                </div>
                            </div>
                
                            <div class="col-sm-12 af-outer af-required">
                                <div class="form-group af-inner">
                                    <input type="submit" name="submit" class="form-button btn btn-success" id="submit_btn" value="Comment" />
                                </div>
                            </div>
                
                        </form>
                
                    </div>

					<!--NEXT/PREV NAV-->
			    	<!--<div class="post-link-blog clear">
						<span class="prev">
							<a href="" rel="prev">←&nbsp;Previous Post</a>						</span>
						<span class="next"></span>
					</div>-->
				</div>
			</div>

			<!--SIDEBAR-->	
			<?php echo $this->load->view('property/sidebar.php', '', TRUE); ?>
			
		</div>
	</section>
</div>