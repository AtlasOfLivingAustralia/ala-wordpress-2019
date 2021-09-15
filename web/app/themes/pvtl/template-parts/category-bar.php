<div class="category-selector">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 order-first">
			<h3 class="ala-blog-title">ALA Blog</h3>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
	<label for="categorySelect" class="sr-only">Filter by Category</label>
	<select id="categorySelect" name="categorySelect" class="custom-select custom-select-lg" onchange='document.location.href=this.options[this.selectedIndex].value;'>
		<option value=""><?php echo esc_attr(__('Filter by Category')); ?></option>

		<?php
		$option = '<option value="' . get_permalink(get_option('page_for_posts')) .'">All Categories</option>'; // change category to your custom page slug
		$defaults = array('type' => 'post',
		    'child_of' => 0,
		    'orderby' => 'name',
		    'order' => 'ASC',
		    'hide_empty' => true,
		    'include_last_update_time' => false,
		    'hierarchical' => 1, 
		    'pad_counts' => false
		);

		$categories = get_categories($defaults);

		foreach ($categories as $category) {
			$option .= '<option value="'.get_option('home').'/category/'.$category->slug.'">';
			$option .= $category->cat_name;
			$option .= ' ('.$category->category_count.')';
			$option .= '</option>';
		}
		echo $option;
		?>
	</select>
		</div>
	</div>
</div>
