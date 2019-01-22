<div class="category-selector">
	<label for="categorySelect" class="sr-only">Filter by Category</label>
	<select id="categorySelect" name="category-select" class="custom-select custom-select-lg" id="" onchange='document.location.href=this.options[this.selectedIndex].value;'>
		<option value=""><?php echo esc_attr(__('Filter by Category')); ?></option>

		<?php
		$option = '<option value="' . get_permalink(get_option('page_for_posts')) .'">All Categories</option>'; // change category to your custom page slug
		$categories = get_categories();
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
