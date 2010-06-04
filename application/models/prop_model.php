<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Prop_model extends Model {

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct() {
        parent::Model();
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function create($data = array()) {
        $images_new = $data['extra_post']->images_new;
        $services = $data['extra_post']->services;

        if( isset($data['extra_post']->gmap_coorLat) && $data['gmap_visible']==1 ) $this->_set_data($data);
        
        unset($data['extra_post']);

        $this->db->trans_start(); // INICIO TRANSACCION

        // INSERTA LOS DATOS DE LA PROPIEDAD
        if( !$this->db->insert(TBL_PROPERTIES, $data) ) {
            display_error(__FILE__, "create", ERR_DB_INSERT, array(TBL_PROPERTIES));
        }

        $prop_id = $this->db->insert_id();

        // INSERTA LOS SERVICIOS
        if( !$this->db->query($this->_get_sql_servprop($services, $prop_id)) ){
            display_error(__FILE__, "create", ERR_DB_INSERT, array(TBL_PROPERTIES_SERVS));
        }

        // COPIA LAS IMAGENES NUEVAS
        $data = $this->_copy_images($images_new, $prop_id);
        if( !$data ) return false;

        // GUARDA LAS IMAGENES EN LA BASE DE DATO
        foreach( $data as $dat ){
            if( !$this->db->insert(TBL_IMAGES, $dat) ) {
                display_error(__FILE__, "create", ERR_DB_INSERT, array(TBL_IMAGES));
            }
        }

        // ELIMINA LAS IMAGENES TEMPORALES DEL USUARIO
        delete_images_temp();
        
        $this->db->trans_complete(); // COMPLETO LA TRANSACCION

        return "ok";
    }

    public function edit($data = array(), $prop_id=null) {
        if( !is_numeric($prop_id) ) return false;

        $services = $data['extra_post']->services;
        $images_new = $data['extra_post']->images_new;
        $images_deletes = $data['extra_post']->images_delete;
        $images_modified_id = $data['extra_post']->images_modified_id;
        $images_modified_name = $data['extra_post']->images_modified_name;
        
        if( isset($data['extra_post']->gmap_coorLat) && $data['gmap_visible']==1 ) $this->_set_data($data);

        unset($data['extra_post']);

        $this->db->trans_begin();

        // MODIFICA LOS DATOS DE LA PROPIEDAD
        $this->db->where('prop_id', $prop_id);
        if( !$this->db->update(TBL_PROPERTIES, $data) ) {
            display_error(__FILE__, "edit", ERR_DB_UPDATE, array(TBL_PROPERTIES));
        }

        // ELIMINA LOS SERVICIOS ASOCIADOS
        if( !$this->db->delete(TBL_PROPERTIES_SERVS, array('prop_id'=>$prop_id)) ){
            display_error(__FILE__, "edit", ERR_DB_DELETE, array(TBL_PROPERTIES_SERVS));
        }

        $this->db->trans_commit();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_begin();

        // INSERTA LOS SERVICIOS
        if( !$this->db->query($this->_get_sql_servprop($services, $prop_id)) ){
            display_error(__FILE__, "edit", ERR_DB_INSERT, array(TBL_PROPERTIES_SERVS));
        }

        // ELIMINA IMAGENES
        foreach( $images_deletes as $image_id ){
            $row = $this->db->query("SELECT name, name_thumb FROM ". TBL_IMAGES ." WHERE image_id=".$image_id)->row_array();

            @unlink(UPLOAD_DIR.$row['name']);
            @unlink(UPLOAD_DIR.$row['name_thumb']);

            if( count($images_modified_id)==0 ){
                if( !$this->db->delete(TBL_IMAGES, array('image_id'=>$image_id)) ){
                    display_error(__FILE__, "edit", ERR_DB_DELETE, array(TBL_IMAGES));
                }
                $this->db->trans_commit();
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    return false;
                }
            }
        }

        // COPIA LAS IMAGENES NUEVAS
        $this->db->trans_begin();
        if( count($images_new)>0 ){
            $data = $this->_copy_images($images_new, $prop_id);
            if( !$data ) return false;

            // GUARDA LAS IMAGENES EN LA BASE DE DATO
            foreach( $data as $dat ){
                if( !$this->db->insert(TBL_IMAGES, $dat) ) {
                    display_error(__FILE__, "edit", ERR_DB_INSERT, array(TBL_IMAGES));
                }
            }
        }

        // COPIA Y MODIFICA LAS IMAGENES
        if( count($images_modified_name)>0 ){
            $data = $this->_copy_images($images_modified_name, $prop_id);
            if( !$data ) return false;

            // MODIFICA LAS IMAGENES EN LA BASE DE DATO
            foreach( $images_modified_id as $image_id ){
                $dat = current($data);
                unset($dat['prop_id']);
                $this->db->where('image_id', $image_id);

                if( !$this->db->update(TBL_IMAGES, $dat) ) {
                    display_error(__FILE__, "edit", ERR_DB_UPDATE, array(TBL_IMAGES));
                }
                next($data);
            }
        }

        // ELIMINA LAS IMAGENES TEMPORALES DEL USUARIO
        delete_images_temp();

        $this->db->trans_commit();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }
        
        return "ok";
    }

    public function delete($prop_id) {

        // ELIMINA LAS IMAGENES
        $this->db->select('name, name_thumb');
        $this->db->where_in("prop_id", $prop_id);
        $query = $this->db->get(TBL_IMAGES);

        foreach( $query->result_array() as $row ){
            @unlink(UPLOAD_DIR.$row['name']);
            @unlink(UPLOAD_DIR.$row['name_thumb']);
        }

        $this->db->trans_start(); // INICIO TRANSACCION

        // ELIMINA DATOS EN (properties, properties_to_services, properties_disting, images, log_searches)
        if( !$this->db->query('DELETE FROM '.TBL_PROPERTIES.' WHERE prop_id in('. implode(",", $prop_id) .')') ){
            display_error(__FILE__, "delete", ERR_DB_DELETE, array(TBL_PROPERTIES));
        }
        if( !$this->db->query('DELETE FROM '.TBL_PROPERTIES_SERVS.' WHERE prop_id in('. implode(",", $prop_id) .')') ){
            display_error(__FILE__, "delete", ERR_DB_DELETE, array(TBL_PROPERTIES_SERVS));
        }
        if( !$this->db->query('DELETE FROM '.TBL_PROPERTIES_DISTING.' WHERE prop_id in('. implode(",", $prop_id) .')') ){
            display_error(__FILE__, "delete", ERR_DB_DELETE, array(TBL_PROPERTIES_DISTING));
        }
        if( !$this->db->query('DELETE FROM '.TBL_IMAGES.' WHERE prop_id in('. implode(",", $prop_id) .')') ){
            display_error(__FILE__, "delete", ERR_DB_DELETE, array(TBL_IMAGES));
        }

        $this->db->trans_complete(); // COMPLETO LA TRANSACCION

        return true;
    }

    public function exists($reference, $prop_id=''){
        if( $prop_id=="" ){
            $where = array('reference'=>$reference);
        }else{
            $where = array('prop_id <>'=>$prop_id, 'address'=>$reference);
        }
        $result = $this->db->get_where(TBL_PROPERTIES, $where);
        return $result->num_rows==0 ? false : true;
    }

    public function get_service_associate($prop_id){
        $this->db->select(TBL_SERVICES.'.service_id');
        $this->db->select(TBL_SERVICES.'.name');
        $this->db->join(TBL_PROPERTIES_SERVS, TBL_SERVICES.'.service_id = '. TBL_PROPERTIES_SERVS .'.service_id');
        return $this->db->get_where(TBL_SERVICES, array('prop_id'=>$prop_id))->result_array();
    }

    public function get_list_prop($limit, $offset){
        $sql = "prop_id, reference,";
        $sql.= "(SELECT name FROM ".TBL_CATEGORY." WHERE category_id=".TBL_PROPERTIES.".category_id) as category,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."',name_thumb) FROM ". TBL_IMAGES ." WHERE ". TBL_IMAGES .".prop_id=". TBL_PROPERTIES .".prop_id LIMIT 1) as image";

        $return = array();

        $this->db->select($sql, false);
        $this->db->from(TBL_PROPERTIES);
        $this->db->where("user_id", $this->session->userdata('user_id'));
        $return['count_rows'] = $this->db->count_all_results();

        $this->db->select($sql, false);
        $this->db->where("user_id", $this->session->userdata('user_id'));
        $this->db->order_by('prop_id', 'desc');
        $this->db->order_by('address', 'asc');

        $return['result'] = $this->db->get(TBL_PROPERTIES, $limit, $offset);

        return $return;
    }

    public function get_list2_prop($limit, $offset, $arr_url){
        $return = array();

        $sql = TBL_PROPERTIES.".prop_id,";
        $sql.= TBL_PROPERTIES.".address,";
        $sql.= "date_format(" .TBL_PROPERTIES. ".date_added, '%d-%m-%Y %H:%i:%s') as date_added,";
        $sql.= "date_format(" .TBL_PROPERTIES. ".last_modified, '%d-%m-%Y %H:%i:%s') as last_modified,";
        $sql.= TBL_USERS.".user_id,";
        $sql.= TBL_USERS.".username";
        
        $like = array();
        $where = array();

        if( count($arr_url)>0 ){
            if( isset($arr_url['address']) ) $like['address'] = $arr_url['address'];
            if( isset($arr_url['username']) ) $like['username'] = $arr_url['username'];
            if( isset($arr_url['date_added']) ) {
                $d = explode("-", $arr_url['date_added']);
                if( $d[0]!="any" ) $where["date_format(".TBL_PROPERTIES.".date_added, '%d')="] = $d[0];
                if( $d[1]!="any" ) $where["date_format(".TBL_PROPERTIES.".date_added, '%m')="] = $d[1];
                if( $d[2]!="any" ) $where["date_format(".TBL_PROPERTIES.".date_added, '%Y')="] = $d[2];
            }
            if( isset($arr_url['last_modified']) ) {
                $d = explode("-", $arr_url['last_modified']);
                if( $d[0]!="any" ) $where["date_format(".TBL_PROPERTIES.".last_modified, '%d')="] = $d[0];
                if( $d[1]!="any" ) $where["date_format(".TBL_PROPERTIES.".last_modified, '%m')="] = $d[1];
                if( $d[2]!="any" ) $where["date_format(".TBL_PROPERTIES.".last_modified, '%Y')="] = $d[2];
            }
        }

        $this->db->from(TBL_PROPERTIES);
        $this->db->join(TBL_USERS, TBL_PROPERTIES.'.user_id = '.TBL_USERS.'.user_id');
        $this->db->like($like);
        $this->db->where($where);

        $return['count_rows'] = $this->db->count_all_results();

        $this->db->select($sql, false);
        $this->db->join(TBL_USERS, TBL_PROPERTIES.'.user_id = '.TBL_USERS.'.user_id');
        $this->db->like($like);
        $this->db->where($where);

        if( !isset($arr_url['orderby']) ){
            $this->db->order_by('prop_id', 'desc');
        }else{
            $this->db->order_by($arr_url['orderby'], $arr_url['order']);
        }

        $return['result'] = $this->db->get(TBL_PROPERTIES, $limit, $offset);

        return $return;
    }

    public function get_prop($prop_id){
        $query = $this->db->get_where(TBL_PROPERTIES, array('prop_id'=>$prop_id));
        if( $query->num_rows>0 ){
            $service_id = array();
            $data = array();
            $data = $query->row_array();

            $data['services'] = $this->get_service_associate($prop_id);
            $data['images'] = $this->get_images($prop_id);
            return $data;
        } else return false;
    }

    public function get_images($prop_id){
        if( !is_numeric($prop_id) ) {
            //There was a problem
            return false;
        }
        $sql = "image_id,";
        $sql.= "CONCAT('".substr(UPLOAD_DIR,2)."',name) as name,";
        $sql.= "CONCAT('".substr(UPLOAD_DIR,2)."',name_thumb) as name_thumb,";
        $sql.= "name_original";

        $this->db->select($sql, false);
        $this->db->where('prop_id', $prop_id);
        return $this->db->get(TBL_IMAGES);
    }

    public function get_info_prop($id){
        $this->db->select(TBL_USERS.'.email, '.TBL_PROPERTIES.'.address', false);
        $this->db->from(TBL_USERS);
        $this->db->join(TBL_PROPERTIES, TBL_USERS.'.user_id = '.TBL_PROPERTIES.'.user_id');
        $this->db->where(TBL_PROPERTIES.'.prop_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_total_prop(){
        $this->db->where("user_id", $this->session->userdata('user_id'));
        $query = $this->db->get(TBL_PROPERTIES);
        return $query->num_rows;
    }


    /* PRIVATE FUNCTIONS
     **************************************************************************/
     private function _get_sql_servprop($services, $prop_id){
        $sql = "INSERT INTO ".TBL_PROPERTIES_SERVS."(prop_id,service_id) VALUES ";
        foreach ( $services as $service ){
            $sql.="(". $prop_id .",". $service ."),";
        }
        
        return substr($sql,0,-1);
     }

     private function _copy_images($images_new, $prop_id){
        $user_id = $this->session->userdata('user_id');
        $prefix = $user_id."_";
        $data = array();

        foreach( $images_new as $name_original ){
            $name = preg_replace("/\s+/", "_", strtolower($name_original));


            $filesource = file_search_special(UPLOAD_DIR_TMP, $name);

            if( $filesource ){
                $filename_dest = $prefix.$name;
                $partf = part_filename($name);

                $n=0;
                while( file_exists(UPLOAD_DIR.$filename_dest) ){
                    $n++;
                    $partf2 = part_filename($filename_dest);
                    $filename_dest = $partf2['basename']."_copy".$n.".".$partf2['ext'];

                    $partf3 = part_filename($name_original);
                    $name_original = $partf3['basename']."_copy".$n.".".$partf3['ext'];
                }

                if( !@copy($filesource, UPLOAD_DIR.$filename_dest) ){
                    display_error(__FILE__, "copy_images", ERR_PROP_COPY_FAILD, array(UPLOAD_DIR.$filename_dest));
                }

                if( $n==0 ){
                    $filename_thumb_dest = $prefix.$partf['basename']."_thumb.".$partf['ext'];
                }else{
                    $filename_thumb_dest = $partf2['basename']."_copy".$n."_thumb.".$partf2['ext'];
                }

                $filesource = str_replace($name, "", $filesource);
                if( !@copy($filesource.$partf['basename']."_thumb.".$partf['ext'], UPLOAD_DIR.$filename_thumb_dest) ){
                    display_error(__FILE__, "copy_images", ERR_PROP_COPY_FAILD, array(UPLOAD_DIR.$filename_thumb_dest));
                }

                $data[] = array(
                    'name'=>$filename_dest,
                    'name_thumb'=>$filename_thumb_dest,
                    'name_original'=>$name_original,
                    'prop_id'=>$prop_id
                );

            }else{
                display_error(__FILE__, "copy_images", ERR_PROP_IMAGE_NONEXISTENT, array(UPLOAD_DIR_TMP, $name));
            }
        }

        return $data;
     }

     private function _set_data(&$data){
        $data['gmap_lat'] = $data['extra_post']->gmap_coorLat;
        $data['gmap_lng'] = $data['extra_post']->gmap_coorLng;
        $data['gmap_address'] = $data['extra_post']->gmap_address;
        $data['gmap_zoom'] = $data['extra_post']->gmap_zoom;
        $data['gmap_maptype'] = $data['extra_post']->gmap_mapType;
     }

}
?>