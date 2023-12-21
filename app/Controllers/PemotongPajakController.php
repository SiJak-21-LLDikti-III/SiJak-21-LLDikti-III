<?php

namespace App\Controllers;

use App\Models\ModelIPP;

class PemotongPajakController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Admin - Identitas Pemotong',
        ];
        return view('pages/idpemotongpajak',$data);
    }

    public function update($id)
    {
        $modelipp = new ModelIPP();

        // Dapatkan data dari formulir
        $npwp = $this->request->getPost('npwp');
        $nama_instansi = $this->request->getPost('nama_instansi');
        $id_sub_unit = $this->request->getPost('id_sub_unit');
        $tanggal = $this->request->getPost('year') . '-' . $this->request->getPost('month') . '-' . $this->request->getPost('day');
        $nama_penandatangan = $this->request->getPost('nama_penandatangan');

        // Perbarui data di database
        $modelipp->where('id', $id)
            ->set(['npwp' => $npwp, 'nama_instansi' => $nama_instansi, 'id_sub_unit' => $id_sub_unit, 'tanggal' => $tanggal, 'nama_penandatangan' => $nama_penandatangan])
            ->update();

        // Redirect atau lakukan sesuatu setelah memperbarui
        return redirect()->to('/pemotong-pajak');
    }
}
