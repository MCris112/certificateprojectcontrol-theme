<?php

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class CPC_EMAILS_SENDING extends WP_List_Table
{

    /** Class constructor */
    public function __construct()
    {

        parent::__construct([
            'singular' => 'Email', //singular name of the listed records
            'plural' => 'Emails', //plural name of the listed records
            'ajax' => false //should this table support ajax?
        ]);
    }

    /**
     * Retrieve email’s data from the database
     *
     * @param int $per_page
     * @param int $page_number
     *
     * @return mixed
     */
    public static function get_emails($per_page = 5, $page_number = 1)
    {

        global $wpdb;

        $sql = "SELECT * FROM {$wpdb->prefix}cpc_emails";

        if (!empty($_REQUEST['orderby'])) {
            $sql .= ' ORDER BY ' . esc_sql($_REQUEST['orderby']);
            $sql .= !empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }

        $sql .= " LIMIT $per_page";

        $sql .= ' OFFSET ' . ($page_number - 1) * $per_page;

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;
    }

    /**
     * Delete a email record.
     *
     * @param int $id email ID
     */
    public static function delete_email($id)
    {
        global $wpdb;

        $wpdb->delete(
            "{$wpdb->prefix}cpc_emails",
            ['ID' => $id],
            ['%d']
        );
    }

    /**
     * Returns the count of records in the database.
     *
     * @return null|string
     */
    public static function record_count()
    {
        global $wpdb;

        $sql = "SELECT COUNT(*) FROM {$wpdb->prefix}cpc_emails";

        return $wpdb->get_var($sql);
    }

    /** Text displayed when no email data is available */
    public function no_items()
    {
        _e('No emails avaliable.', 'sp');
    }

    /**
     * Method for name column
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    function column_name($item)
    {

        // create a nonce
        $delete_nonce = wp_create_nonce('sp_delete_email');

        $title = '<strong>' . $item['cpc_name'] . '</strong>';

        $actions = [
            'delete' => sprintf('<a href="?page=%s&action=%s&email=%s&_wpnonce=%s">Delete</a>', esc_attr($_REQUEST['page']), 'delete', absint($item['ID']), $delete_nonce)
        ];

        return $title . $this->row_actions($actions);
    }

    /**
     * Render a column when no column specific method exists.
     *
     * @param array $item
     * @param string $column_name
     *
     * @return mixed
     */
    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'name':
            case 'email_subject':
                return $item[$column_name];
            default:
                return print_r($item, true); //Show the whole array for troubleshooting purposes
        }
    }

    /**
     * Render the bulk edit checkbox
     *
     * @param array $item
     *
     * @return string
     */
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%s" />',
            $item['id']
        );
    }

    /**
     * Associative array of columns
     *
     * @return array
     */
    function get_columns()
    {
        $columns = [
            'cb' => '<input type="checkbox" />',
            'name' => 'Name',
            'email_subject' => 'Subject',
        ];

        return $columns;
    }

    /**
     * Columns to make sortable.
     *
     * @return array
     */
    public function get_sortable_columns()
    {
        $sortable_columns = array(
            'cpc_email_subject' => array('cpc_email_subject', true),
            'cpc_name' => array('cpc_name', false)
        );

        return $sortable_columns;
    }

    /**
     * Returns an associative array containing the bulk action
     *
     * @return array
     */
    public function get_bulk_actions()
    {
        $actions = [
            'bulk-delete' => 'Delete'
        ];

        return $actions;
    }

    /**
     * Handles data query and filter, sorting, and pagination.
     */
    public function prepare_items()
    {

        $this->_column_headers = $this->get_column_info();

        /** Process bulk action */
        $this->process_bulk_action();

        //$per_page = $this->get_items_per_page('emails_per_page', 5);
        $current_page = $this->get_pagenum();
        $total_items = self::record_count();

        $this->set_pagination_args([
            'total_items' => $total_items, //WE have to calculate the total number of items
            'per_page' => 30 //WE have to determine how many items to show on a page
        ]);

        $this->items = $this->get_emails(30, $current_page);
    }

    public function process_bulk_action()
    {

        //Detect when a bulk action is being triggered...
        if ('delete' === $this->current_action()) {

            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr($_REQUEST['_wpnonce']);

            if (!wp_verify_nonce($nonce, 'sp_delete_email')) {
                die('Go get a life script kiddies');
            } else {
                self::delete_email(absint($_GET['email']));

                wp_redirect(esc_url(add_query_arg()));
                exit;
            }
        }

        // If the delete bulk action is triggered
        if ((isset($_POST['action']) && $_POST['action'] == 'bulk-delete')
            || (isset($_POST['action2']) && $_POST['action2'] == 'bulk-delete')
        ) {

            $delete_ids = esc_sql($_POST['bulk-delete']);

            // loop over the array of record IDs and delete them
            foreach ($delete_ids as $id) {
                self::delete_email($id);
            }

            wp_redirect(esc_url(add_query_arg()));
            exit;
        }
    }
}

class CPC_EMAILS_LIST
{
    private $per_page = 30;
    private $page_number = 1;

    public function __construct()
    {
        $this->items = $this->get_items();
    }

    private function get_headers()
    {
        return array(
            'cpc_name' => 'Nombre',
            'cpc_last_name' => 'Apellido',
            'cpc_email' => "Email",
            'cpc_country' => 'País',
            'cpc_phone' => 'Teléfono',
            'cpc_status' => 'Estado',
            'actions' => 'Acciones'
        );
    }

    private function get_items()
    {
        global $wpdb;

        $sql = "SELECT * FROM {$wpdb->prefix}cpc_emails";

        if (!empty($_REQUEST['orderby'])) {
            $sql .= ' ORDER BY ' . esc_sql($_REQUEST['orderby']);
            $sql .= !empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }

        $sql .= " LIMIT $this->per_page";

        $sql .= ' OFFSET ' . ($this->page_number - 1) * $this->per_page;

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;
    }

    private function get_country($value){
        $contries = cpc_var_get_latam_countries();

        if(array_key_exists($value,$contries)){
            return $contries[$value];
        }

        return "No espesificado";
    }
    
    public function show_list()
    {
        $headers = $this->get_headers();
        $items = $this->get_items();
?>
        <table class="table">
            <thead>
                <tr>
                    <?php

                    foreach ($headers as $key => $value) {
                        echo "<th>$value</th>";
                    }

                    ?>
                </tr>
            </thead>


            <tbody>
                <?php
                foreach ($items as $item => $value) {

                    echo '<tr>';
                    foreach ($headers as $key => $val) {
                        if($key == "cpc_country"){
                            $country = $this->get_country($value[$key]);
                            echo "<td>$country</td>";
                        }else if (array_key_exists($key, $value)) {
                            echo '<td>' . $value[$key] . '</td>';
                        }else if($key == "actions"){
                            echo '<td>
                                <a href="?page=cpc_emails_list&action=edit&email=' . $value['id'] . '" class="btn btn-primary">Ver</a>
                                <a href="?page=cpc_emails_list&action=delete&email=' . $value['id'] . '" class="btn btn-danger">Eliminar</a>
                            </td>';
                        }else{
                            echo '<td></td>';
                        }
                    }
                    echo '</tr>';
                }
                ?>

            </tbody>
            <table>

            <?php
        }
    }

    
    function cpc_email_func_capacitacion_single()
    {

            ?>

            <div class="container-fluid">
                <h2>Correos recibidos</h2>

                <?php

                $emails_table = new CPC_EMAILS_LIST();
                $emails_table->show_list();

                ?>
            </div>
            <div class="wrap">


                <div id="poststuff">
                    <div id="post-body" class="metabox-holder columns-2">
                        <div id="post-body-content">
                            <div class="meta-box-sortables ui-sortable">
                                <form method="post">
                                    <?php
                                    $emails_obj = new CPC_EMAILS_SENDING();

                                    $emails_obj->prepare_items();
                                    $emails_obj->display();
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br class="clear">
                </div>
            </div>

        <?php

    }
