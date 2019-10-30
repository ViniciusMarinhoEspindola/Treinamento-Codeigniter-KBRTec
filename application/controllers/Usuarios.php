<?php

class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->library('session');
    }


    public function index()
    {
        $this->load->view('includes/header');
        $this->load->view('Home');
        $this->load->view('includes/footer');
    }

    public function Cadastrar($id=null)
    {   
        $variaveis['categorias'] = $this->db->get('categorias_ci');
        $variaveis['subcategorias'] = $this->db->get('subcategorias_ci');
        $this->load->view('includes/header');
        $this->load->view('Cadastrar', $variaveis);
        $this->load->view('includes/footer');
    }

    public function getData($id = null) {
        $ext = explode('.', $_FILES['img']['name']);
        $img = time().'-'.md5($_FILES['img']['name']).'.'.$ext[1];
        $data = array(
            'nome' => $_POST['name'],
            'email' => $_POST['email'],
            'nascimento' => $_POST['nascimento'],
            'id_subcategoria' => $_POST['subcategoria'],
            'descricao' => $_POST['descricao']
        );

        if(isset($_FILES['img']) && $_FILES['img']['name'] !== "") {
            $data['img'] = $img;
        }
        else{
            $this->db->where('id_user', $id);
            $data['img'] = $this->db->get('user_ci')->result()[0]->img;
        }
        return $data;
    }

    public function setUser()
    {
        $this->load->model('User_model');

        if ($this->User_model->validarUsuario() == false) {
            $this->cadastrar();
        } else {
            // Crop position
            $position['x'] = round($_POST['x']);
            $position['y'] = round($_POST['y']);
            $position['w'] = round($_POST['w']);
            $position['h'] = round($_POST['h']);

            $data = $this->getData();

            $message = 'emails/bem-vindo'; // View do corpo do email
            $assunto = 'Bem-vindo'; // Assunto do email
            
    
            $this->User_model->setUser($data); // Cadastra o usuario
            $this->User_model->sendEmail($data, $message, $assunto); // Envia email
            $this->User_model->uploadImagem($position, $data['img']); // Faz o upload da imagem cortada

            
            $this->session->set_flashdata('mensagem', 'Cadastrado com sucesso!');
            redirect('usuarios/listar', 'location');
        }
    }

    public function validate_image() {
        $check = TRUE;
        if (isset($_FILES['img']) && $_FILES['img']['size'] != 0) {
            $allowedExts = array("gif", "jpeg", "jpg", "png", "JPG", "JPEG", "GIF", "PNG");
            $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
            $extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
            $detectedType = exif_imagetype($_FILES['img']['tmp_name']);
            $type = $_FILES['img']['type'];
            if (!in_array($detectedType, $allowedTypes)) {
                $this->form_validation->set_message('validate_image', 'Conteúdo de imagem inválido!');
                $check = FALSE;
            }
            if(filesize($_FILES['img']['tmp_name']) > 2000000) {
                $this->form_validation->set_message('validate_image', 'O arquivo de imagem não pode exceder 20MB!');
                $check = FALSE;
            }
            if(!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('validate_image', "A extenção {$extension} é inválida!");
                $check = FALSE;
            }
        }
        return $check;
    }

    public function Listar() {
        $this->load->model('User_model');

        $lista = $this->User_model->listaUsuarios();
        $param["usuarios"] = $lista;
        
        $param['flash_message'] = $this->session->flashdata('mensagem');
        
        $this->load->view('includes/header');
        $this->load->view('Usuarios', $param);
        $this->load->view('includes/footer');
    }

    public function editUser($id)
    {
        $this->load->model('User_model');
        if ($this->User_model->validarEditUsuarios($id) == false) {
           $this->editar($id);
        }
        else {
            // Crop position
            $position['x'] = round($_POST['x']);
            $position['y'] = round($_POST['y']);
            $position['w'] = round($_POST['w']);
            $position['h'] = round($_POST['h']);
            
            $data = $this->getData($id);

            if(isset($_FILES['img']) && $_FILES['img']['name'] !== "") {
                $caminho = 'assets/images/'.$this->User_model->getUser($id)->img;
                echo $caminho;
                unlink($caminho);
                $this->User_model->uploadImagem($position, $data['img']);
            }
            $this->User_model->editUser($id, $data);
            
            $message = 'emails/editado'; // View do corpo do email
            $assunto = 'Alteração'; // Assunto do email
            
            $this->User_model->sendEmail($data, $message, $assunto); // Envia email
            
            $this->session->set_flashdata('mensagem', 'Editado com sucesso!');
            
            redirect('/usuarios/listar', 'location');
        }
    }

    public function editar($id) {
        $this->load->model('User_model');
        
        $variaveis['user'] = $this->User_model->getUser($id);
        $variaveis['categorias'] = $this->db->get('categorias_ci');
        $variaveis['subcategorias'] = $this->db->get('subcategorias_ci');

        $this->load->view('includes/header');
        $this->load->view('edit/editUsuario', $variaveis);
        $this->load->view('includes/footer');
    }

    public function vizualizar($id) {
        $this->load->model('User_model');
        $user['user'] = $this->User_model->getUser($id);
        $this->load->view('includes/header');
        $this->load->view('usuario/viewUser', $user);
        $this->load->view('includes/footer');
    }

    public function deleteUsuario($id) {
        $this->load->model('User_model');
        $caminho = 'assets/images/'.$this->User_model->getUser($id)->img;
        
        unlink($caminho);
        $this->db->delete('user_ci', array('id_user' => $id));
        
        $this->session->set_flashdata('mensagem', 'Deletado com sucesso!');
        
        redirect('/usuarios/listar', 'location');
    }
}