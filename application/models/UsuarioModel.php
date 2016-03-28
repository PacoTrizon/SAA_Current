<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioModel extends CI_Model {

    private $table = 'usuarios';

    public function getUser($correo, $password)
    {
        $pass = sha1($password);
        $query = "select * from $this->table where email = '$correo' and contrasena = '$pass' and estatus_id = 1";
        $result = $this->db->query($query)->row();
        $this->db->close();
        return $result;
    }

    public function getAll() {
        $this->db->select('users.*,dependencias.nombre as nombre_dependencia');
        $this->db->from($this->table);
        $this->db->join('dependencias', 'dependencias.dependencia_id = users.id_dependencia');
        $this->db->where('estatus', 1);
        $this->db->where('fecha_eliminado', NULL);
        $query = $this->db->get();
        return $query->result();
    }

    public function permisos_id($id) {
        $this->db->select('*');
        $this->db->from('perfiles');
        $this->db->where('id_perfil', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function agregarUsuario($usuario) {
        $password = $usuario->nombre . strval($usuario->id_perfil);
//        $key = $this->config->item('encryption_key');
//        $password = md5($password . $key);
        $password = sha1($password);

        $foo = (array) $usuario;
        $foo['fecha_creado'] = date('Y-m-d H:i:s');
        $foo['password'] = strval($password);
        $foo = (object) $foo;
        $usuario = $foo;
        if ($this->verificarUsuarioExistente($usuario) === true) {
            try {
                $this->db->trans_begin();
                $this->db->insert($this->table, $usuario);
                $this->db->trans_commit();
                return ($this->db->affected_rows() != 1) ? 0 : 1;
            } catch (Exception $ex) {
                $this->db->trans_rollback();
                echo $ex;
            }
        } else {
            return 2;
        }
    }

    public function verificarUsuarioExistente($usuario) {
        $this->db->where('usuario', $usuario->usuario);
        $this->db->where('correo', $usuario->correo);
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0)
            return false;
        else
            return true;
    }

    public function buscarFiltros($filtro) {
        $this->db->select('users.*,dependencias.nombre as nombre_dependencia,cat_roles.rol as nombre_rol');
        $this->db->from($this->table);
        $this->db->join('dependencias', 'dependencias.dependencia_id = users.id_dependencia');
        $this->db->join('cat_roles', 'cat_roles.id_rol = users.id_rol');
        if (isset($filtro->usuario)) {
            $this->db->like('usuario', $filtro->usuario);
        }
        if (isset($filtro->estatus))
            $this->db->where('estatus', $filtro->estatus);
        else
            $this->db->where('estatus', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarUsuarioId($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('usuario_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function verificar_password($id, $password) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('estatus', 1);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            if (sha1($password) == $row->password)
            //if ($password == $row->password)
                return true;
        }
        return false;
    }

    public function actualizar($usuario) {

        $foo = (array) $usuario;
        $foo['fecha_modificado'] = date('Y-m-d H:i:s');
        $foo = (object) $foo;
        $usuario = $foo;
//        $key = $this->config->item('encryption_key');
//        $usuario->password = md5($usuario->password . $key);
        $this->db->where('id', $usuario->id);
        $this->db->update($this->table, $usuario);

        return ($this->db->affected_rows()) ? true : false;
    }

    public function fetch_data($limit, $start, $estatus, $nombreUsuario, $limitePaginado) {
        $this->db->select('users.*,dependencias.nombre as nombre_dependencia,perfiles.descripcion as nombre_perfil');
        $this->db->from($this->table);
        $this->db->join('dependencias', 'dependencias.dependencia_id = users.id_dependencia');
        $this->db->join('perfiles', 'perfiles.id_perfil = users.id_perfil');
        if (!empty($nombreUsuario))
            $this->db->like($this->table . '.usuario', $nombreUsuario);
        $this->db->where($this->table . '.estatus', intval($estatus));
        $this->db->where('fecha_eliminado', NULL);
        $this->db->limit($limit, $start);
        $this->db->limit($limitePaginado);
        $this->db->order_by($this->table . ".nombre", "asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }

    public function record_count() {
        return $this->db->count_all($this->table);
    }

    public function filtros($estatus, $descripcion) {
        $this->db->select('users.*,dependencias.nombre as nombre_dependencia,perfiles.descripcion as nombre_perfil');
        $this->db->from($this->table);
        $this->db->join('dependencias', 'dependencias.dependencia_id = users.id_dependencia');
        $this->db->join('perfiles', 'perfiles.id_perfil = users.id_perfil');
        if (!empty($descripcion))
            $this->db->like($this->table . '.usuario', $descripcion);
        $this->db->where($this->table . '.estatus', intval($estatus));
        $query = $this->db->get();
        return $query->result();
    }

    public function reportePdf($estatus = 1, $descripcion = null) {
        $this->db->select('users.*,dependencias.nombre as nombre_dependencia,perfiles.descripcion as nombre_perfil');
        $this->db->from($this->table);
        $this->db->join('dependencias', 'dependencias.dependencia_id = users.id_dependencia');
        $this->db->join('perfiles', 'perfiles.id_perfil = users.id_perfil');
        if (!empty($descripcion))
            $this->db->like($this->table . '.usuario', $descripcion);
//        if ($estatus != null) {
        $this->db->where($this->table . '.estatus', intval($estatus));
//        } else
//            $this->db->where($this->table . '.estatus', 1);
        $query = $this->db->get();
        return $query->result();
    }

}
