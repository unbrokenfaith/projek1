namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PeminjamanModel;

class IzinPeminjamanController extends BaseController
{
    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
    }

    public function index()
    {
        // Ambil daftar peminjaman yang belum dikonfirmasi
        $peminjamanBelumDikonfirmasi = $this->peminjamanModel->getBelumDikonfirmasi();

        // Tampilkan data pada view
        return view('admin/izinpeminjaman/index', ['peminjamanBelumDikonfirmasi' => $peminjamanBelumDikonfirmasi]);
    }
}
