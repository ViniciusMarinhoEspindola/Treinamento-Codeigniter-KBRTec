<?php

class Categoria_model extends CI_Model 
{
    public function validarCategoria() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('categoria','Categorias', 'required|min_length[1]|max_length[255]|is_unique[categorias_ci.categoria]');

        return $this->form_validation->run();
    }

    public function setCategoria()
    {
        $data = array(
            'categoria' => $_POST['categoria']
        );
        
        $this->db->insert('categorias_ci', $data);
    }

    public function editCategoria($id)
    {
        $data = array('categoria' => $_POST['categoria']);
        $where = "id_categoria = ".$id;
        $str = $this->db->update('categorias_ci', $data, $where);
    }

    public function deleteCategoria($id) {
        $data = array('categoria' => '');
        $where = "id_categoria = ".$id;
        $str = $this->db->update('categorias_ci', $data, $where);

        $this->db->delete('categorias_ci', array('id_categoria' => $id));
    }
}