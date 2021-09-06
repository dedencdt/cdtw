// ini adalah shortcod untuk PAgination
// tidak di gunakakn dengan fungsi

/**
* @var basepage , Masukan Url Method atau basepage
* @var per_page , setting limit data yang ingin di tampilkan
* ===============
* CONTROLLER
* ============
*/

$basepage = 'user/index/'; // url
$per_page = 10; // masukan baris limit data

//ambil data search
if ($this->input->post('search')) {
$data['keyword'] = $this->input->post('keyword');
$this->session->set_userdata('keyword', $data['keyword']);
} else {
$data['keyword'] = null;
}

//configurasi pagination
$config['total_rows'] = $this->user_m->countAll($data['keyword']); //ambil count ALl di Model


$config['per_page'] = $per_page;
$config['base_url'] = base_url() . $basepage;
$data['start'] = $this->uri->segment(3);
$data['total_rows'] = $config['total_rows'];


//initialize
$this->pagination->initialize($config);
$data['row'] = $this->user_m->getData($config['per_page'], $data['start'], $data['keyword']);


/**
* @var tableName , Masukan Nama Tabel
* @var arr , Masukan OR Like
* ===============
* MODEL
* ============
*/

var $tableName = 'tb_user';

// Seting Configurasi
// Query Like
private function _setQueryLike($keyword = null)
{
// edit OR Like disini
$arr = [
'nama' => $keyword,
'username' => $keyword,
'role' => $keyword
];
return $this->db->or_like($arr);
}

// Setting Query
private function _setQuery($limit, $start, $keyword = null)
{
$this->db->from($this->tableName);
if ($keyword) {
$this->_setQueryLike($keyword);
}
$this->db->limit($limit, $start);
}



private function _getQueryLike($keyword = null)
{
return $this->_setQueryLike($keyword);
}



public function countAll($keyword = null)
{
$this->_getQueryLike($keyword);
$this->db->from($this->tableName);
return $this->db->count_all_results();
}

public function getData($limit, $start, $keyword = null)
{
$this->_setQuery($limit, $start, $keyword);
return $this->db->get();
}
// Batas PAgination



/**
* ===============
* VIEW
* ============
*/

<!-- PENCARIAN INPUT -->
<div class="row mt-3">
    <div class="col">
        <div class="col-md-8 col-sm-8 col-lg-5 float-right">
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="keyword" class="form-control" placeholder="Search Keyword.." autocomplete="off">
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" value="Cari" name="search" id="search">
                    </div>
                </div>
            </form>
        </div>
        <span>Results : <?= $total_rows = $total_rows  != 0 ? " <strong>  {$total_rows} </strong> " : '<strong class="alert alert-danger alert-dismissible fade show">Data tidak di temukan!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></strong>' ?></span>
    </div>
</div>
<!-- BATAS PENCARIAN -->

<!-- PASANG PAGINATION -->
<?= $this->pagination->create_links() ?>