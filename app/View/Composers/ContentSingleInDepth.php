<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ContentSingleInDepth extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'partials.content-single-in-depth',
		'single-in-depth',
	];

	public function override()
	{
		$content = $this->flexibleContent();

		return [
			'parent_attributes' => $this->parentAttrs(),
			'flexible_content'  => $content,
		];
	}

	function parentAttrs()
	{
		$parent_attrs = [];
		$parent_post_id = wp_get_post_parent_id( get_the_ID() );

		if ( $parent_post_id )
		{
			$parent_attrs['parent_post_id'] = $parent_post_id;
			$parent_attrs['menu_array']['Home'] = get_permalink( $parent_post_id );

			if ( have_rows( 'westex_blocks', $parent_post_id ) )
			{
				while ( have_rows( 'westex_blocks', $parent_post_id ) )
				{
					the_row();	
					if ( 'parent_page_block' == get_row_layout() )
					{
						$child_post = get_sub_field('child_page')[0];
						$title = !empty( get_sub_field( 'title' ) ) ? get_sub_field( 'title' ) : get_the_title( $child_post );
						$parent_attrs['menu_array'][ $title ] = get_permalink( $child_post );
					}
				}
				$parent_attrs['menu_title'] = get_the_title( $parent_post_id );
			}
		}

		return $parent_attrs;
	}

	function flexibleContent()
	{
		$flex_array = [];

		if ( have_rows( 'westex_blocks', get_the_ID() ) )
		{
			while ( have_rows( 'westex_blocks', get_the_ID() ) )
			{
				the_row();
				$layout = get_row_layout();

				switch ($layout) :
					case 'title_block':
						$component = [];
						$component['title'] = get_sub_field('title');
						$component['artist'] = get_sub_field('artist');
						$component['narrow_class'] = get_sub_field('narrow_vertical_spacing');
						$component['content_type'] = 'title-block';
						$flex_array['content'][] = $component;
					  break;
			  
					  case 'full_width_image_block':
						$component = [];
						$component['image'] = get_sub_field('image');
						$component['fw_image_size'] = 'viewing-room-full';
						$component['image_classes'] = ['img-fw', 'img-fluid'];
						$component['narrow_class'] = get_sub_field('narrow_vertical_spacing');
						$component['content_type'] = 'full-width-image';
						$flex_array['content'][] = $component;
					break;
			  
					case 'two_column_block':
						$component = [];
						$component['image'] = get_sub_field('image');
						$component['image_caption'] = get_sub_field('image_caption');
						$component['tc_image_size'] = 'viewing-room';
						$component['tc_classes'] = ['class' => 'img-fluid'];
						$component['placement'] = get_sub_field('image_placement');
						$component['body'] = get_sub_field('text_body');
						$component['narrow_class'] = get_sub_field('narrow_vertical_spacing');
						$component['content_type'] = 'two-column';
						$flex_array['content'][] = $component;
					break;
			  
					case 'two_column_image_block':
						$component = [];
						$component['image_one'] = get_sub_field('image_one');
						$component['image_two'] = get_sub_field('image_two');
						$component['image_one_caption'] = get_sub_field('image_one_caption');
						$component['image_two_caption'] = get_sub_field('image_two_caption');
						$component['tc_image_size'] = 'viewing-room';
						$component['tc_classes'] = ['class' => 'img-fluid'];
						$component['narrow_class'] = get_sub_field('narrow_vertical_spacing');
						$component['content_type'] = 'two-column-image';
						$flex_array['content'][] = $component;
					break;
			  
					case 'quote_block':
						$component = [];
						$component['quote'] = get_sub_field('quote');
						$component['narrow_class'] = get_sub_field('narrow_vertical_spacing');
						$component['content_type'] = 'quote';
						$flex_array['content'][] = $component;
					break;
			  
					case 'embed_media_block':
						$component = [];
						$component['media'] = get_sub_field('media');
						$component['media_caption'] = get_sub_field('media_caption');
						$component['narrow_class'] = get_sub_field('narrow_vertical_spacing');
						$component['content_type'] = 'media';
						$flex_array['content'][] = $component;
					break;
			  
					case 'slideshow_block':
						$component = [];
						$component['images'] = get_sub_field('slideshow_images');
						$component['slideshow_size'] = 'slide-show';
						$component['slideshow_image_class'] = ['class' => 'd-block img-fluid'];
						$component['narrow_class'] = get_sub_field('narrow_vertical_spacing');
						$component['content_type'] = 'slide-show';
						$flex_array['content'][] = $component;
					break;
			  
					case 'text_block':
						$component = [];
						$component['body'] = get_sub_field('text_body');
						$component['narrow_class'] = get_sub_field('narrow_vertical_spacing');
						$component['content_type'] = 'text';
						$flex_array['content'][] = $component;
					break;
			  
					case 'wide_text_block':
						$component = [];
						$component['body'] = get_sub_field('text_body');
						$component['narrow_class'] = get_sub_field('narrow_vertical_spacing');
						$component['content_type'] = 'text-wide';
						$flex_array['content'][] = $component;
					break;
			  
					case 'gallery_block':
						$component = [];
						$component['gallery_images'] = get_sub_field('gallery_images');
						$component['narrow_class'] = get_sub_field('narrow_vertical_spacing');
						$component['content_type'] = 'gallery';
						$flex_array['content'][] = $component;
					break;
			  
					case 'image_block':
						$component = [];
						$component['image'] = get_sub_field('image');
						$component['image_caption'] = get_sub_field('image_caption');
						$component['tc_image_size'] = 'viewing-room-large';
						$component['tc_classes'] = ['class' => 'img-fluid'];
						$component['narrow_class'] = get_sub_field('narrow_vertical_spacing');
						$component['content_type'] = 'single-image';
						$flex_array['content'][] = $component;
					break;
			  
					case 'parent_page_block':
						$component = [];
						$child_post = get_sub_field('child_page')[0];
						$child_title = !empty(get_sub_field('title')) ? get_sub_field('title') : get_the_title($child_post);
						$component['child_page_title'] =  $child_title;
						$component['introduction_text'] =  get_sub_field('introduction_text');
						$component['child_page_link'] =  get_permalink($child_post);
						$component['image'] =  get_sub_field('image');
						$component['image_caption'] = get_sub_field('image_caption');
						$component['tc_image_size'] = 'viewing-room-large';
						$component['tc_classes'] =  ['class' => 'img-fluid'];
						$component['narrow_class'] = get_sub_field('narrow_vertical_spacing');
						$component['content_type'] = 'parent-page';
						$flex_array['content'][] = $component;
					break;
				  endswitch;
			}
		}

		return $flex_array;
	}
}
