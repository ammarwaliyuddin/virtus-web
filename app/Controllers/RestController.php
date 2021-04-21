<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\LoginModel;
use App\Models\LokasiModel;

class RestController extends ResourceController
{
    use ResponseTrait;

    // all area
    public function area()
    {
        $model = new LokasiModel();
        $data['data_area'] = $model->orderBy('Nama_area', 'ASC')->findAll();
        return $this->respond($data);
    }

    // create
    public function create()
    {
        $model = new LokasiModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Employee created successfully'
            ]
        ];
        return $this->respondCreated($response);
    }

    // single user
    public function getEmployee($id = null)
    {
        $model = new LokasiModel();
        $data = $model->where('id', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No employee found');
        }
    }

    // update
    public function update($id = null)
    {
        $model = new LokasiModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Employee updated successfully'
            ]
        ];
        return $this->respond($response);
    }

    // delete
    public function delete($id = null)
    {
        $model = new LokasiModel();
        $data = $model->where('id', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Employee successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No employee found');
        }
    }
}
