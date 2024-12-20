<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Customizer block section base class.
 *
 * @package PressBook
 */

namespace PressBook\Options;

use PressBook\Options;

/**
 * Base class for block section service classes.
 */
abstract class BlockSection extends Options {
	/**
	 * Get an array of pattern-blocks formatted as [ ID => Title ].
	 *
	 * @return array
	 */
	public function pattern_blocks_choices() {
		$pattern_blocks = get_posts(
			array(
				'post_type'   => 'wp_block',
				'numberposts' => 100,
			)
		);

		$pattern_blocks_choices = array( 0 => esc_html__( 'Select a block', 'pressbook' ) );
		foreach ( $pattern_blocks as $block ) {
			$pattern_blocks_choices[ $block->ID ] = $block->post_title;
		}

		return $pattern_blocks_choices;
	}

	/**
	 * Block description.
	 *
	 * @return string
	 */
	public function block_description() {
		return wp_kses(
			sprintf(
				/* translators: %s: URL to the pattern-blocks admin page. */
				__( 'This is the content of the block section. You can create or edit the block section in the <a href="%s" target="_blank">Pattern Blocks Manager (opens in a new window)</a>.<br>After creating the pattern block, you may need to refresh this customizer page and then select the newly created block.<br>The selected block content will appear on the block section.', 'pressbook' ),
				esc_url( admin_url( 'edit.php?post_type=wp_block' ) )
			),
			array(
				'a'  => array(
					'href'   => array(),
					'target' => array(),
				),
				'br' => array(),
			)
		);
	}
}
