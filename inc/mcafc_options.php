<?php

// Settings Page: MC AUDIO FILE CALCULATOR

	class mcafc_calculatorSettings_Page {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'mc6397afc_create_settings' ) );
		add_action( 'admin_init', array( $this, 'mc6397afc_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'mc6397afc_setup_fields' ) );
	}

	public function mc6397afc_create_settings() {
		$page_title = 'MC Audio File Calculator';
		$menu_title = 'MC Audio File Calculator';
		$capability = 'manage_options';
		$slug = 'mc6397afc';
		$callback = array($this, 'mc6397afc_settings_content');
		add_options_page($page_title, $menu_title, $capability, $slug, $callback);
	}

	public function mc6397afc_settings_content() { ?>
		<div class="wrap">
		 <img src="<?php echo plugin_dir_url( __DIR__ ) . 'assets/MC-AFC-Head.jpg'; ?>">
			<h1>MC Audio File Calculator Appearance Settings</h1>
			<h3>Set the text size and button color as most appropriate for your website.<br>
			To add calculators to your website, use the shortcodes: [mcafc-mp3] and [mcafc-wav].</h3>

			<?php settings_errors(); ?>

			<form method="POST" action="options.php">
				<?php
					settings_fields( 'mc6397afc' );
					do_settings_sections( 'mc6397afc' );
					submit_button();
				?>

			</form>

		</div> <?php
	}

	public function mc6397afc_setup_sections() {
		add_settings_section( 'mcafc_calculatorsection', '', array(), 'mc6397afc' );
	}

	public function mc6397afc_setup_fields() {
		$fields = array(
			array(
				'label' => 'Show title and description above the MP3 Calculator?',
				'id' => 'mc6397afc_MP3',
				'type' => 'select',
				'section' => 'mcafc_calculatorsection',
				'options' => array(
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'desc' => 'If you change to "No" you can add your own header on your page.',
				'placeholder' => 'Yes',
			),

			array(
				'label' => 'Show title and description above the WAV Calculator?',
				'id' => 'mc6397afc_WAV',
				'type' => 'select',
				'section' => 'mcafc_calculatorsection',
				'options' => array(
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'desc' => 'If you change to "No" you can add your own header on your page.',
				'placeholder' => 'Yes',
			),

			array(
				'label' => 'Choose the size of the text on the calculators.',
				'id' => 'mc6397afc_tSize',
				'type' => 'select',
				'section' => 'mcafc_calculatorsection',
				'options' => array(
					'20' => '20px',
					'19' => '19px',
					'18' => '18px',
					'17' => '17px',
					'16' => '16px',
					'15' => '15px',
					'14' => '14px',
					'13' => '13px',
					'12' => '12px',
				),
				'desc' => 'This will change the size of header and text.',
				'placeholder' => '16px',
			),

			array(
				'label' => 'Choose the color of the calculator button:',
				'id' => 'mc6397afc_btn',
				'type' => 'select',
				'section' => 'mcafc_calculatorsection',
				'options' => array(
					'-primary' => 'Blue',
					'-secondary' => 'Gray',
					'-success' => 'Green',
					'-danger' => 'Red',
					'-warning' => 'Yellow',
					'-info' => 'Teal',
					'-light' => 'White',
					'-dark' => 'Black',
				),
				'desc' => 'Choose the color that looks best on your website.',
				'placeholder' => 'Blue',
			),

		);

		foreach( $fields as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'mc6397afc_field_callback' ), 'mc6397afc', $field['section'], $field );
			register_setting( 'mc6397afc', $field['id'] );
		}
	}

	public function mc6397afc_field_callback( $field ) {
		$value = get_option( $field['id'] );
		$placeholder = '';
		if ( isset($field['placeholder']) ) {
			$placeholder = $field['placeholder'];
		}

		switch ( $field['type'] ) {
				case 'select':
				case 'multiselect':
					if( ! empty ( $field['options'] ) && is_array( $field['options'] ) ) {
						$attr = '';
						$options = '';
						foreach( $field['options'] as $key => $label ) {
							$options.= sprintf('<option value="%s" %s>%s</option>',
								$key,
								selected($value, $key, false),
								$label
							);
						}

						if( $field['type'] === 'multiselect' ){
							$attr = ' multiple="multiple" ';
						}

						printf( '<select name="%1$s" id="%1$s" %2$s>%3$s</select>',
							$field['id'],
							$attr,
							$options
						);
					}

					break;

			default:
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
					$field['id'],
					$field['type'],
					$placeholder,
					$value
				);
		}

		if( isset($field['desc']) ) {
			if( $desc = $field['desc'] ) {
				printf( '<p class="description">%s </p>', $desc );
			}
		}
	}
}

	new mcafc_calculatorSettings_Page();
