<?php

class Categorias extends CI_Controller
{
    public function index()
    {
        $this->load->model('Categoria_model');

        $param["categorias"] = $this->db->get('categorias_ci')->result();
        $param['flash_message'] = $this->session->flashdata('mensagem');
        $this->load->view('includes/header');
        $this->load->view('Categorias', $param);
        $this->load->view('includes/footer');
    }

    public function setCategoria()
    {
        $this->load->model('Categoria_model');
        if ($this->Categoria_model->validarCategoria() == false) {
            $this->index();
        }
        else {
            $this->Categoria_model->setCategoria();
            $this->session->set_flashdata('mensagem', 'Categoria cadastrada com sucesso!');
            redirect('/categorias', 'location');
        }
    }

    public function getCategoria()
    {
        $this->db->order_by('id_categoria', 'DESC');
        $query = $this->db->get('categorias_ci');
        
        return $query;
    }

    public function editCategoria($id)
    {
        $this->load->model('Categoria_model');
        if ($this->Categoria_model->validarCategoria() == false) {
            $this->editar($id);
        }
        else {
            $this->Categoria_model->editCategoria($id);
            $this->session->set_flashdata('mensagem', 'Categoria editada com sucesso!');
            redirect('/categorias', 'location');
        }
    }
    
    public function editar($id) {
        $categoria['categoria'] = $this->db->get_where('categorias_ci', array('id_categoria' => $id));
        $this->load->view('includes/header');
        $this->load->view('edit/editCategoria', $categoria);
        $this->load->view('includes/footer');
    }

    public function deleteCategoria($id)
    {
        $this->load->model('Categoria_model');
        $this->Categoria_model->deleteCategoria($id);
        
        $this->session->set_flashdata('mensagem', 'Categoria deletada com sucesso!');
        redirect('/categorias', 'location');
    }
}