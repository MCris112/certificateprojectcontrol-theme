<?php

class cpc_addon_elementor_widget_capacitacion_description extends \Elementor\Widget_Base
{
  public function get_name()
  {
    return 'cpc_addon_elementor_widget_capacitacion_description';
  }

  public function get_title()
  {
    return 'Capacitación Descripción';
  }

  public function get_icon()
  {
    return 'eicon-code';
  }

  public function get_categories()
  {
    return ['cpc-capacitaciones'];
  }

  public function get_keywords()
  {
    return ['single', 'epaos', 'services'];
  }

  protected function register_controls()
  {
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();
    
    global $product;

    ?>

    <p><?php echo $product->get_description(); ?></p>
    
    <?php
  }
}
