<?php

namespace App\Controllers;

use App\Models\GorModel;
use App\Models\TarifModel;
use App\Models\FasilitasModel;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->gorModel = new GorModel();
        $this->fasilitasModel = new FasilitasModel();
        $this->tarifModel = new TarifModel();
        $this->db = db_connect();
    }
    public function login()
    {
        return view('admin/login');
    }
    public function dashboard()
    {
        return view('admin/dashboard');
    }
    public function pemesanan()
    {
        return view('admin/pemesanan');
    }
    public function gor()
    {
        $gor = $this->gorModel->first('id_gor', session()->get('id_gor'));
        $fasilitas = $this->fasilitasModel->where('id_gor', session()->get('id_gor'))->findAll();
        $tarif = $this->tarifModel->where('id_gor', session()->get('id_gor'))->findAll();
        $data = [
            'gor' => $gor,
            'tarif' => $tarif,
            'fasilitas' => $fasilitas
        ];
        //dd($fasilitas);
        return view('admin/gor', $data);
    }

    //insert
    public function tambahFasilitas()
    {
        $filename = $_FILES["gambar"]["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $tempname = $_FILES["gambar"]["tmp_name"];
        $nama_file = date('His');
        $folder = "upload/fasilitas/" . $nama_file . "." . $ext;

        if (move_uploaded_file($tempname, $folder)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "Failed to upload image";
        }
        $this->db->query("INSERT INTO fasilitas (id_fasilitas, nama_fasilitas, keterangan, id_gor, foto_fasilitas) VALUES (uuid(), '" . $_POST['nama_fasilitas'] . "', '" . $_POST['keterangan'] . "', '" . session()->get('id_gor') . "', '$nama_file.$ext')");

        return redirect()->to(base_url('/goradm/gor'));
    }
    public function tambahTarif()
    {
        $this->db->query("INSERT INTO tarif (id_tarif, id_gor, kategori, uraian, tarif, satuan) VALUES (uuid(), '" . session()->get('id_gor') . "', '" . $_POST['kategori'] . "', '" . $_POST['nama_tarif'] . "', '" . $_POST['biaya'] . "', '" . $_POST['satuan'] . "')");

        return redirect()->to(base_url('/goradm/gor'));
    }

    //Edit
    public function editFasilitas()
    {
        if (isset($_POST['centang_gambar'])) {

            $filename = $_FILES["gambar"]["name"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $tempname = $_FILES["gambar"]["tmp_name"];
            $nama_file = $_POST['id_fasilitas'];
            $folder = "upload/fasilitas/" . $nama_file . "." . $ext;

            if (move_uploaded_file($tempname, $folder)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }

            $this->fasilitasModel->save([
                'id_fasilitas' => $_POST['id_fasilitas'],
                'nama_fasilitas' => $_POST['nama_fasilitas'],
                'keterangan' => $_POST['keterangan'],
                'foto_fasilitas' => $nama_file . "." . $ext
            ]);
        } else {
            $this->fasilitasModel->save([
                'id_fasilitas' => $_POST['id_fasilitas'],
                'nama_fasilitas' => $_POST['nama_fasilitas'],
                'keterangan' => $_POST['keterangan']
            ]);
        }
        return redirect()->to(base_url('/goradm/gor'));
    }
    public function editGor()
    {
        if (isset($_POST['centang_gambar'])) {

            $filename = $_FILES["gambar"]["name"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $tempname = $_FILES["gambar"]["tmp_name"];
            $nama_file = $_POST['nama_gor'];
            $folder = "upload/gor/" . $nama_file . "." . $ext;

            if (move_uploaded_file($tempname, $folder)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }

            $this->gorModel->save([
                'id_gor' => $_POST['id_gor'],
                'nama_gor' => $_POST['nama_gor'],
                'profil' => $_POST['profil'],
                'foto_muka' => $nama_file . "." . $ext
            ]);
        } else {
            $this->gorModel->save([
                'id_gor' => $_POST['id_gor'],
                'nama_gor' => $_POST['nama_gor'],
                'profil' => $_POST['profil']
            ]);
        }
        return redirect()->to(base_url('/goradm/gor'));
    }
    public function editTarif()
    {
        $this->tarifModel->save([
            'id_tarif' => $_POST['id_tarif'],
            'kategori' => $_POST['kategori'],
            'uraian' => $_POST['nama_tarif'],
            'tarif' => $_POST['biaya'],
            'satuan' => $_POST['satuan']
        ]);
        return redirect()->to(base_url('/goradm/gor'));
    }

    //Delete
    public function hapusTarif($id)
    {
        $this->db->query("DELETE FROM tarif WHERE id_tarif='$id'");
        return redirect()->to(base_url('/goradm/gor'));
    }
    public function hapusFasilitas($id)
    {
        $this->db->query("DELETE FROM fasilitas WHERE id_fasilitas='$id'");
        return redirect()->to(base_url('/goradm/gor'));
    }
}
