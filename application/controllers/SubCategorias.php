<?php

class SubCategorias extends CI_Controller
{
    public function index()
    {
        $this->load->model('SubCategoria_model');

        $lista = $this->SubCategoria_model->listaSubcategorias();
        $variaveis["subcategorias"] = $lista;

        $variaveis['flash_message'] = $this->session->flashdata('mensagem');
        $variaveis['categorias'] = $this->db->get('categorias_ci');
        $this->load->view('includes/header');
        $this->load->view('SubCategorias', $variaveis);
        $this->load->view('includes/footer');
    }

    public function setSubcategoria()
    {
        $this->load->model('SubCategoria_model');

        if ($this->SubCategoria_model->validarSubcategoria() == false) {
            $this->index();
        }
        else {
            $this->SubCategoria_model->setSubcategoria();
            $this->session->set_flashdata('mensagem', 'Subcategoria cadastrada com sucesso!');
            redirect('/SubCategorias', 'location');
        }
    }

    public function editSubcategoria($id)
    {
        $this->load->model('SubCategoria_model');
        if ($this->SubCategoria_model->validarEditSubcategoria($id) == false) {
            $this->editar($id);
        }
        else {
            $this->SubCategoria_model->editSubcategoria($id);
            $this->session->set_flashdata('mensagem', 'Subcategoria editada com sucesso!');
            redirect('/SubCategorias', 'location');
        }
    }

    public function editar($id) {
        $variaveis['categorias'] = $this->db->get('categorias_ci');
        $variaveis['subcategoria'] = $this->db->get_where('subcategorias_ci', array('id_subcategoria' => $id));
        $this->load->view('includes/header');
        $this->load->view('edit/editSubcategoria', $variaveis);
        $this->load->view('includes/footer');
    }
    
    public function deleteSubcategoria($id)
    {
        $this->db->delete('subcategorias_ci', array('id_subcategoria' => $id));
        $this->session->set_flashdata('mensagem', 'Subcategoria deletada com sucesso!');
        redirect('/SubCategorias', 'location');
    }

    public function getSubcategoria($edit='')
    {   
        
        $this->db->where("id_categoria", $this->input->post('categoria'));
        
        $consulta = $this->db->get("subcategorias_ci");

        $option = "";
        
        if ($edit !== '') {
            foreach($consulta->result() as $linha) {
                if ($linha->id_subcategoria == $this->input->post('subcategoria')) {
                    $option .= "<option selected value='$linha->id_subcategoria'>$linha->subcategoria</option>";
                }else{
                    $option .= "<option value='$linha->id_subcategoria'>$linha->subcategoria</option>";
                }
            }
            echo $option;
        }
        else{
            foreach($consulta->result() as $linha) {
                $option .= "<option value='$linha->id_subcategoria'>$linha->subcategoria</option>";
            }
            echo $option;
        }
    }
}