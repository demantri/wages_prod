<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('User_m');
	}

	public function index()
	{
		$data = array(
			'title'    => 'User',
			'user'     => infoLogin(),
			'toko'     => $this->db->get('profil_perusahaan')->row(),
			'content'  => 'user/index'
		);
		$this->load->view('templates/main', $data);
	}

	public function LoadData()
	{
		$json = array(
			"aaData"  => $this->User_m->getAllData()
		);
		echo json_encode($json);
	}

	public function inputuser()
	{
		$this->User_m->Save();
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><aria-hidden="true">×</span> </button><b>Success!</b> Data User berhasil disimpan.</div>');
		redirect('user');
	}

	public function detiluser($id = '')
	{
		$data = $this->User_m->Detail($id);
		echo json_encode($data);
	}

	public function edituser()
	{
		$this->User_m->Edit();
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><aria-hidden="true">×</span> </button><b>Success!</b> Data User berhasil diubah.
	</div>');
		redirect('user');
	}

	public function hapususer($id = '')
	{
		$this->User_m->Delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><aria-hidden="true">×</span> </button><b>Success!</b> Data User berhasil dihapus.</div>');
	}

	public function change_password()
	{
		$this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'required|trim|matches[konfirmasi_pass]');
		$this->form_validation->set_rules('konfirmasi_pass', 'Konfirmasi Password', 'required|trim|matches[password_baru]');

		$data = array(
			'title'    => 'Ubah Password',
			'user'     => infoLogin(),
			'toko'     => $this->db->get('profil_perusahaan')->row(),
			'content'  => 'user/change_password'
		);

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/main', $data);
		} else {
			$user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$password = $this->input->post('password_lama');
			$new_pass = $this->input->post('password_baru');

			if (!password_verify($password, $user['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><aria-hidden="true">×</span> </button><b>Error!</b> Password Salah!
				</div>');
				redirect('user/change_password');
			} else {
				if ($password == $new_pass) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><aria-hidden="true">×</span> </button><b>Error!</b> Password baru tidak boleh sama dengan password lama!</div>');
					redirect('user/change_password');
				} else {
					$this->db->set('password', password_hash($new_pass, PASSWORD_DEFAULT));
					$this->db->where('username', $this->session->userdata('username'));
					$this->db->update('user');
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><aria-hidden="true">×</span> </button><b>Success!</b> Password berhasil diubah!</div>');
					redirect('user/change_password');
				}
			}
		}
	}
}
