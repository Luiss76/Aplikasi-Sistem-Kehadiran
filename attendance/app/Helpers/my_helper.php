<?php
if (!function_exists('menu_manajemen'))
{
    function menu_manajemen($items, $class = 'dd-list')
    {
        $html = "<ol class=\"" . $class . "\" id=\"menu-id\">";
        if (is_array($items)){
            foreach ($items as $key => $value){
                $html .= '<li class="dd-item dd2-item" data-id="'.$value['id'] . '" >
							<div class="dd-handle dd2-handle">
								<i class="normal-icon fa ' . $value['icon'] . ' blue bigger-130"></i>
								<i class="drag-icon fa fa-angle-right bigger-125"></i>
							</div>
							<div class="dd2-content">
									<span id="label_show' . $value['id'] . '">' . $value['label'] . '</span> 
									<span class="pull-right">
										<span id="modul_show' . $value['id'] . '">/' . $value['modul'] . '</span> &nbsp;&nbsp; 
										<a title="Edit" class="edit-button" id="' . $value['id'] . '" label="' . $value['label'] . '" modul="' . $value['modul'] . '" deskripsi="' . $value['deskripsi'] . '" icon="' . $value['icon'] . '">
											<i class="fa fa-edit blue bigger-130"></i>
										</a>
										<a title="Delete" class="del-button" id="' . $value['id'] . '">
											<i class="fa fa-trash blue bigger-130"></i>
										</a>
									</span> 
							</div>';
                if (array_key_exists('child', $value)){
                    $html .= menu_manajemen($value['child'], 'child');
                }
                $html .= "</li>";
            }
            $html .= "</ol>";
        }
        return $html;
    }
}

if (!function_exists('menu_frontend'))
{
    function menu_frontend($items)
    {
        $html = "";
        if (is_array($items)){
            foreach ($items as $key => $value){
                if (array_key_exists('child', $value)){
                    $html .= '<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-' . $value['id'] . '" aria-expanded="true" aria-controls="collapse-' . $value['id'] . '">
							<i class="fas fa-fw ' . $value['icon'] . '"></i>
							<span>' . $value['label'] . '</span>
						</a>
						<div id="collapse-' . $value['id'] . '" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner rounded">';
								if (is_array($value['child'])){
									foreach ($value['child'] as $keys => $values){
										$html .= '<a class="collapse-item" href="' . site_url($values['modul']) . '">' . $values['label'] . '</a>';
									}
								}
					$html .= '</div>
						</div>';
                }else{
                    $html .= '
					<li class="nav-item">
						<a class="nav-link" href="' . site_url($value['modul']) . '">
							<i class="fas fa-fw ' . $value['icon'] . '"></i>
							<span>' . $value['label'] . '</span></a>
					</li>';
                }
            }
        }
        return $html;
    }
}

if (!function_exists('menu_frontend_child'))
{
    function menu_frontend_child($items)
    {
        $html = "";
        if (is_array($items)){
            foreach ($items as $key => $value){
                $html .= '
				<li class="nav-item">
					<a class="nav-link" href="' . site_url($value['modul']) . '">
						<i class="fas fa-fw ' . $value['icon'] . '"></i>
						<span>' . $value['label'] . '</span></a>
				</li>';
            }
        }
        return $html;
    }
}

if (!function_exists('tgl_indo'))
{
    function tgl_indo($tgl)
    {
        if ($tgl != ''){
            $ubah = gmdate($tgl, time() + 60 * 60 * 8);
            $pecah = explode("-", $ubah);
            $tanggal = $pecah[2];
            $bulan = bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal . ' ' . $bulan . ' ' . $tahun;
        }else{
            return '';
        }
    }

    function tgl_id($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal;
    }

    function blnthn_indo($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $bulan . ' ' . $tahun;
    }
    function bln_indo($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $bulan;
    }
}

if (!function_exists('bulan'))
{
    function bulan($bln){
        switch ($bln){
            case 1:
                return "Januari";
            break;
            case 2:
                return "Februari";
            break;
            case 3:
                return "Maret";
            break;
            case 4:
                return "April";
            break;
            case 5:
                return "Mei";
            break;
            case 6:
                return "Juni";
            break;
            case 7:
                return "Juli";
            break;
            case 8:
                return "Agustus";
            break;
            case 9:
                return "September";
            break;
            case 10:
                return "Oktober";
            break;
            case 11:
                return "November";
            break;
            case 12:
                return "Desember";
            break;
        }
    }
}

if (!function_exists('nama_hari'))
{
    function nama_hari($tanggal){
        if ($tanggal != ''){
            $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
            $pecah = explode("-", $ubah);
            $tgl = $pecah[2];
            $bln = $pecah[1];
            $thn = $pecah[0];
            $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
            switch ($nama){
				case "Sunday":
					return "Minggu";
				break;
				case "Monday":
					return "Senin";
				break;
				case "Tuesday":
					return "Selasa";
				break;
				case "Wednesday":
					return "Rabu";
				break;
				case "Thursday":
					return "Thursday";
				break;
				case "Friday":
					return "Jumat";
				break;
				case "Saturday":
					return "Sabtu";
				break;
			}	
        }else{
            return '';
        }
    }
}

if (!function_exists('hitung_mundur'))
{
    function hitung_mundur($wkt)
    {
        $waktu = array(
            365 * 24 * 60 * 60 => "tahun",
            30 * 24 * 60 * 60 => "bulan",
            7 * 24 * 60 * 60 => "minggu",
            24 * 60 * 60 => "hari",
            60 * 60 => "jam",
            60 => "menit",
            1 => "detik"
        );

        $hitung = strtotime(gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8)) - $wkt;
        $hasil = array();
        if ($hitung < 5){
            $hasil = '' . $hitung . ' detik yang lalu';
        }else{
            $stop = 0;
            foreach ($waktu as $periode => $satuan){
                if ($stop >= 6 || ($stop > 0 && $periode < 60)) break;
                $bagi = floor($hitung / $periode);
                if ($bagi > 0){
                    $hasil[] = $bagi . ' ' . $satuan;
                    $hitung -= $bagi * $periode;
                    $stop++;
                }
                else if ($stop > 0) $stop++;
            }
            $hasil = implode(' ', $hasil) . ' yang lalu';
        }
        return $hasil;
    }

}

if (!function_exists('hitung_usia'))
{
    function hitung_usia($tanggal_lahir){
        $birthDate = new DateTime($tanggal_lahir);
        $today = new DateTime("today");
        if ($birthDate < $today){
            $y = $today->diff($birthDate)->y;
            $m = $today->diff($birthDate)->m;
            $d = $today->diff($birthDate)->d;
            return $y;
        }
    }
}

if (!function_exists('get_month'))
{
    function get_month(){
        $data=array('1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni','7'=>'Juli','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		return $data;
    }
}

if (!function_exists('get_year')){
    function get_year(){
        $data		= array();
		$firstYear 	= (int)date('Y') - 5;
		$lastYear 	= (int)date('Y');
		for($tahun=$lastYear;$tahun>=$firstYear;$tahun--){
			 $data[] = $tahun;
		}
		return $data;
    }
}
