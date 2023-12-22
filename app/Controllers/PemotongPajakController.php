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
        return view('pages/idpemotongpajak', $data);
    }

    public function update($id)
    {
        $modelipp = new ModelIPP();

        // Ambil data terakhir berdasarkan NPWP
        $lastRecord = $modelipp->where('npwp', $this->request->getPost('npwp'))->orderBy('id', 'DESC')->first();

        // Validasi form input
        $validationRules = [
            'npwp' => 'required|numeric',
            'nama_instansi' => 'required',
            'id_sub_unit' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'nama_penandatangan' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            // Jika validasi gagal, kembalikan dengan pesan kesalahan
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Dapatkan data dari formulir
        $data['npwp'] = $this->request->getPost('npwp');
        $data['nama_instansi'] = $this->request->getPost('nama_instansi');
        $data['id_sub_unit'] = $this->request->getPost('id_sub_unit');
        $data['tanggal'] = $this->request->getPost('year') . '-' . $this->request->getPost('month') . '-' . $this->request->getPost('day');
        $data['nama_penandatangan'] = $this->request->getPost('nama_penandatangan');

        // Jika data terakhir ditemukan, gunakan data tersebut
        if (!empty($lastRecord)) {
            $data['npwp'] = $lastRecord['npwp'];
        }

        // Perbarui data di database
        $modelipp->update($id, $data);

        // Redirect setelah memperbarui
        return redirect()->to('/pemotong-pajak');
    }
}
