<?php

class cpc_addon_elementor_widget_capacitacion_info_3 extends \Elementor\Widget_Base
{
  public function get_name()
  {
    return 'cpc_addon_elementor_widget_capacitacion_info_3';
  }

  public function get_title()
  {
    return 'Modulo información 3';
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

    <div class="cpc_capacitacion_widget_info_3">
      <div class="cpc_capacitacion_widget_info_3_item">
        <div class="icon"><i class="fa fa-laptop"></i></div>
        <div class="text">
          <p class="title">Modalidad</p>
          <div class="information">Sincrónica</div>
        </div>
      </div>
      <div class="cpc_capacitacion_widget_info_3_item">
        <div class="icon"><i class="fa fa-calendar-o"></i></div>
        <div class="text">
          <p class="title">Inicio de Clases</p>
          <div class="information">15 de marzo</div>
        </div>
      </div>
      <div class="cpc_capacitacion_widget_info_3_item">
        <div class="icon"><i class="fa fa-clock-o"></i></div>
        <div class="text">
          <p class="title">Duración</p>
          <div class="information">12 horas</div>
        </div>
      </div>
    </div>
    
    <?php
  }
}
