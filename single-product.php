<?php
get_header();

$product = wc_get_product(get_the_id());
$modalidad = cpc_get_meta_field('_cpc_capacitacion_field_modalidad');
$fechas = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_modalidad_fechas', true);
if( !empty($fechas) ) $fechas = json_decode($fechas, true);

function cpc_capacitacion_cpt_box_desc($title, $content)
{
?>

    <div class="cpc_box_desc">
        <div class="cpc_head">
            <h2><?php echo $title; ?></h2>
            <hr>
        </div>
        <div class="cpc_body">
            <p class="desc"><?php echo $content; ?></p>
        </div>
    </div>

<?php
}

?>

<section class="cpc_section cpc_near_menu_top">
    <div class="cpc_bg_section">
        <img src="<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg_product.jpg" alt="">
        <div class="cover"></div>
    </div>
    <div class="container pt-5">
        <div class="row">
            <div class="col-8">
                <h1 class="cpc_title"><?php the_title(); ?></h1>
                <p class="cpc_subtitle"><?php echo cpc_get_meta_field('_cpc_capacitacion_field_sub_title'); ?></p>
                <hr class="cpc_hr">
                <p class="short_desc"><?php echo $product->get_short_description(); ?></p>
                <div class="cpc_capacitacion_widget_info_3">
                    <div class="container content">
                        <div class="cpc_capacitacion_widget_info_3_item">
                            <div class="icon"><i class="fa fa-laptop"></i></div>
                            <div class="text">
                                <p class="title">Modalidad</p>
                                <div class="information">
                                    <?php

                                    if (empty($modalidad)) {
                                        echo "Sin definir";
                                    } else {
                                        if ($modalidad == 'sincronico') {
                                            echo 'Sincrónica';
                                        } else {
                                            echo 'Asincrónica';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="cpc_capacitacion_widget_info_3_item">
                            <?php

                            if ($modalidad == 'sincronico') {
                            ?>

                                <div class="icon"><i class="fa fa-calendar-o"></i></div>
                                <div class="text">
                                    <p class="title">Inicio de Clases</p>
                                    <div class="information">
                                        <?php

                                        if (empty($fechas)) {
                                            echo 'Sin definir';
                                        } else {
                                            global $locale;
                                            $date = date_i18n('d \d\e F', strtotime($fechas[0]));
                                            echo $date;
                                        }
                                        ?>
                                    </div>
                                </div>

                            <?php
                            }

                            ?>
                        </div>
                        <div class="cpc_capacitacion_widget_info_3_item">
                            <div class="icon"><i class="fa fa-clock-o"></i></div>
                            <div class="text">
                                <p class="title">Duración</p>
                                <div class="information">

                                    <?php

                                    $duracion = get_post_meta(get_the_ID(), '_cpc_duration', true);

                                    if (empty($duracion)) {
                                        echo 'Sin definir';
                                    } else {
                                        echo $duracion . ' horas';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 cpc_price_c">
                <p class="cpc_price">$<?php echo $product->get_price(); ?></p>
                <div class="d-flex gap-4 cpc_price_btn">
                    <div class="btn btn-outline-primary">Contáctanos</div>
                    <div class="btn btn-primary">Comprar Ahora</div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="cpc_section body" style="margin-top: 4rem;">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="cpc_section_content">
                    <div class="container">
                        <?php

                        cpc_capacitacion_cpt_box_desc('Descripción del curso', $product->get_description());

                        $has_logro = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_logro_select', true);
                        $logro_content =  htmlspecialchars_decode(get_post_meta(get_the_ID(), '_cpc_capacitacion_field_logro', true));

                        if (!empty($logro_content) && $has_logro == true) {
                            cpc_capacitacion_cpt_box_desc('Logro del curso', $logro_content);
                        }

                        $has_metodologia = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_metodologia_select', true);
                        $metodologia_content =  htmlspecialchars_decode(get_post_meta(get_the_ID(), '_cpc_capacitacion_field_metodologia', true));

                        if (!empty($metodologia_content) && $has_metodologia == true) {
                            cpc_capacitacion_cpt_box_desc('Metodología del curso', $metodologia_content);
                        }

                        $has_beneficios = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_beneficios_select', true);
                        $beneficios_content =  htmlspecialchars_decode(get_post_meta(get_the_ID(), '_cpc_capacitacion_field_beneficios', true));

                        if (!empty($beneficios_content) && $has_beneficios == true) {
                            cpc_capacitacion_cpt_box_desc('Beneficios del curso', $beneficios_content);
                        }


                        ?>

                        <?php

                        $temario_val = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_temario', true);

                        if (!empty($temario_val)) {

                            $temario = json_decode($temario_val, true);

                            if (!empty($temario) || count($temario) >= 1) {
                        ?>

                                <div class="cpc_box_desc">
                                    <div class="cpc_head">
                                        <h2>Temario</h2>
                                        <hr>
                                    </div>
                                    <div class="cpc_body">
                                        <div class="accordion accordion-flush" id="accordionCPTTemario">
                                            <?php

                                            foreach ($temario as $item => $value) {

                                                $accordion_id = $item . '_collapse';
                                            ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingOne">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $accordion_id; ?>" aria-expanded="false" aria-controls="<?php echo $accordion_id; ?>">
                                                            <?php echo $value['title']; ?>
                                                        </button>
                                                    </h2>
                                                    <div id="<?php echo $accordion_id; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'heading_' . $accordion_id; ?>" data-bs-parent="#accordionCPTTemario">
                                                        <div class="accordion-body">
                                                            <?php echo $value['content']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }

                                            ?>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        }

                        ?>


                        <!--div-- class="cpc_box_desc">
                            <div class="cpc_head">
                                <h2>Requisitos minimos</h2>
                                <hr>
                            </div>
                            <div class="cpc_body">
                                <p class="desc"><?php echo $product->get_description(); ?></p>
                            </div>
                        </!--div-->

                        <div class="cpc_box_desc">
                            <div class="cpc_head">
                                <h2>Requiero más información</h2>
                                <hr>
                            </div>
                            <div class="cpc_body">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nombre y Apellidos</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Su nombre">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Celular</label>
                                    <input type="tel" class="form-control" id="exampleFormControlInput1" placeholder="xxx xxx xxx">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">País</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="null" selected>Seleccione su País</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA">Bosnia and Herzegowina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="BN">Brunei Darussalam</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo</option>
                                        <option value="CD">Congo, the Democratic Republic of the</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CI">Cote d'Ivoire</option>
                                        <option value="HR">Croatia (Hrvatska)</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands (Malvinas)</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard and Mc Donald Islands</option>
                                        <option value="VA">Holy See (Vatican City State)</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran (Islamic Republic of)</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KP">Korea, Democratic People's Republic of</option>
                                        <option value="KR">Korea, Republic of</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Lao People's Democratic Republic</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libyan Arab Jamahiriya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macau</option>
                                        <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia, Federated States of</option>
                                        <option value="MD">Moldova, Republic of</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN">Netherlands Antilles</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Perú</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Reunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russian Federation</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="KN">Saint Kitts and Nevis</option>
                                        <option value="LC">Saint LUCIA</option>
                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">Sao Tome and Principe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SK">Slovakia (Slovak Republic)</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SH">St. Helena</option>
                                        <option value="PM">St. Pierre and Miquelon</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syrian Arab Republic</option>
                                        <option value="TW">Taiwan, Province of China</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania, United Republic of</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="UM">United States Minor Outlying Islands</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Viet Nam</option>
                                        <option value="VG">Virgin Islands (British)</option>
                                        <option value="VI">Virgin Islands (U.S.)</option>
                                        <option value="WF">Wallis and Futuna Islands</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">¿Alguna consulta?</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="cpc_box_video_right">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/9Vpe-dqscyM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="cpc_box_desc">
                    <div class="cpc_head">
                        <h2>Ponente</h2>
                        <hr>
                    </div>
                    <div class="cpc_body">
                        <strong class="desc">Frich Gonzalo Torres Vega</strong>
                        <p class="desc">CERTIFICADOS: MBA - CIP</p>
                        <p class="desc">Más de 15 años de experiencia en la gestión, gerenciamiento, control de proyecto, planificación y ejecución de proyectos civiles de infraestructura, movimiento de tierras, puentes, viales, mineros de mediana y gran envergadura. Líder en la gestión de oficinas de proyectos (PMI), en administración de contratos, control de proyectos, produccion y construccion. Senior de control de proyectos, costos y claims en empresas como SNC Lavalin, WOOD, ANDDES y APPLUS para clientes como MINSUR, CHINALCO; SOLGAS, MTC, Cerro Verde Y Antamina. – Docente Universitario para UPN y docente para CAPECO. – Magister en Administración de empresas MBA de CENTRUM. -Diplomado en gerencia de proyectos en UPC.</p>
                    </div>
                </div>

                <div class="cpc_box_desc">
                    <div class="cpc_head">
                        <h2>Cursos Similares</h2>
                        <hr>
                    </div>
                    <div class="cpc_body">
                        <?php

                        $args = array(
                            'modalidad' => 'asincronico',
                        );
                        ?>
                        <div class="cpc_card_c mt-5">
                            <?php
                            $args = array(
                                'post_type'      => 'product',
                                'posts_per_page' => 10,
                                'meta_key'       => 'modalidad',
                                'meta_value'     => $args['modalidad'],
                            );

                            $loop = new WP_Query($args);

                            if ($loop->have_posts()) {
                                while ($loop->have_posts()) : $loop->the_post();
                                    global $product;
                            ?>
                                    <div class="cpc_card">
                                        <span class="info_pill">Curso</span>
                                        <a href="<?php echo get_permalink(); ?>" class="head">
                                            <div class="img">
                                                <img src="<?php echo woocommerce_get_product_thumbnail(); ?>" alt="">
                                                <div class="cover"></div>
                                            </div>
                                            <div class="text">
                                                <h3 class="card_title"><?php echo get_the_title(); ?></h3>
                                            </div>
                                        </a>

                                        <div class="content">
                                            <div class="info">
                                                <span class="time"><i class="fa fa-clock-o"></i>12 horas</span>
                                                <span class="sessions"><i class="fa fa-archive"></i>10:00 a.m</span>
                                                <span class="price">$<?php echo $product->get_price(); ?></span>
                                            </div>

                                            <a href="<?php echo get_permalink(); ?>" class="btn btn-primary d-block">Ver Curso</a>
                                        </div>
                                    </div>

                            <?php
                                endwhile;
                            } else {
                                echo "none";
                            }

                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php

get_footer();
?>