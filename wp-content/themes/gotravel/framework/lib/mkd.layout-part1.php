<?php

/*
   Interface: iGoTravelMikadoLayoutNode
   A interface that implements Layout Node methods
*/

interface iGoTravelMikadoLayoutNode {
	public function hasChidren();

	public function getChild($key);

	public function addChild($key, $value);
}

/*
   Interface: iGoTravelMikadoRender
   A interface that implements Render methods
*/

interface iGoTravelMikadoRender {
	public function render($factory);
}

/*
   Class: GoTravelMikadoPanel
   A class that initializes Mikado Panel
*/
class GoTravelMikadoPanel implements iGoTravelMikadoLayoutNode, iGoTravelMikadoRender {

	public $children;
	public $title;
	public $name;
	public $hidden_property;
	public $hidden_value;
	public $hidden_values;

	function __construct($title = "", $name = "", $hidden_property = "", $hidden_value = "", $hidden_values = array()) {
		$this->children        = array();
		$this->title           = $title;
		$this->name            = $name;
		$this->hidden_property = $hidden_property;
		$this->hidden_value    = $hidden_value;
		$this->hidden_values   = $hidden_values;
	}

	public function hasChidren() {
		return (count($this->children) > 0) ? true : false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		$hidden = false;
		if(!empty($this->hidden_property)) {
			if(gotravel_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
				$hidden = true;
			} else {
				foreach($this->hidden_values as $value) {
					if(gotravel_mikado_option_get_value($this->hidden_property) == $value) {
						$hidden = true;
					}
				}
			}
		}
		?>
		<div class="mkdf-page-form-section-holder" id="mkdf_<?php echo esc_attr($this->name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
			<h3 class="mkdf-page-section-title"><?php echo esc_html($this->title); ?></h3>
			<?php
			foreach($this->children as $child) {
				$this->renderChild($child, $factory);
			}
			?>
		</div>
		<?php
	}

	public function renderChild(iGoTravelMikadoRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: GoTravelMikadoContainer
   A class that initializes Mikado Container
*/
class GoTravelMikadoContainer implements iGoTravelMikadoLayoutNode, iGoTravelMikadoRender {

	public $children;
	public $name;
	public $hidden_property;
	public $hidden_value;
	public $hidden_values;

	function __construct($name = "", $hidden_property = "", $hidden_value = "", $hidden_values = array()) {
		$this->children        = array();
		$this->name            = $name;
		$this->hidden_property = $hidden_property;
		$this->hidden_value    = $hidden_value;
		$this->hidden_values   = $hidden_values;
	}

	public function hasChidren() {
		return (count($this->children) > 0) ? true : false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		$hidden = false;
		if(!empty($this->hidden_property)) {
			if(gotravel_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
				$hidden = true;
			} else {
				foreach($this->hidden_values as $value) {
					if(gotravel_mikado_option_get_value($this->hidden_property) == $value) {
						$hidden = true;
					}
				}
			}
		}
		?>
		<div class="mkdf-page-form-container-holder" id="mkdf_<?php echo esc_attr($this->name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
			<?php foreach($this->children as $child) {
				$this->renderChild($child, $factory);
			} ?>
		</div>
		<?php
	}

	public function renderChild(iGoTravelMikadoRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: GoTravelMikadoContainerNoStyle
   A class that initializes Mikado Container without css classes
*/
class GoTravelMikadoContainerNoStyle implements iGoTravelMikadoLayoutNode, iGoTravelMikadoRender {

	public $children;
	public $name;
	public $hidden_property;
	public $hidden_value;
	public $hidden_values;

	function __construct($name = "", $hidden_property = "", $hidden_value = "", $hidden_values = array()) {
		$this->children        = array();
		$this->name            = $name;
		$this->hidden_property = $hidden_property;
		$this->hidden_value    = $hidden_value;
		$this->hidden_values   = $hidden_values;
	}

	public function hasChidren() {
		return (count($this->children) > 0) ? true : false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		$hidden = false;
		if(!empty($this->hidden_property)) {
			if(gotravel_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
				$hidden = true;
			} else {
				foreach($this->hidden_values as $value) {
					if(gotravel_mikado_option_get_value($this->hidden_property) == $value) {
						$hidden = true;
					}
				}
			}
		}
		?>
		<div id="mkdf_<?php echo esc_attr($this->name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
			<?php foreach($this->children as $child) {
				$this->renderChild($child, $factory);
			} ?>
		</div>
		<?php
	}

	public function renderChild(iGoTravelMikadoRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: GoTravelMikadoGroup
   A class that initializes Mikado Group
*/
class GoTravelMikadoGroup implements iGoTravelMikadoLayoutNode, iGoTravelMikadoRender {

	public $children;
	public $title;
	public $description;

	function __construct($title = "", $description = "") {
		$this->children    = array();
		$this->title       = $title;
		$this->description = $description;
	}

	public function hasChidren() {
		return (count($this->children) > 0) ? true : false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) { ?>

		<div class="mkdf-page-form-section">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($this->title); ?></h4>
				<p><?php echo esc_html($this->description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<?php foreach($this->children as $child) {
						$this->renderChild($child, $factory);
					} ?>
				</div>
			</div>
		</div>
		<?php
	}

	public function renderChild(iGoTravelMikadoRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: GoTravelMikadoNotice
   A class that initializes Mikado Notice
*/
class GoTravelMikadoNotice implements iGoTravelMikadoRender {

	public $children;
	public $title;
	public $description;
	public $notice;
	public $hidden_property;
	public $hidden_value;
	public $hidden_values;

	function __construct($title = "", $description = "", $notice = "", $hidden_property = "", $hidden_value = "", $hidden_values = array()) {
		$this->children        = array();
		$this->title           = $title;
		$this->description     = $description;
		$this->notice          = $notice;
		$this->hidden_property = $hidden_property;
		$this->hidden_value    = $hidden_value;
		$this->hidden_values   = $hidden_values;
	}

	public function render($factory) {
		$hidden = false;
		if(!empty($this->hidden_property)) {
			if(gotravel_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
				$hidden = true;
			} else {
				foreach($this->hidden_values as $value) {
					if(gotravel_mikado_option_get_value($this->hidden_property) == $value) {
						$hidden = true;
					}
				}
			}
		}
		?>
		<div class="mkdf-page-form-section"<?php if($hidden) { ?> style="display: none"<?php } ?>>
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($this->title); ?></h4>
				<p><?php echo esc_html($this->description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="alert alert-warning">
						<?php echo esc_html($this->notice); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

/*
   Class: GoTravelMikadoRow
   A class that initializes Mikado Row
*/
class GoTravelMikadoRow implements iGoTravelMikadoLayoutNode, iGoTravelMikadoRender {

	public $children;
	public $next;

	function __construct($next = false) {
		$this->children = array();
		$this->next     = $next;
	}

	public function hasChidren() {
		return (count($this->children) > 0) ? true : false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) { ?>
		<div class="row<?php if($this->next) {
			echo " next-row";
		} ?>">
			<?php foreach($this->children as $child) {
				$this->renderChild($child, $factory);
			} ?>
		</div>
		<?php
	}

	public function renderChild(iGoTravelMikadoRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: GoTravelMikadoTitle
   A class that initializes Mikado Title
*/
class GoTravelMikadoTitle implements iGoTravelMikadoRender {
	private $name;
	private $title;
	public $hidden_property;
	public $hidden_values = array();

	function __construct($name = "", $title = "", $hidden_property = "", $hidden_value = "") {
		$this->title           = $title;
		$this->name            = $name;
		$this->hidden_property = $hidden_property;
		$this->hidden_value    = $hidden_value;
	}

	public function render($factory) {
		$hidden = false;
		if(!empty($this->hidden_property)) {
			if(gotravel_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
				$hidden = true;
			}
		}
		?>
		<h5 class="mkdf-page-section-subtitle" id="mkdf_<?php echo esc_attr($this->name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>><?php echo esc_html($this->title); ?></h5>
		<?php
	}
}

/*
   Class: GoTravelMikadoField
   A class that initializes Mikado Field
*/

class GoTravelMikadoField implements iGoTravelMikadoRender {
	private $type;
	private $name;
	private $default_value;
	private $label;
	private $description;
	private $options = array();
	private $args = array();
	public $hidden_property;
	public $hidden_values = array();

	function __construct($type, $name, $default_value = "", $label = "", $description = "", $options = array(), $args = array(), $hidden_property = "", $hidden_values = array()) {
		global $gotravel_mikado_Framework;
		$this->type            = $type;
		$this->name            = $name;
		$this->default_value   = $default_value;
		$this->label           = $label;
		$this->description     = $description;
		$this->options         = $options;
		$this->args            = $args;
		$this->hidden_property = $hidden_property;
		$this->hidden_values   = $hidden_values;
		$gotravel_mikado_Framework->mkdOptions->addOption($this->name, $this->default_value, $type);
	}

	public function render($factory) {
		$hidden = false;
		if(!empty($this->hidden_property)) {
			foreach($this->hidden_values as $value) {
				if(gotravel_mikado_option_get_value($this->hidden_property) == $value) {
					$hidden = true;
				}
			}
		}
		$factory->render($this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $hidden);
	}
}

/*
   Class: GoTravelMikadoMetaField
   A class that initializes Mikado Meta Field
*/
class GoTravelMikadoMetaField implements iGoTravelMikadoRender {
	private $type;
	private $name;
	private $default_value;
	private $label;
	private $description;
	private $options = array();
	private $args = array();
	public $hidden_property;
	public $hidden_values = array();
	
	function __construct($type, $name, $default_value = "", $label = "", $description = "", $options = array(), $args = array(), $hidden_property = "", $hidden_values = array()) {
		global $gotravel_mikado_Framework;
		$this->type            = $type;
		$this->name            = $name;
		$this->default_value   = $default_value;
		$this->label           = $label;
		$this->description     = $description;
		$this->options         = $options;
		$this->args            = $args;
		$this->hidden_property = $hidden_property;
		$this->hidden_values   = $hidden_values;
		$gotravel_mikado_Framework->mkdMetaBoxes->addOption($this->name, $this->default_value);
	}

	public function render($factory) {
		$hidden = false;
		if(!empty($this->hidden_property)) {
			foreach($this->hidden_values as $value) {
				if(gotravel_mikado_option_get_value($this->hidden_property) == $value) {
					$hidden = true;
				}
			}
		}
		$factory->render($this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $hidden);
	}
}

abstract class GoTravelMikadoFieldType {
	abstract public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false);
}

class GoTravelMikadoFieldText extends GoTravelMikadoFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		$col_width = 12;
		if (isset($args["col_width"])) {
			$col_width = $args["col_width"];
		}

		$suffix = !empty($args['suffix']) ? $args['suffix'] : false;

		$class = '';

		if (!empty($repeat)) {
			$id = $name . '-' . $repeat['index'];
			$name .= '[]';
			$value = $repeat['value'];
			$class = 'mkdf-repeater-field';
		} else {
			$id = $name;
			$value = gotravel_mikado_option_get_value($name);
		}
		?>

		<div class="mkdf-page-form-section <?php echo esc_attr($class); ?>" id="mkdf_<?php echo esc_attr($id); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-<?php echo esc_attr($col_width); ?>">
                            <?php if($suffix) : ?>
                            <div class="input-group">
                            <?php endif; ?>
                                <input type="text"
                                    class="form-control mkdf-input mkdf-form-element"
                                    name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(htmlspecialchars($value)); ?>"
                                    placeholder=""/>
                                <?php if($suffix) : ?>
                                    <div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
                                <?php endif; ?>
                            <?php if($suffix) : ?>
                            </div>
                            <?php endif; ?>
                        </div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class GoTravelMikadoFieldTextSimple extends GoTravelMikadoFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		$suffix = !empty($args['suffix']) ? $args['suffix'] : false;
		$class = '';

		if (!empty($repeat)) {
			$id = str_replace(array('[',']'),'',$name) . '-' .rand();
			$name .= '[]';
			$value = $repeat['value'];
			$class = 'mkdf-repeater-field';
		} else {
			$id = $name;
			$value = gotravel_mikado_option_get_value($name);
		}
		?>
		
		<div class="col-lg-3 <?php echo esc_attr($class); ?>" id="mkdf_<?php echo esc_attr($id); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
			<?php if($suffix) : ?>
			<div class="input-group">
            <?php endif; ?>
				<input type="text"
				   class="form-control mkdf-input mkdf-form-element"
				   name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(htmlspecialchars($value)); ?>"
				   placeholder=""/>
				<?php if($suffix) : ?>
					<div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
				<?php endif; ?>
			<?php if($suffix) : ?>
			</div>
			<?php endif; ?>
		</div>
	<?php
	}
}

class GoTravelMikadoFieldTextArea extends GoTravelMikadoFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		$class = '';

		if (!empty($repeat)) {
			$name .= '[]';
			$value = $repeat['value'];
			$class = 'mkdf-repeater-field';
		} else {
			$value = gotravel_mikado_option_get_value($name);
		}
		?>

		<div class="mkdf-page-form-section">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 <?php echo esc_attr($class); ?>">
							<textarea class="form-control mkdf-form-element" name="<?php echo esc_attr($name); ?>" rows="5"><?php echo esc_html(htmlspecialchars($value)); ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class GoTravelMikadoFieldTextAreaSimple extends GoTravelMikadoFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		$class = '';

		if (!empty($repeat)) {
			$name .= '[]';
			$value = $repeat['value'];
			$class = 'mkdf-repeater-field';
		} else {
			$value = gotravel_mikado_option_get_value($name);
		}
		?>
		<div class="col-lg-3 <?php echo esc_attr($class); ?>">
			<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
			<textarea class="form-control mkdf-form-element" name="<?php echo esc_attr($name); ?>" rows="5"><?php echo esc_html($value); ?></textarea>
		</div>
	<?php
	}
}

class GoTravelMikadoFieldColor extends GoTravelMikadoFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		$class = '';

		if (!empty($repeat)) {
			$id = $name . '-' . $repeat['index'];
			$name .= '[]';
			$value = $repeat['value'];
			$class = 'mkdf-repeater-field';
		} else {
			$id = $name;
			$value = gotravel_mikado_option_get_value($name);
		}
		?>

		<div class="mkdf-page-form-section <?php echo esc_attr($class); ?>" id="mkdf_<?php echo esc_attr($id); ?>">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<input type="text" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>" class="my-color-field"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class GoTravelMikadoFieldColorSimple extends GoTravelMikadoFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		$class = '';

		if (!empty($repeat)) {
			$id = $name . '-' . $repeat['index'];
			$name .= '[]';
			$value = $repeat['value'];
			$class = 'mkdf-repeater-field';
		} else {
			$id = $name;
			$value = gotravel_mikado_option_get_value($name);
		}
		?>
		<div class="col-lg-3 <?php echo esc_attr($class); ?>" id="mkdf_<?php echo esc_attr($id); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
			<input type="text" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>" class="my-color-field"/>
		</div>
	<?php
	}
}

class GoTravelMikadoFieldImage extends GoTravelMikadoFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		$class = '';

		if (!empty($repeat)) {
			$name .= '[]';
			$value = $repeat['value'];
			$class = 'mkdf-repeater-field';
			$has_value = empty($value)?false:true;
		} else {
			$value = gotravel_mikado_option_get_value($name);
			$has_value = gotravel_mikado_option_has_value($name);
		}
		?>
		<div class="mkdf-page-form-section">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 <?php echo esc_attr($class); ?>">
							<div class="mkdf-media-uploader">
								<div<?php if (!$has_value) { ?> style="display: none"<?php } ?> class="mkdf-media-image-holder">
									<img src="<?php if ($has_value) { echo esc_url(gotravel_mikado_get_attachment_thumb_url($value)); } ?>" alt="" class="mkdf-media-image img-thumbnail"/>
								</div>
								<div style="display: none" class="mkdf-media-meta-fields">
									<input type="hidden" class="mkdf-media-upload-url" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>"/>
								</div>
								<a class="mkdf-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e('Select Image', 'gotravel'); ?>" data-frame-button-text="<?php esc_html_e('Select Image', 'gotravel'); ?>"><?php esc_html_e('Upload', 'gotravel'); ?></a>
								<a style="display: none;" href="javascript: void(0)" class="mkdf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'gotravel'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class GoTravelMikadoFieldImageSimple extends GoTravelMikadoFieldType {

    public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
	    $class = '';

	    if (!empty($repeat)) {
		    $id = $name . '-' . $repeat['index'];
		    $name .= '[]';
		    $value = $repeat['value'];
		    $class = 'mkdf-repeater-field';
		    $has_value = empty($value)?false:true;
	    } else {
		    $id = $name;
		    $value = gotravel_mikado_option_get_value($name);
		    $has_value = gotravel_mikado_option_has_value($name);
	    }
        ?>

        <div class="col-lg-3 <?php echo esc_attr($class); ?>" id="mkdf_<?php echo esc_attr($id); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
            <em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
            <div class="mkdf-media-uploader">
                <div<?php if (!$has_value) { ?> style="display: none"<?php } ?> class="mkdf-media-image-holder">
                    <img src="<?php if ($has_value) { echo esc_url(gotravel_mikado_get_attachment_thumb_url($value)); } ?>" alt="" class="mkdf-media-image img-thumbnail"/>
                </div>
                <div style="display: none" class="mkdf-media-meta-fields">
                    <input type="hidden" class="mkdf-media-upload-url" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>"/>
                </div>
                <a class="mkdf-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e('Select Image', 'gotravel'); ?>" data-frame-button-text="<?php esc_html_e('Select Image', 'gotravel'); ?>"><?php esc_html_e('Upload', 'gotravel'); ?></a>
                <a style="display: none;" href="javascript: void(0)" class="mkdf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'gotravel'); ?></a>
            </div>
        </div>
    <?php
    }
}

class GoTravelMikadoFieldFont extends GoTravelMikadoFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		global $gotravel_mikado_fonts_array;

		$class = '';

		if (!empty($repeat)) {
			$name .= '[]';
			$value = $repeat['value'];
			$class = 'mkdf-repeater-field';
		} else {
			$value = gotravel_mikado_option_get_value($name);
		}
		?>

		<div class="mkdf-page-form-section">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3 <?php echo esc_attr($class); ?>">
							<select class="form-control mkdf-form-element" name="<?php echo esc_attr($name); ?>">
								<option value="-1">Default</option>
								<?php foreach($gotravel_mikado_fonts_array as $fontArray) { ?>
									<option <?php if ($value == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr(str_replace(' ', '+', $fontArray["family"])); ?>"><?php echo esc_html($fontArray["family"]); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class GoTravelMikadoFieldFontSimple extends GoTravelMikadoFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		global $gotravel_mikado_fonts_array;

		$class = '';

		if (!empty($repeat)) {
			$name .= '[]';
			$value = $repeat['value'];
			$class = 'mkdf-repeater-field';
		} else {
			$value = gotravel_mikado_option_get_value($name);
		}
		?>
		<div class="col-lg-3 <?php echo esc_attr($class); ?>">
			<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
			<select class="form-control mkdf-form-element" name="<?php echo esc_attr($name); ?>">
				<option value="-1">Default</option>
				<?php foreach($gotravel_mikado_fonts_array as $fontArray) { ?>
					<option <?php if ($value == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr(str_replace(' ', '+', $fontArray["family"])); ?>"><?php echo esc_html($fontArray["family"]); ?></option>
				<?php } ?>
			</select>
		</div>
	<?php
	}
}

class GoTravelMikadoFieldSelect extends GoTravelMikadoFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		$class = '';

		if (!empty($repeat)) {
			$id = $name . '-' . $repeat['index'];
			$name .= '[]';
			$rvalue = $repeat['value'];
			$class = 'mkdf-repeater-field';
		} else {
			$id = $name;
			$rvalue = gotravel_mikado_option_get_value($name);
		}

		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$show = array();
		if(isset($args["show"]))
			$show = $args["show"];
		$hide = array();
		if(isset($args["hide"]))
			$hide = $args["hide"];
		?>
		<div class="mkdf-page-form-section <?php echo esc_attr($class); ?>" id="mkdf_<?php echo esc_attr($id); ?>" <?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3">
							<select class="form-control mkdf-form-element<?php if ($dependence) { echo " dependence"; } ?>"
								<?php foreach($show as $key=>$value) { ?>
									data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
								<?php } ?>
								<?php foreach($hide as $key=>$value) { ?>
									data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
								<?php } ?>
									name="<?php echo esc_attr($name); ?>">
								<?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
									<option <?php if ($rvalue == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class GoTravelMikadoFieldSelectBlank extends GoTravelMikadoFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		$class = '';

		if (!empty($repeat)) {
			$name .= '[]';
			$rvalue = $repeat['value'];
			$class = 'mkdf-repeater-field';
		} else {
			$rvalue = gotravel_mikado_option_get_value($name);
		}

		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$show = array();
		if(isset($args["show"]))
			$show = $args["show"];
		$hide = array();
		if(isset($args["hide"]))
			$hide = $args["hide"];
		?>

		<div class="mkdf-page-form-section"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content <?php echo esc_attr($class); ?>">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3">
							<select class="form-control mkdf-form-element<?php if ($dependence) { echo " dependence"; } ?>"
								<?php foreach($show as $key=>$value) { ?>
									data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
								<?php } ?>
								<?php foreach($hide as $key=>$value) { ?>
									data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
								<?php } ?>
									name="<?php echo esc_attr($name); ?>">
								<option <?php if ($rvalue == "") { echo "selected='selected'"; } ?>  value=""></option>
								<?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
									<option <?php if ($rvalue == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class GoTravelMikadoFieldSelectSimple extends GoTravelMikadoFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		$class = '';
		if (!empty($repeat)) {
			$name .= '[]';
			$rvalue = $repeat['value'];
			$class = 'mkdf-repeater-field';
		} else {
			$rvalue = gotravel_mikado_option_get_value($name);
		}

        $dependence = false;
        if(isset($args["dependence"]))
            $dependence = true;
        $show = array();
        if(isset($args["show"]))
            $show = $args["show"];
        $hide = array();
        if(isset($args["hide"]))
            $hide = $args["hide"];
        ?>
		<div class="col-lg-3 <?php echo esc_attr($class); ?>" id="mkdf_<?php echo esc_attr($name); ?>" <?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control mkdf-form-element<?php if ($dependence) { echo " dependence"; } ?>"
                <?php foreach($show as $key=>$value) { ?>
                    data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                <?php foreach($hide as $key=>$value) { ?>
                    data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                    name="<?php echo esc_attr($name); ?>">
                <option <?php if ($rvalue == "") { echo "selected='selected'"; } ?>  value=""></option>
                <?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
                    <option <?php if ($rvalue == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
		</div>
	<?php
	}
}

class GoTravelMikadoFieldSelectBlankSimple extends GoTravelMikadoFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		$class = '';
		if (!empty($repeat)) {
			$name .= '[]';
			$rvalue = $repeat['value'];
			$class = 'mkdf-repeater-field';
		} else {
			$rvalue = gotravel_mikado_option_get_value($name);
		}

        $dependence = false;
        if(isset($args["dependence"]))
            $dependence = true;
        $show = array();
        if(isset($args["show"]))
            $show = $args["show"];
        $hide = array();
        if(isset($args["hide"]))
            $hide = $args["hide"];
        ?>
		<div class="col-lg-3 <?php echo esc_attr($class); ?>">
			<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control mkdf-form-element<?php if ($dependence) { echo " dependence"; } ?>"
                <?php foreach($show as $key=>$value) { ?>
                    data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                <?php foreach($hide as $key=>$value) { ?>
                    data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                    name="<?php echo esc_attr($name); ?>">
                <option <?php if ($rvalue == "") { echo "selected='selected'"; } ?>  value=""></option>
                <?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
                    <option <?php if ($rvalue == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
		</div>
	<?php
	}
}