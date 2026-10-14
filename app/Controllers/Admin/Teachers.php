<?php

namespace App\Controllers\Admin;

use App\Models\TeacherModel;

class Teachers extends BaseController
{
    protected $teacherModel;

    /**
     * Initialize controller.
     *
     * @param \CodeIgniter\HTTP\RequestInterface  $request
     * @param \CodeIgniter\HTTP\ResponseInterface $response
     * @param \Psr\Log\LoggerInterface            $logger
     */
    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);
        $this->teacherModel = new TeacherModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        $this->data['title'] = 'Guru & Tenaga Pendidik';
        $this->data['items'] = $this->teacherModel->orderBy('sort_order', 'ASC')->paginate(10);
        $this->data['pager'] = $this->teacherModel->pager;

        return view('admin/teachers/index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function new()
    {
        $this->data['title'] = 'Tambah Guru';
        $this->data['item']  = [];
        return view('admin/teachers/form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function create()
    {
        $data = $this->request->getPost();
        $data['show'] = $data['show'] ?? 0;

        $newPhotoToDeleteOnFailure = null;
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploaded = $this->uploadAndResizePhoto($file);
            if (!$uploaded) {
                return redirect()->back()->withInput()->with('error', 'Foto tidak valid. Gunakan JPG, PNG, atau WEBP, maksimal 8 MB dan 16 megapiksel.');
            }
            $data['photo'] = $uploaded;
            $newPhotoToDeleteOnFailure = $uploaded;
        }

        if (!$this->teacherModel->insert($data)) {
            if ($newPhotoToDeleteOnFailure) {
                $newPath = FCPATH . 'uploads/teachers/' . basename($newPhotoToDeleteOnFailure);
                if (is_file($newPath)) { @unlink($newPath); }
            }
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data guru.');
        }

        return redirect()->to('/admin/teachers')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function edit($id)
    {
        $this->data['title'] = 'Edit Guru';
        $this->data['item']  = $this->teacherModel->find($id);

        if (!$this->data['item']) {
            return redirect()->to('/admin/teachers')->with('error', 'Data guru tidak ditemukan.');
        }

        return view('admin/teachers/form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update($id)
    {
        $data = $this->request->getPost();
        $data['show'] = $data['show'] ?? 0;

        $oldPhotoToDelete = null;
        $newPhotoToDeleteOnFailure = null;
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $old = $this->teacherModel->find($id);
            $uploaded = $this->uploadAndResizePhoto($file);
            if (!$uploaded) {
                return redirect()->back()->withInput()->with('error', 'Foto tidak valid. Gunakan JPG, PNG, atau WEBP, maksimal 8 MB dan 16 megapiksel.');
            }
            $data['photo'] = $uploaded;
            if (!empty($old['photo']) && !preg_match('#^https?://#', $old['photo'])) {
                $oldPhotoToDelete = basename($old['photo']);
            }
            $newPhotoToDeleteOnFailure = $uploaded;
        }

        if (!$this->teacherModel->update($id, $data)) {
            if ($newPhotoToDeleteOnFailure) {
                $newPath = FCPATH . 'uploads/teachers/' . basename($newPhotoToDeleteOnFailure);
                if (is_file($newPath)) { @unlink($newPath); }
            }
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data guru.');
        }

        if ($oldPhotoToDelete) {
            $oldPath = FCPATH . 'uploads/teachers/' . $oldPhotoToDelete;
            if (is_file($oldPath)) { @unlink($oldPath); }
        }

        return redirect()->to('/admin/teachers')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Reorder resources via drag-and-drop.
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function reorder()
    {
        $input = json_decode($this->request->getBody(), true);
        $ids = $input['ids'] ?? [];

        if (empty($ids)) {
            return $this->response->setJSON(['success' => false]);
        }

        $this->teacherModel->reorder($ids);

        return $this->response->setJSON(['success' => true, 'csrfHash' => csrf_hash()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete($id)
    {
        $teacher = $this->teacherModel->find($id);
        if ($teacher && !empty($teacher['photo']) && !preg_match('#^https?://#', $teacher['photo'])) {
            $file = FCPATH . 'uploads/teachers/' . $teacher['photo'];
            if (is_file($file)) {
                unlink($file);
            }
        }

        if (!$this->teacherModel->delete($id)) {
            return redirect()->to('/admin/teachers')->with('error', 'Gagal menghapus data guru.');
        }

        return redirect()->to('/admin/teachers')->with('success', 'Data guru berhasil dihapus.');
    }

    /**
     * Upload and resize a photo.
     *
     * @param \CodeIgniter\HTTP\Files\UploadedFile $file
     *
     * @return string
     */
    private function uploadAndResizePhoto($file): ?string
    {
        return $this->storeValidatedImage($file, 'uploads/teachers', 400);
    }
}
