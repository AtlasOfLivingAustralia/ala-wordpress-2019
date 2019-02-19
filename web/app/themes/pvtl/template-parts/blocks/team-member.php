<?php
namespace App\Themes\Pvtl\Blocks;

use App\Themes\Pvtl\Library\RegisterBlocks;

class TeamMember extends RegisterBlocks
{
    protected $title = 'Team Member';
    protected $icon = 'businessman'; // https://developer.wordpress.org/resource/dashicons/

    public function render($block = [], $content = '', $is_preview = false)
    {

		$photo = get_field('photo'); // array
		$name = get_field('name'); // str
		$position = get_field('position'); // str

	 ?>

		<div class="team-member">
			<img src="<?= $photo['sizes']['team'] ?>" alt="<?= $name; ?>" />
			<h5 class="name"><?= $name; ?></h5>
			<?= (!empty($position)) ? '<p class="position">' . $position . '</p>' : '' ?>
		</div>

    <?php
    }
}
