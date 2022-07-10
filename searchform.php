<?php
/**
 * WordPress template file
 *
 * @package ftek\theme
 */

namespace Ftek\Theme;

?>

<form class="flex" role="search" method="get" action="/">
	<input class="w-full min-w-0" type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	<button class="p-2 no-btn" type="submit" onclick="let s = this.previousElementSibling; if (!s.value) { s.focus(); event.preventDefault(); }">
		<div class="scale-150 rotate-45">⚲</div>
	</button>
</form>
