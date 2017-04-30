<?php

add_action( 'widgets_init', 'vaso_cita_widget_init' );
function vaso_cita_widget_init() {
	register_widget( 'vaso_cita_widget' );
}


class Vaso_Cita_Widget extends WP_Widget {

	protected $meta_field = '_post_view_count';

	// widget constructor
	public function __construct()
	{
		$widget_details = array(
			'classname'   => 'vaso_cita_widget',
			'description' => __( 'Najčítanejšie články', 'vaso-cita' ),
		);

		parent::__construct(
			'vaso_cita_widget',
			__( 'Vašo číta', 'vaso-cita' ),
			$widget_details
		);
	}


	// outputs the content of the widget
	public function widget( $args, $instance )
	{
		$title  = apply_filters( 'widget_title', $instance['title'] );
		$number = $instance['number'];

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$posts = get_posts(array(
			'post_per_page' => $number,
			'meta_key' => '_post_view_count',
			'orderby'  => 'meta_value_num',
			'order'    => 'DESC',
		));

		if ( $posts )
		{
			echo '<ul>';
			foreach ( $posts as $post )
			{
				echo '<li>';
				echo '  <a href="'. esc_url( get_permalink( $post ) ) .'">';
				echo        apply_filters( 'the_title', $post->post_title );
				echo '		<small>( '. get_post_meta( $post->ID, $this->meta_field, true ) .' )</small>';
				echo '  </a>';
				echo '  <small>';
				echo        wp_trim_words( apply_filters('the_excerpt', $post->post_content), 4 );
				echo '  </small>';
				echo '</li>';
			}
			echo '</ul>';
		}

		echo $args['after_widget'];
	}


	// creates the back-end form
	public function form( $instance )
	{
		$title  = isset( $instance['title'] )  ? $instance['title']  : '';
		$number = isset( $instance['number'] ) ? $instance['number'] : 3;

	?>

		<p>
			<label for="<?php echo $this->get_field_name('title') ?>">
				<?php _e( 'Nadpis', 'vaso-cita' ) ?>:
			</label>
			<input type="text" class="widefat" value="<?php echo esc_attr( $title ) ?>"
				   id="<?php echo $this->get_field_id('title') ?>"
				   name="<?php echo $this->get_field_name('title') ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_name('number') ?>">
				<?php _e( 'Koľko článkov zobraziť', 'vaso-cita' ) ?>:
			</label>
			<input type="number" class="tiny-text" step="1" min="1" size="3"
			       value="<?php echo esc_attr( $number ); ?>"
			       id="<?php echo $this->get_field_id( 'number' ); ?>"
			       name="<?php echo $this->get_field_name( 'number' ); ?>">
		</p>

	<?php
	}


	// updating widget replacing old instances with new
	public function update( $new_instance, $old_instance )
	{
		$new_instance['title']  = strip_tags( $new_instance['title'] );
		$new_instance['number'] = intval( $new_instance['number'] );

		return $new_instance;
	}

}