<?php

use Roots\view;

$layout = get_row_layout();
switch ( $layout ) {
	case 'title_block':
			$content = [
				'narrow_class' => get_sub_field( 'narrow_vertical_spacing' ),
				'artist' => get_sub_field( 'artist' ),
				'title' => get_sub_field( 'title' ),
			];
			echo view( __DIR__ . '/../resources/views/components/title-block.blade.php', $content );
		break;

	case 'full_width_image_block':
			$content = [
				'narrow_class'     => get_sub_field( 'narrow_vertical_spacing' ),
				'full_width_image' => wp_get_attachment_image( get_sub_field( 'image' ), 'viewing-room-full-nh', false, array( 'class' => 'img-fw img-fluid' ) ),
			];
			error_log( print_r( $content, true ) );
			echo view( __DIR__ . '/../resources/views/components/full-width-image.blade.php', $content );
		break;

	case 'two_column_block':
			$content = [
				'image_column'          => wp_get_attachment_image(get_sub_field('image'), 'viewing-room', false, ['class' => 'img-fluid']),
				'image_column_caption'  => get_sub_field('image_caption'),
				'placement'             => get_sub_field('image_placement'),
				'reverse_placement'     => (get_sub_field('image_placement')) ? 0 : 1,
				'narrow_class'          => get_sub_field('narrow_vertical_spacing'),
				'body_column'           => get_sub_field('text_body'),
			];
			echo view(__DIR__ . '/../resources/views/components/two-column.blade.php', $content);
			break;

	case 'image_block':
			$content = [
				'single_image'         => wp_get_attachment_image(get_sub_field('image'), 'viewing-room-large', false, ['class' => 'img-fluid']),
				'image_caption' => get_sub_field('image_caption'),
				'narrow_class'  => get_sub_field('narrow_vertical_spacing'),
			];
			echo view(__DIR__ . '/../resources/views/components/single-image.blade.php', $content);
		break;

	case 'parent_page_block':
			$child_post = get_sub_field('child_page')[0];
			$child_title = !empty(get_sub_field('title')) ? get_sub_field('title') : get_the_title($child_post);
			$content = [
				'child_page_title'  => $child_title,
				'introduction_text' => get_sub_field('introduction_text'),
				'child_page_link'   => get_permalink($child_post),
				'image'             => wp_get_attachment_image(get_sub_field('image'), 'viewing-room-large', false, ['class' => 'img-fluid']),
				'image_caption'     => get_sub_field('image_caption'),
				'narrow_class'      => get_sub_field('narrow_vertical_spacing'),
			];
			echo view(__DIR__ . '/../resources/views/components/parent-page.blade.php', $content);
			break;

	case 'two_column_image_block':
			$content = [
				'image_column_one'  => wp_get_attachment_image(get_sub_field('image_one'), 'viewing-room', false, ['class' => 'img-fluid'] ),
				'image_column_two'  => wp_get_attachment_image(get_sub_field('image_two'), 'viewing-room', false, ['class' => 'img-fluid'] ),
				'image_one_caption' => get_sub_field('image_one_caption'),
				'image_two_caption' => get_sub_field('image_two_caption'),
				'narrow_class'  => get_sub_field('narrow_vertical_spacing'),
			];
			echo view(__DIR__ . '/../resources/views/components/two-column-image.blade.php', $content);
		break;

	case 'slideshow_block':
			$content = [
				'images'         => get_sub_field('images'),
				'slideshow_size' => 'slide-show',
				'slideshow_image_class' => ['class' => 'd-block img-fluid'],
				'narrow_class'  => get_sub_field('narrow_vertical_spacing'),
			];
			echo view(__DIR__ . '/../resources/views/components/slide-show.blade.php', $content);
		break;

	case 'gallery_block':
			$gallery_images = ( get_sub_field( 'gallery_images' ) ) ? array_map(
				function( $image ) {
					return array(
						'href'           => ( 'video' == $image['type'] ) ? $image['url'] : $image['sizes']['large'],
						'gallery_string' => htmlentities( str_replace( PHP_EOL, ' ', $image['title'] . ' ' . $image['description'] ), ENT_QUOTES ),
						'src'            => $image['sizes']['large'],
						'title'          => $image['title'],
						'description'    => $image['description'],
					);
				},
				get_sub_field( 'gallery_images' )
			) : array();

			$content = [
				'gallery_images' => $gallery_images,
				'narrow_class'   => get_sub_field( 'narrow_vertical_spacing' ),
			];
			echo view( __DIR__ . '/../resources/views/components/gallery.blade.php', $content );
		break;
		
	case 'embed_media_block':
			$content = [
				'media'         => get_sub_field('media'),
				'media_caption' => get_sub_field('media_caption'),
				'narrow_class'  => get_sub_field('narrow_vertical_spacing'),
			];
			echo view(__DIR__ . '/../resources/views/components/media.blade.php', $content);
			break;
		
	case 'quote_block':
			$content = [
				'narrow_class' => get_sub_field('narrow_vertical_spacing'),
				'quote'         => get_sub_field('quote'),
			];
			echo view(__DIR__ . '/../resources/views/components/quote.blade.php', $content);
			break;
		
	case 'text_block':
			$content = [
				'narrow_class' => get_sub_field('narrow_vertical_spacing'),
				'body'         => get_sub_field('text_body'),
			];
			echo view(__DIR__ . '/../resources/views/components/text.blade.php', $content);
			break;

	case 'wide_text_block':
			$content = [
				'narrow_class' => get_sub_field('narrow_vertical_spacing'),
				'body'         => get_sub_field('text_body'),
			];
			echo view(__DIR__ . '/../resources/views/components/text-wide.blade.php', $content);
			break;
		
	default:
			break;
}
