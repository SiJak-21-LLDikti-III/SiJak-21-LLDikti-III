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
    public function editForm()
    {
        $modelipp = new ModelIPP();

        // Ambil data terakhir berdasarkan NPWP
        $lastRecord = $modelipp->orderBy('id', 'DESC')->first();

        // Kirim data terakhir ke view
        $data['record'] = $lastRecord;

        return view('pages/idpemotongpajak', $data);
    }

    public function update($id)
    {
        $modelipp = new ModelIPP();

        // Validasi form input
        $validationRules = [
            'npwp' => 'required|numeric',
            'nama_instansi' => 'required',

            'day' => 'required|numeric',
            'month' => 'required|numeric',
            'year' => 'required|numeric',
            'nama_penandatangan' => 'required',
        ];

        $validationMessages = [
            'npwp' => [
                'required' => 'NPWP harus diisi.',
                'numeric' => 'NPWP harus berupa angka.',
            ],
            'nama_instansi' => 'Nama Instansi harus diisi.',

            'day' => 'Tanggal harus diisi.',
            'month' => 'Bulan harus diisi.',
            'year' => 'Tahun harus diisi.',
            'nama_penandatangan' => 'Nama Penandatangan harus diisi.',
        ];
        $validation = \Config\Services::validation();

        $this->validate($validationRules, $validationMessages);

        // Jika validasi gagal, kembalikan dengan pesan kesalahan
        if ($validation->getErrors()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        /// Dapatkan data dari formulir
        $data = [
            'npwp' => $this->request->getPost('npwp'),
            'nama_instansi' => $this->request->getPost('nama_instansi'),
            'id_sub_unit' => $this->request->getPost('id_sub_unit'),
            'tanggal' => $this->request->getPost('year') . '-' . $this->request->getPost('month') . '-' . $this->request->getPost('day'),
            'nama_penandatangan' => $this->request->getPost('nama_penandatangan'),
        ];
        // Perbarui data di database
        $modelipp->update($id, $data);

        // Redirect setelah memperbarui
        return redirect()->to('/pemotong-pajak');
    }
}
