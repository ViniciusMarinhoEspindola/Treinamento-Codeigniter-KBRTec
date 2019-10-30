<?php

class SubCategoria_model extends CI_Model 
{
    public function validarEditSubcategoria($id) {
        $this->load->library('form_validation');

        $this->db->where("id_subcategoria", $id);
        
        $consulta = $this->db->get("subcategorias_ci");

        if($this->input->post('editSubcategoria') !== $consulta->result()[0]->subcategoria) {
            $is_unique =  '|is_unique[subcategorias_ci.subcategoria]';
        } else {
            $is_unique =  '';
        }

        $this->form_validation->set_rules('editSubcategoria','Editar Subcategorias', 'min_length[1]|max_length[255]'.$is_unique);

        return $this->form_validation->run();
    }

    public function validarSubcategoria() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('subcategoria','Subcategorias', 'required|min_length[1]|max_length[255]|is_unique[subcategorias_ci.subcategoria]', array(
            'required'      => 'Este campo é obrigatório.',
            'max_length'    => 'A subcategoria cadastrada é muito grande',
            'is_unique'     => 'Esta subcategoria já existe.'
        ));

        return $this->form_validation->run();
    }

    public function setSubcategoria()
    {
        $data = array(
            'subcategoria' => $_POST['subcategoria'],
            'id_categoria' => $_POST['categoria']
        );
        
        $this->db->insert('subcategorias_ci', $data);
    }

    public function editSubcategoria($id)
    {
        $data = array('subcategoria' => $_POST['editSubcategoria'], 'id_categoria' => $_POST['editCategoria']);
        $where = "id_subcategoria = ".$id;
        $str = $this->db->update('subcategorias_ci', $data, $where);
        
    }

    function listaSubcategorias()
    {
        $this->db->order_by('subcategorias_ci.id_categoria', 'DESC');
        $this->db->join('categorias_ci', 'categorias_ci.id_categoria = subcategorias_ci.id_categoria');
        $query = $this->db->get('subcategorias_ci');
        return $query->result();
    }

    public function contaRegistros()
    {
        return $this->db->count_all_results('subcategorias_ci');
    }
}