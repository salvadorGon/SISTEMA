<?php

namespace App\Models;

use CodeIgniter\Model;

class TutoresModel extends Model
{

    protected $table = 'tutores';
    protected $primaryKey = 'IdTutor';
    protected $returnType = 'array';
    protected $allowedFields = ['Nombre', 'Apellido', 'Correo', 'Contacto', 'IdUsuario'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'Nombre' => 'required|alpha_space|min_length[3]|max_length[500]',
        'Apellido' => 'required|alpha_space|min_length[3]|max_length[500]',
        'Correo' => 'required|valid_email|max_length[500]',
        'Contacto' => 'permit_empty|numeric',
        'IdUsuario' => 'numeric|is_valid_usuario'
    ];

    protected $validationMessages = [
        'Nombre' => [
            'required' => 'El valor "nombre" es requerido',
            'alpha_space' => '"Nombre" solo debe contener letras del alfabeto y espacios',
            'min_length' => '"Nombre" debe ser mayor que 3 caracteres',
            'max_length' => '"Nombre" debe ser menor de 500 caracteres'
        ],
        'Apellido' => [
            'required' => 'El valor es requerido',
            'alpha_space' => 'Solo debe contener letras del alfabeto y espacios',
            'min_length' => 'Debe ser mayor que 3 caracteres',
            'max_length' => 'Debe ser menor de 500 caracteres'
        ],
        'Correo' => [
            'required' => 'El valor "email" es requerido',
            'valid_email' => 'Estimado usuario, debe ingresar un email valido',
            'max_length' => '"Email" debe ser menor de 500 caracteres'
        ],
        'Contacto' => [
            'numeric' => 'Para el valor "contacto" debe ingresar un numero'
        ],
        'IdUsuario' => [
            'numeric' => 'Debe ingresar un numero para el ID "usuario"',
            'is_valid_usuario' => 'el id usuario no existe'
        ]
    ];

    protected $skipValidation = false;


    public function getTutor($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('idtutor');
        $builder->where('idusuario', $id);
        $query = $builder->get();
        return $query->getRowObject();
    }
}
