<?php

class User_model extends CI_Model 
{
    public function validarEditUsuarios($id) {
        $this->load->library('form_validation');

        $this->db->where("id_user", $id);
        $consulta = $this->db->get("user_ci");

        if($this->input->post('email') !== $consulta->result()[0]->email) {
            $is_unique =  '|is_unique[user_ci.email]';
        } else {
            $is_unique =  '';
        }
        
        $config = array(
            array(
                    'field' => 'name',
                    'label' => 'Nome',
                    'rules' => 'max_length[255]'
            ),
            array(
                    'field' => 'email',
                    'label' => 'E-mail',
                    'rules' => 'valid_email|max_length[255]'.$is_unique
            ),
            array(
                    'field' => 'img',
                    'label' => 'Imagem',
                    'rules' => 'callback_validate_image'          
            )    
        );

        $this->form_validation->set_rules($config);

        return $this->form_validation->run();
    }

    public function validarUsuario($edit = '') {
        $config = array(
            array(
                    'field' => 'name',
                    'label' => 'Nome',
                    'rules' => 'required|max_length[255]'
            ),
            array(
                    'field' => 'email',
                    'label' => 'E-mail',
                    'rules' => 'required|valid_email|max_length[255]|is_unique[user_ci.email]'
            ),
            array(
                    'field' => 'nascimento',
                    'label' => 'Data de nascimento',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'descricao',
                    'label' => 'Descrição',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'img',
                    'label' => 'Imagem',
                    'rules' => 'callback_validate_image'          
            )       
        );
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules($config);

        return $this->form_validation->run();
    }

    public function setUser($data) {
        
        $this->db->insert('user_ci', $data);
    }

    public function getUser($id) {
        $this->db->join('subcategorias_ci', 'subcategorias_ci.id_subcategoria = user_ci.id_subcategoria', 'left');
        $this->db->join('categorias_ci', 'categorias_ci.id_categoria = subcategorias_ci.id_categoria', 'left');
        $this->db->where('id_user', $id);
        
        $query = $this->db->get('user_ci')->result()[0];

        return $query;
    }

    public function sendEmail($data, $message, $assunto) {
        
        $this->load->library('email');
        $this->db->join('categorias_ci', 'subcategorias_ci.id_categoria = categorias_ci.id_categoria', 'left');
        $data['categoria'] = $this->db->get_where('subcategorias_ci', array('id_subcategoria' => $data['id_subcategoria']))->result()[0];

        date_default_timezone_set('America/Sao_Paulo');
        $data['date'] = date('d/m/Y H:i');

        $message = $this->load->view($message, $data, TRUE);

        $this->email->from("webmaster@ambiente-dev5.provisorio.ws");
        $this->email->subject($assunto);
        
        $this->email->to($data['email']); 
        
        $this->email->message($message);
        $this->email->send();
    }

    public function uploadImagem($position, $name) {
        $path = './assets/images';
        
        $configuracao = array(
            'upload_path'   => $path,
            'allowed_types' => 'gif|jpg|png|jpeg',
            'file_name'     => $name 
        );      
        
        $this->load->library('upload');
        $this->upload->initialize($configuracao);
        
        if (!$this->upload->do_upload('img'))
            echo $this->upload->display_errors();

        // Crop image
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path.'/'.$name;
        $config['width'] = $position['w'];
        $config['height'] = $position['h'];
        $config['x_axis'] = $position['x'];
        $config['y_axis'] = $position['y'];

        $this->load->library('image_lib');

        $this->image_lib->initialize($config);

        if (!$this->image_lib->crop())
        {
            echo $this->image_lib->display_errors();
        }

    }

    

    public function editUser($id, $data)
    {
        $where = "id_user = ".$id;
        $str = $this->db->update('user_ci', $data, $where);
    }

    public function listaUsuarios()
    {
        $this->db->order_by('id_user', 'DESC');
        $this->db->join('subcategorias_ci', 'subcategorias_ci.id_subcategoria = user_ci.id_subcategoria', 'left');
        $this->db->join('categorias_ci', 'categorias_ci.id_categoria = subcategorias_ci.id_categoria', 'left');
        $query = $this->db->get('user_ci');
        return $query->result();
    }

    public function contaRegistros()
    {
        return $this->db->count_all_results('user_ci');
    }
}