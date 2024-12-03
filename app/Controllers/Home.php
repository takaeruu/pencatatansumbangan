<?php

namespace App\Controllers;
Use App\Models\M_ps;

class Home extends BaseController
{


	public function dashboard()
{
    $model = new M_ps();
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    // Ambil nama pengguna dari session
    $session = session();
    $data['username'] = $session->get('username');

    $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Dashboard',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
    echo view('header', $data);
    echo view('menu');
    echo view('dashboard', $data);
    echo view('footer');
}

public function logout()

    {
        session()->destroy();
        return redirect()->to('home/login');
    }
	public function login()
	{
		$model= new M_ps();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
        $activityLog = [
            'id_user' => $id_user,
            'menu' => 'Masuk ke Login',
            'time' => date('Y-m-d H:i:s')
        ];
        $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('login');
	}




public function aksi_login()
{
    // Periksa koneksi internet
    if (!$this->checkInternetConnection()) {
        // Jika tidak ada koneksi, cek CAPTCHA gambar
        $captcha_code = $this->request->getPost('captcha_code');
        if (session()->get('captcha_code') !== $captcha_code) {
            session()->setFlashdata('toast_message', 'Invalid CAPTCHA');
            session()->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    } else {
        // Jika ada koneksi, cek Google reCAPTCHA
        $recaptchaResponse = trim($this->request->getPost('g-recaptcha-response'));
        $secret = '6LefTYMqAAAAAC1hYWZVpC0-nPwlZkdDZaDXlKi1'; // Ganti dengan Secret Key Anda
        $credential = array(
            'secret' => $secret,
            'response' => $recaptchaResponse
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
        curl_close($verify);

        $status = json_decode($response, true);

        if (!$status['success']) {
            session()->setFlashdata('toast_message', 'Captcha validation failed');
            session()->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    }


    
    // Proses login seperti biasa
    $u = $this->request->getPost('username');
    $p = $this->request->getPost('password');

    $where = array(
        'username' => $u,
        'password' => md5($p),
    );
    $model = new M_ps;
    $cek = $model->getWhere('user', $where);

    if ($cek) {
        session()->set('nama', $cek->username);
        session()->set('id', $cek->id_user);
        session()->set('level', $cek->level);
        return redirect()->to('home/dashboard');
    } else {
        session()->setFlashdata('toast_message', 'Invalid login credentials');
        session()->setFlashdata('toast_type', 'danger');
        return redirect()->to('home/login');
    }
}



public function generateCaptcha()
{
    // Create a string of possible characters
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $captcha_code = '';
    
    // Generate a random CAPTCHA code with letters and numbers
    for ($i = 0; $i < 6; $i++) {
        $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    // Store CAPTCHA code in session
    session()->set('captcha_code', $captcha_code);
    
    // Create an image for CAPTCHA
    $image = imagecreate(120, 40); // Increased size for better readability
    $background = imagecolorallocate($image, 200, 200, 200);
    $text_color = imagecolorallocate($image, 0, 0, 0);
    $line_color = imagecolorallocate($image, 64, 64, 64);
    
    imagefilledrectangle($image, 0, 0, 120, 40, $background);
    
    // Add some random lines to the CAPTCHA image for added complexity
    for ($i = 0; $i < 5; $i++) {
        imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $line_color);
    }
    
    // Add the CAPTCHA code to the image
    imagestring($image, 5, 20, 10, $captcha_code, $text_color);
    
    // Output the CAPTCHA image
    header('Content-type: image/png');
    imagepng($image);
    imagedestroy($image);
}




public function checkInternetConnection()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    } else {
        return false;
    }
}



public function register()
	{
		$model= new M_ps();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Register',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('register');
	}


	public function aksi_t_register()
{
    if(session()->get('id') > 0) {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        // Hash the password using MD5
        $hashedPassword = md5($password);

        $darren = array(
            'username' => $username,
            'password' => $hashedPassword, 
			'level' => 'pengguna',  // Store the hashed password
        );

        // Initialize the model
        $model = new M_ps;
        $model->tambah('user', $darren);

        // Redirect to the 'tb_user' page
        return redirect()->to('home/login');
    } else {
        // If no session or user is logged in, redirect to the login page
        return redirect()->to('home/login');
    }
}


public function profile()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            $model = new M_ps();
           
            $where3 = array('id_setting' => '1');
            $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();

            $where = array('id_user' => session()->get('id'));
            $data['yoga'] = $model->getwhere('user', $where);
            helper('permission'); // Pastikan helper dimuat

            echo view('header', $data);
            echo view('menu', $data);
            echo view('profile', $data);
            echo view('footer');
        } else {
            return redirect()->to('home/login');
        }
    }
    public function editfoto()
    {
        $model = new M_ps();
        
        $userData = $model->getById(session()->get('id'));

        if ($this->request->getFile('foto')) {

            $file = $this->request->getFile('foto');
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/img', $newFileName);

            if ($userData->foto && file_exists(ROOTPATH . 'public/img/' . $userData->foto)) {
                unlink(ROOTPATH . 'public/img/' . $userData->foto);
            }
            $userId = ['id_user' => session()->get('id')];
            $userData = ['foto' => $newFileName];
            $model->edit('user', $userData, $userId);
        }
        return redirect()->to('home/profile');
    }
    public function aksi_e_profile()
    {
        if (session()->get('id') > 0) {
            $model = new M_ps();
           
            $yoga = $this->request->getPost('username');
            $id = $this->request->getPost('id');

            $where = array('id_user' => $id); // Jika id_user adalah kunci utama untuk menentukan record


            $isi = array(
                'username' => $yoga,
            );

            $model->edit('user', $isi, $where);
            return redirect()->to('home/profile');
            // print_r($yoga);
            // print_r($id);
        } else {
            return redirect()->to('home/login');
        }
    }
    public function changepassword()
    {
        if (session()->get('id') > 0) {

            $model = new M_ps();
            
            $where3 = array('id_setting' => '1');
            $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();
            $where = array('id_user' => session()->get('id'));
            $data['darren'] = $model->getwhere('user', $where);
            helper('permission'); // Pastikan helper dimuat

            echo view('header', $data);
            echo view('menu', $data);
            echo view('changepassword', $data);
            echo view('footer');
        } else {
            return redirect()->to('home/login');
        }
    }
    public function aksi_changepass()
    {
        $model = new M_ps();
        $oldPassword = $this->request->getPost('old');
        $newPassword = $this->request->getPost('new');
        $userId = session()->get('id');

        // Dapatkan password lama dari database
        $currentPassword = $model->getPassword($userId);

        // Verifikasi apakah password lama cocok
        if (md5($oldPassword) !== $currentPassword) {
            // Set pesan error jika password lama salah
            session()->setFlashdata('error', 'Password lama tidak valid.');
            return redirect()->back()->withInput();
        }

        // Update password baru
        $data = [
            'password' => md5($newPassword),
            'updated_by' => $userId,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $where = ['id_user' => $userId];

        $model->edit('user', $data, $where);

        // Set pesan sukses
        session()->setFlashdata('success', 'Password berhasil diperbarui.');
        return redirect()->to('home/changepassword');
    }

public function program(){

    $model = new M_ps;
    $data['oke'] = $model->tampil('program');
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
    $id_user = session()->get('id');
$activityLog = [
    'id_user' => $id_user,
    'menu' => 'Masuk ke ',
    'time' => date('Y-m-d H:i:s')
];
$model->logActivity($activityLog);
    echo view('header', $data);
    echo view('menu');
    echo view('program', $data);
    echo view('footer');
}

public function t_program(){

    $model = new M_ps;
    $data['oke'] = $model->tampil('program');
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
    $id_user = session()->get('id');
$activityLog = [
    'id_user' => $id_user,
    'menu' => 'Masuk ke Tambah Program',
    'time' => date('Y-m-d H:i:s')
];
$model->logActivity($activityLog);
    echo view('header', $data);
    echo view('menu');
    echo view('t_program', $data);
}


public function aksi_t_program()
{
    if(session()->get('id') > 0){
        $nama_program = $this->request->getPost('nama_program');

        $darren = array(
            'nama_program' => $nama_program,
            'tanggal' => date('Y-m-d')
        );

        $model = new M_ps;
        $model->tambah('program', $darren);
        return redirect()->to('home/program');
    } else {
        return redirect()->to('home/login');
    }
}


public function e_program($id_program) {  // Terima parameter id_user
    $model = new M_ps;
    
    // Mengambil data setting
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
    
    // Ambil data user berdasarkan id_user yang diterima
    $whereProgram = array('id_program' => $id_program);
    $data['oke'] = $model->getWhere1('program', $whereProgram)->getRow();  // Mengambil data program spesifik berdasarkan ID

    // Log aktivitas
    $id_program_session = session()->get('id');
    $activityLog = [
        'id_program' => $id_program_session,
        'menu' => 'Masuk ke Edit program',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);

    // Memuat view
    echo view('header', $data);
    echo view('menu');
    echo view('e_program', $data);
}

public function aksi_e_program()
    {
        $nama_program = $this->request->getPost('nama_program');
        $id = $this->request->getPost('id');

        $model = new M_ps;

        // Ambil data lama sebelum update
        $oldData = $model->getWhere('program', ['id_program' => $id]);

        // Simpan data lama ke tabel backup
        if ($oldData) {
            $backupData = [
                'id_program' => $oldData->id_program,  // integer
                'nama_program' => $oldData->nama_program,             // integer
                'backup_by' => $oldData->backup_by,         // integer
                'backup_at' => $oldData->backup_at,         // datetime
            ];

            // Debug: cek hasil insert ke tabel backup
            if ($model->saveToBackup('program_backup', $backupData)) {
                echo "Data backup berhasil disimpan!";
            } else {
                echo "Gagal menyimpan data ke backup.";
            }
        } else {
            echo "Data lama tidak ditemukan.";
        }

        // Data baru yang akan diupdate
        $darren = array(
           'nama_program' => $nama_program,
                'updated_by' => session()->get('id'),
                'updated_at' => date('Y-m-d H:i:s'),
        );

        // Update data di tabel pemesanan
        $where = array('id_program' => $id);
        $model->edit('program', $darren, $where);

        return redirect()->to('home/program');
    }



    public function restore_edit_program(){

        $model = new M_ps;
        $data['oke'] = $model->tampil('program_backup');
        $where = array('id_setting' => '1');
        $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
        $activityLog = [
            'id_user' => $id_user,
            'menu' => 'Masuk ke Restore Edit Program',
            'time' => date('Y-m-d H:i:s')
        ];
        $model->logActivity($activityLog);
        echo view('header', $data);
        echo view('menu');
        echo view('restore_edit', $data);
        echo view('footer');
    }

    public function aksi_restore_edit_program($id)
{
    $model = new M_ps();
    
    $backupData = $model->getWhere('program_backup', ['id_program' => $id]);

    if ($backupData) {
       
        $restoreData = [
            'nama_program' => $backupData->nama_program,
           
            // tambahkan field lainnya sesuai dengan struktur tabel menu
        ];
        unset($restoreData['id_program']);
        $model->edit('program', $restoreData, ['id_program' => $id]);
    }
    
    return redirect()->to('home/program');
}




    public function soft_delete(){

        $model = new M_ps;
        $data['oke'] = $model->join22('donasi', 'program', 'donasi.id_program=program.id_program');
        $data['yoga'] = $model->tampil('program');
    
        $where = array('id_setting' => '1');
        $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
        $activityLog = [
            'id_user' => $id_user,
            'menu' => 'Masuk ke Soft Delete',
            'time' => date('Y-m-d H:i:s')
        ];
        $model->logActivity($activityLog);
        echo view('header', $data);
        echo view('menu');
        echo view('soft_delete', $data);
        echo view('footer');
    }

    public function restore_donasi($id)
    {
        $model = new M_ps();
        $where = array('id_donasi' => $id);
        $array = array(
            'deleted_at' => NULL, // Mengatur deleted_at menjadi null
        );
        $model->edit('donasi', $array, $where);
    
        return redirect()->to('home/donasi');
    }


    public function hapus_donasi($id)
    {
        $model = new M_ps();
        $where = array('id_donasi' => $id);
        $array = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );
        $model->edit('donasi', $array, $where);
        // $this->logdonasiActivity('Menghapus Pemesanan');

        return redirect()->to('home/donasi');
    }

    public function hapus_donasi_permanent($id)
    {
        $model = new M_ps();
        // $this->logdonasiActivity('Menghapus Pemesanan Permanent');
        $where = array('id_donasi' => $id);
        $model->hapus('donasi', $where);
    
        return redirect()->to('Home/donasi');
    }

    public function hapus_program($id)
    {
        $model = new M_ps();
        // $this->logdonasiActivity('Menghapus Pemesanan Permanent');
        $where = array('id_program' => $id);
        $model->hapus('program', $where);
    
        return redirect()->to('Home/program');
    }

    

public function donasi()
{
    $model = new M_ps;
    
    // Ambil parameter filter program dari request
    $filter_program = $this->request->getVar('filter_program');  // Mengambil nilai filter_program

    // Jika ada filter, ambil data donasi berdasarkan id_program
    if ($filter_program) {
        $data['oke'] = $model->getDonasiByProgram($filter_program);  // Mengambil donasi berdasarkan program
    } else {
        // Jika tidak ada filter, ambil semua data donasi
        $data['oke'] = $model->join2('donasi', 'program', 'donasi.id_program=program.id_program');
    }

    // Ambil data program untuk dropdown
    $data['yoga'] = $model->tampil('program');
    
    // Ambil setting
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    // Jika ada parameter id_donasi untuk edit
    $id_donasi = $this->request->getVar('id_donasi'); // Ambil ID donasi dari request
    if ($id_donasi) {
        $data['donasi'] = $model->getWhere1('donasi', ['id_donasi' => $id_donasi])->getRow();
    }

    // Log aktivitas
    $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Donasi',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);

    // Render views
    echo view('header', $data);
    echo view('menu');
    echo view('donasi', $data);
    echo view('footer');
}

public function t_donasi(){

    $model = new M_ps;
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
    $data['oke'] = $model->join2('donasi', 'program', 'donasi.id_program=program.id_program');
    $data['yoga'] = $model->tampil('program');
    $id_user = session()->get('id');
$activityLog = [
    'id_user' => $id_user,
    'menu' => 'Masuk ke Tambah User',
    'time' => date('Y-m-d H:i:s')
];
$model->logActivity($activityLog);
    echo view('header', $data);
    echo view('menu');
    echo view('t_donasi', $data);
}




public function aksi_t_donasi()
{
    if(session()->get('id') > 0){
        // Ambil data dari form
        $nama_program = $this->request->getPost('nama_program');
        $nama_pemberi = $this->request->getPost('nama_pemberi');
        $jumlah_donasi = $this->request->getPost('jumlah_donasi');

        // Data donasi untuk disimpan
        $darren = array(
            'id_program' => $nama_program,
            'nama_pemberi' => $nama_pemberi,
            'jumlah_donasi' => $jumlah_donasi,
            'tanggal' => date('Y-m-d')
        );

        // Inisialisasi model
        $model = new M_ps;

        // Tambah data donasi ke tabel donasi
        $model->tambah('donasi', $darren);

        // Ambil data donasi_terkumpul saat ini dari tabel program berdasarkan id_program
        $program = $model->getWhere1('program', ['id_program' => $nama_program])->getRow();

        // Jika data program ditemukan, update donasi_terkumpul
        if ($program) {
            $new_donasi_terkumpul = $program->donasi_terkumpul + $jumlah_donasi; // Menambahkan jumlah donasi yang baru
            // Menggunakan fungsi edit dari model untuk update data
            $model->edit('program', ['donasi_terkumpul' => $new_donasi_terkumpul], ['id_program' => $nama_program]);
        }

        // Redirect kembali ke halaman donasi
        return redirect()->to('home/donasi');
    } else {
        // Jika tidak login, redirect ke halaman login
        return redirect()->to('home/login');
    }
}

public function e_donasi($id_donasi) {  // Terima parameter id_user
    $model = new M_ps;
    
    // Mengambil data setting
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
    
    // Ambil data user berdasarkan id_user yang diterima
    $whereDonasi = array('id_donasi' => $id_donasi);
    $data['oke'] = $model->getWhere1('donasi', $whereDonasi)->getRow();  // Mengambil data user spesifik berdasarkan ID
    $data['yoga'] = $model->tampil('program');
    // Log aktivitas
    $id_user_session = session()->get('id');
    $activityLog = [
        'id_user' => $id_user_session,
        'menu' => 'Masuk ke Edit Donasi',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);

    // Memuat view
    echo view('header', $data);
    echo view('menu');
    echo view('e_donasi', $data);
}

public function aksi_e_donasi()
{
    if(session()->get('id') > 0){
        $nama_program = $this->request->getPost('nama_program');
        $nama_pemberi = $this->request->getPost('nama_pemberi');
        $jumlah_donasi = $this->request->getPost('jumlah_donasi');
        $id = $this->request->getPost('id');
        
        $where = array('id_donasi' => $id);

        // Ambil data donasi lama berdasarkan id_donasi
        $model = new M_ps;
        $donasi_lama = $model->getWhere1('donasi', ['id_donasi' => $id])->getRow();
        
        // Hitung selisih antara jumlah donasi lama dan yang baru
        $selisih = $jumlah_donasi - $donasi_lama->jumlah_donasi;

        // Update data donasi
        $isi = array(
            'id_program' => $nama_program,
            'nama_pemberi' => $nama_pemberi,
            'jumlah_donasi' => $jumlah_donasi,
        );
        
        // Update donasi di tabel donasi
        $model->edit('donasi', $isi, $where);

        // Ambil data donasi_terkumpul saat ini dari tabel program berdasarkan id_program
        $program = $model->getWhere1('program', ['id_program' => $nama_program])->getRow();

        // Jika data program ditemukan, update donasi_terkumpul dengan memperhitungkan selisih
        if ($program) {
            $new_donasi_terkumpul = $program->donasi_terkumpul + $selisih; // Tambahkan selisih ke donasi_terkumpul
            // Menggunakan fungsi edit dari model untuk update data
            $model->edit('program', ['donasi_terkumpul' => $new_donasi_terkumpul], ['id_program' => $nama_program]);
        }

        // Redirect kembali ke halaman donasi
        return redirect()->to('home/donasi');
    } else {
        // Jika tidak login, redirect ke halaman login
        return redirect()->to('home/login');
    }
}


public function user(){
    $model = new M_ps;
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
    $data['oke'] = $model->tampil('user');


    $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke User',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
    echo view('header', $data);
    echo view ('menu');
    echo view ('user', $data);
    echo view ('footer');
}



public function t_user(){

    $model = new M_ps;
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
    $data['yoga'] = $model->tampil('user');
    $id_user = session()->get('id');
$activityLog = [
    'id_user' => $id_user,
    'menu' => 'Masuk ke Tambah User',
    'time' => date('Y-m-d H:i:s')
];
$model->logActivity($activityLog);
    echo view('header', $data);
    echo view('menu');
    echo view('t_user', $data);
}


public function aksi_t_user()
{
if(session()->get('id') > 0){
    $username = $this->request->getPost('username');
    $nis = $this->request->getPost('nis');
    $level = $this->request->getPost('level');

    // Menggunakan MD5 untuk hash password "sph"
    $password = md5('sph');

    $darren = array(
        'username' => $username,
        'nis' => $nis,
        'password' => $password,  // Menyimpan password yang telah di-hash
        'level' => $level,
    );

    $model = new M_ps;
    $model->tambah('user', $darren); // Menyimpan data user ke database
    return redirect()->to('home/user');
} else {
    return redirect()->to('home/login');
}
}
public function e_user($id_user) {  // Terima parameter id_user
    $model = new M_ps;
    
    // Mengambil data setting
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
    
    // Ambil data user berdasarkan id_user yang diterima
    $whereUser = array('id_user' => $id_user);
    $data['oke'] = $model->getWhere1('user', $whereUser)->getRow();  // Mengambil data user spesifik berdasarkan ID

    // Log aktivitas
    $id_user_session = session()->get('id');
    $activityLog = [
        'id_user' => $id_user_session,
        'menu' => 'Masuk ke Edit User',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);

    // Memuat view
    echo view('header', $data);
    echo view('menu');
    echo view('e_user', $data);
}


public function aksi_e_user()
{
if(session()->get('id') > 0){
    $username = $this->request->getPost('username');
    $level = $this->request->getPost('level');
    $id = $this->request->getPost('id_user');
        
    $where = array('id_user' => $id);

    $isi = array(
        'username' => $username,
        'level' => $level,
    );

    $model = new M_ps;
    $model->edit('user', $isi, $where); // Menyimpan data user ke database
    return redirect()->to('home/user');
} else {
    return redirect()->to('home/login');
}
}

public function hapus_user($id)
    {
        $model = new M_ps();
        // $this->logdonasiActivity('Menghapus Pemesanan Permanent');
        $where = array('id_user' => $id);
        $model->hapus('user', $where);
    
        return redirect()->to('Home/user');
    }
public function resetpassword($id)
    {
        $model = new M_ps();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Melakukan Reset Password',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
        $model->resetPassword($id);
        return redirect()->to('home/user');
    }



public function setting()
    {
      
                $model = new M_ps;
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

                $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Setting',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
                echo view('header', $data);
                echo view('menu');
                echo view('setting', $data);
                echo view('footer');
           
    }

    public function aksi_e_setting()
    {
        $model = new M_ps();
        // $this->logUserActivity('Melakukan Setting');
        $namaWebsite = $this->request->getPost('namawebsite');
        $id = $this->request->getPost('id');
        $id_user = session()->get('id');
        $where = array('id_setting' => '1');

        $data = array(
            'nama_website' => $namaWebsite,
            'update_by' => $id_user,
            'update_at' => date('Y-m-d H:i:s')
        );

        // Cek apakah ada file yang diupload untuk favicon
        $favicon = $this->request->getFile('img');
        if ($favicon && $favicon->isValid() && !$favicon->hasMoved()) {
            // Beri nama file unik
            $faviconNewName = $favicon->getRandomName();
            // Pindahkan file ke direktori public/images
            $favicon->move(WRITEPATH . '../public/images', $faviconNewName);

            // Tambahkan nama file ke dalam array data
            $data['tab_icon'] = $faviconNewName;
        }

        // Cek apakah ada file yang diupload untuk logo
        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            // Beri nama file unik
            $logoNewName = $logo->getRandomName();
            // Pindahkan file ke direktori public/images
            $logo->move(WRITEPATH . '../public/images', $logoNewName);

            // Tambahkan nama file ke dalam array data
            $data['logo_website'] = $logoNewName;
        }

        // Cek apakah ada file yang diupload untuk logo
        $login = $this->request->getFile('login');
        if ($login && $login->isValid() && !$login->hasMoved()) {
            // Beri nama file unik
            $loginNewName = $login->getRandomName();
            // Pindahkan file ke direktori public/images
            $login->move(WRITEPATH . '../public/images', $loginNewName);

            // Tambahkan nama file ke dalam array data
            $data['login_icon'] = $loginNewName;
        }

        $model->edit('setting', $data, $where);

        // Optionally set a flash message here
        return redirect()->to('home/setting');
    }





public function log_activity(){

	$model = new M_ps;
	$data['users'] = $model->getAllUsers();

	$userId = $this->request->getGet('user_id');

	// Fetch logs with optional filtering
	if (!empty($userId)) {
		$data['logs'] = $model->getLogsByUser($userId);
	} else {
		$data['logs'] = $model->getLogs();
	}
	$where = array('id_setting' => '1');
	$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
	$id_user = session()->get('id');
	$activityLog = [
		'id_user' => $id_user,
		'menu' => 'Masuk ke Log Activity',
		'time' => date('Y-m-d H:i:s')
	];
	$model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
	echo view('log_activity', $data);
	echo view('footer');
}
}
