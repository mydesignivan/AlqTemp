<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Prop_model extends Model {

    function  __construct() {
        parent::Model();
        $this->load->model('credit_model');
    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function create($data = array()) {
        $services = explode(",", $data['services']);
        $images_new = json_decode($data['images_new']);

        unset($data['services']);
        unset($data['images_new']);

        // INSERTA LOS DATOS DE LA PROPIEDAD
        if( !$this->db->insert(TBL_PROPERTIES, $data) ) {
            return false;
        }

        $prop_id = $this->db->insert_id();

        // INSERTA LOS SERVICIOS
        if( !$this->create_servprop($services, $prop_id) ) {
            return false;
        }

        // COPIA LAS IMAGENES NUEVAS
        $data = $this->copy_images($images_new, $prop_id);
        if( !$data ) return false;

        // GUARDA LAS IMAGENES EN LA BASE DE DATO
        foreach( $data as $dat ){
            if( !$this->db->insert(TBL_IMAGES, $dat) ) {
                return false;
            }
        }

        // ELIMINA LAS IMAGENES TEMPORALES DEL USUARIO
        delete_images_temp();

        return "ok";
    }

    public function update($data = array(), $prop_id=null) {
        if( !is_numeric($prop_id) ) return false;

        $services = explode(",", $data['services']);
        $images_new = json_decode($data['images_new']);
        $images_deletes = json_decode($data['images_deletes']);
        $images_modified_id = json_decode($data['images_modified_id']);
        $images_modified_name = json_decode($data['images_modified_name']);
        $user_id = $this->session->userdata('user_id');

        unset($data['services']);
        unset($data['images_new']);
        unset($data['images_deletes']);
        unset($data['images_modified_id']);
        unset($data['images_modified_name']);

        // MODIFICA LOS DATOS DE LA PROPIEDAD
        $this->db->where('prop_id', $prop_id);
        if( !$this->db->update(TBL_PROPERTIES, $data) ) {
            return false;
        }

        // ELIMINA E INSERTA LOS SERVICIOS
        $this->db->delete(TBL_PROPERTIES_SERVS, array('prop_id'=>$prop_id));
        if( !$this->create_servprop($services, $prop_id) ) {
            return false;
        }

        // ELIMINA IMAGENES
        if( $images_deletes!="" ){
            foreach( $images_deletes as $image_id ){
                $row = $this->db->query("SELECT name, name_thumb FROM ". TBL_IMAGES ." WHERE image_id=".$image_id)->row_array();

                @unlink(UPLOAD_DIR.$row['name']);
                @unlink(UPLOAD_DIR.$row['name_thumb']);

                if( $images_modified_id=="" ){
                    $this->db->delete(TBL_IMAGES, array('image_id'=>$image_id));
                }
            }
        }

        // COPIA LAS IMAGENES NUEVAS
        if( $images_new!="" ){
            $data = $this->copy_images($images_new, $prop_id);

            // GUARDA LAS IMAGENES EN LA BASE DE DATO
            foreach( $data as $dat ){
                if( !$this->db->insert(TBL_IMAGES, $dat) ) {
                    return false;
                }            
            }
        }

        // COPIA Y MODIFICA LAS IMAGENES
        if( $images_modified_name!="" ){
            $data = $this->copy_images($images_modified_name, $prop_id);
            if( !$data ) return false;

            // MODIFICA LAS IMAGENES EN LA BASE DE DATO
            foreach( $images_modified_id as $image_id ){
                $dat = current($data);
                unset($dat['prop_id']);
                $this->db->where('image_id', $image_id);

                if( !$this->db->update(TBL_IMAGES, $dat) ) {
                    return false;
                }
                next($data);
            }
        }

        // ELIMINA LAS IMAGENES TEMPORALES DEL USUARIO
        delete_images_temp();

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

        // ELIMINA DATOS EN (properties, properties_to_services, images)
        $delete1 = $this->db->query('DELETE FROM '.TBL_PROPERTIES.' WHERE prop_id in('. implode(",", $prop_id) .')');
        $delete2 = $this->db->query('DELETE FROM '.TBL_PROPERTIES_SERVS.' WHERE prop_id in('. implode(",", $prop_id) .')');
        $delete3 = $this->db->query('DELETE FROM '.TBL_IMAGES.' WHERE prop_id in('. implode(",", $prop_id) .')');

        if( !$delete1 || !$delete2 || !$delete3 ) return false;

        return true;
    }

    public function exists($address, $prop_id=''){
        if( $prop_id=="" ){
            $where = array('address'=>$address);
        }else{
            $where = array('prop_id <>'=>$prop_id, 'address'=>$address);
        }
        $result = $this->db->get_where(TBL_PROPERTIES, $where);
        return $result->num_rows==0 ? false : true;
    }

    public function get_services(){
        return $this->db->get("list_services");
    }

    public function get_service_associate($prop_id){
        if( !is_numeric($prop_id) ) {
            //There was a problem
            return false;
        }
        $this->db->select(TBL_SERVICES.'.service_id');
        $this->db->select(TBL_SERVICES.'.name');
        $this->db->join(TBL_PROPERTIES_SERVS, TBL_SERVICES.'.service_id = '. TBL_PROPERTIES_SERVS .'.service_id');
        return $this->db->get_where(TBL_SERVICES, array('prop_id'=>$prop_id));
    }

    public function get_list_prop($where=array()){
        $sql = "prop_id, address,";
        $sql.= "CASE category WHEN 1 THEN 'Casas' WHEN 2 THEN 'Departamentos' WHEN 3 THEN 'Cabañas' WHEN 4 THEN 'Otros' END as category,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."',name_thumb) FROM ". TBL_IMAGES ." WHERE ". TBL_IMAGES .".prop_id=". TBL_PROPERTIES .".prop_id LIMIT 1) as image";
        $this->db->select($sql, false);
        $this->db->where("user_id", $this->session->userdata('user_id'));
        $this->db->where($where);
        $this->db->order_by('prop_id', 'desc');
        $this->db->order_by('address', 'asc');
        return $this->db->get(TBL_PROPERTIES);
    }


    public function get_prop($prop_id){
        if( !is_numeric($prop_id) ) {
            //There was a problem
            return false;
        }
        $query = $this->db->get_where(TBL_PROPERTIES, array('prop_id'=>$prop_id));

        $service_id = array();
        $data = array();
        $data = $query->row_array();

        $data['services'] = $this->get_service_associate($prop_id);
        $data['images'] = $this->get_images($prop_id);

        return $data;
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

    public function disting($prop_id, $disting){

        if( $disting==1 ){
            $this->credit_model->extract(CREDIT_PROP);
        }

        $this->db->where_in('prop_id', $prop_id);
        return $this->db->update(TBL_PROPERTIES, array('disting'=>$disting));
    }



    /*
     * FUNCTIONS PRIVATE
     */
     private function create_servprop($services, $prop_id){
        $sql = "INSERT INTO ".TBL_PROPERTIES_SERVS."(prop_id,service_id) VALUES ";
        foreach ( $services as $service ){
            $sql.="(";
            $sql.= $prop_id.",".$service."),";
        }
        $sql = substr($sql,0,-1);
        if( !$this->db->query($sql) ){
            return false;
        }
        return true;
     }

     private function copy_images($images_new, $prop_id){
        $user_id = $this->session->userdata('user_id');
        $prefix = $user_id."_";
        $data = array();
        foreach( $images_new as $name_original ){
            $name = preg_replace("/\s+/", "_", strtolower($name_original));


            $filesource = file_search_special(UPLOAD_DIR_TMP, "/^".$user_id."\_.*\__".$name."$/");

            if( $filesource ){
                $filename_dest = $prefix.$name;
                $partf = part_filename($name);

                $n=0;
                while( file_exists($filename_dest) ){
                    $n++;
                    $partf = part_filename($filename_dest);
                    $filename_dest = $partf['basename']."_copy".$n.".".$partf['ext'];
                }

                /*echo $filesource."<br>";
                echo UPLOAD_DIR.$filename_dest;
                die();*/
                if( !copy($filesource, UPLOAD_DIR.$filename_dest) ){
                    die("pase");
                    return false;
                }

                if( $n==0 ){
                    $filename_thumb_dest = $prefix.$partf['basename']."_thumb.".$partf['ext'];
                }else{
                    $filename_thumb_dest = $prefix.$partf['basename']."_copy".$n."_thumb.".$partf['ext'];
                }

                $filesource = str_replace($name, "", $filesource);
                if( !@copy($filesource.$partf['basename']."_thumb.".$partf['ext'], UPLOAD_DIR.$filename_thumb_dest) ){
                    return false;
                }

                $data[] = array(
                    'name'=>$filename_dest,
                    'name_thumb'=>$filename_thumb_dest,
                    'name_original'=>$name_original,
                    'prop_id'=>$prop_id
                );

            }else{
                die("Si estas viendo este error, porfavor anotate, el nombre del archivo:<br>Nombre Archivo: ".$name);
                return false;
            }
        }

        return $data;
     }

}
?>
