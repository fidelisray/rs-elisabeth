<!-- halaman jadwal-->

<?php
    date_default_timezone_set('Asia/Jakarta');

    $baseURL = "https://latu.rs-elisabeth.com/medinfrasapi/rsses";
    $endpoint = "/api/physician/list/doctor-schedule/PL-02";

    $consid = "123456";
    $secretKey = "0034T2";

    $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
    $signature = hash_hmac('sha256', $tStamp . $consid, $secretKey, true);
    $encodedSignature = base64_encode($signature);

    $headers = array(
        "X-Cons-ID: " . $consid,
        "X-Timestamp:" . $tStamp,
        "X-Signature: " . $encodedSignature,
        "Content-Type: Application/JSON"
    );

    $ch = curl_init();

    // curl_setopt($ch, CURLOPT_URL, "https://latu.rs-elisabeth.com/medinfrasapi/rsses/api/reference/master/lst_hsu");
    curl_setopt($ch, CURLOPT_URL, $baseURL.$endpoint);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $array_response = json_decode($response, true);
    
    curl_close($ch);
    
    dd($array_response);
?>


<div class="container-fluid page-header-fasilitas py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
	<div class="container text-center py-5">
		<h1 class="display-4 text-white animated slideInDown mb-3">Dokter Kami</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
				<li class="breadcrumb-item text-warning active" aria-current="page">Dokter Kami</li>
			</ol>
		</nav>
	</div>
</div>
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-8">
                <div class="card-body">

                    <div class="row align-items-end g-3">
                        <div class="col-md-12">
                            <h6 class="section-title bg-white text-start text-primary pe-3">Pilih Klinik</h6>

                            <select class="form-select" id="poli">
                                <?php
                                date_default_timezone_set('Asia/Jakarta');

                                $consid = "123456";
                                $secretKey = "0034T2";

                                $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
                                $signature = hash_hmac('sha256', $tStamp . $consid, $secretKey, true);
                                $encodedSignature = base64_encode($signature);

                                $headers = array(
                                    "X-Cons-ID: " . $consid,
                                    "X-Timestamp:" . $tStamp,
                                    "X-Signature: " . $encodedSignature,
                                    "Content-Type: Application/JSON"
                                );

                                dd($headers);

                                $ch = curl_init();

                                curl_setopt($ch, CURLOPT_URL, "https://latu.rs-elisabeth.com/medinfrasapi/rsses/api/reference/master/lst_hsu");
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                $response = curl_exec($ch);
                                $array_response = json_decode($response, true);

                                $msg = $array_response['Status'];
                                $data = json_decode(stripslashes($array_response['Data']), true);

                                $output = '';
                                $i = 0;

                                if ($msg == 'SUCCESS') {

                                    foreach ($data as $key => $jadwal) {

                                        if (strpos($jadwal['Name'], 'OUTPATIENT')) {

                                            if (
                                                strpos($jadwal['Name'], 'FAUSTINA') ||
                                                strpos($jadwal['Name'], 'RAFAEL') ||
                                                strpos($jadwal['Name'], 'UMUM')
                                            ) {

                                                echo '';

                                            } else {

                                                $i++;

                                                $selected = ($i < 2) ? 'selected' : '';

                                                $nama_poli = str_replace('|OUTPATIENT', '', $jadwal['Name']);

                                                $output .= '
                                                    <option 
                                                        value="' . $jadwal['Code'] . '" 
                                                        data-poli="' . $jadwal['Name'] . '"
                                                        ' . $selected . '>
                                                        ' . $nama_poli . '
                                                    </option>
                                                ';
                                            }
                                        }
                                    }
                                }

                                curl_close($ch);

                                echo $output;
                                ?>
                            </select>

                        </div>
                    </div>
            </div>

            <div class="card border-0 mt-4">
                <div class="card-body">
                    <div class="col-12" id="datajadwal">
                        <div class="text-center text-muted py-5">
                            Silakan pilih klinik
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

<script>
    $(document).ready(function () {

        let poli = $('#poli').val();

        load_data(poli);

        function load_data(query) {

            $('#loadingText').removeClass('d-none');

            $('#datajadwal').html(`
                <div class="text-center py-5">
                    <div class="spinner-border text-primary mb-3" role="status"></div>
                    <div class="text-muted">
                        Sedang mengambil data jadwal...
                    </div>
                </div>
            `);

            $.ajax({
                url: "process/carijadwal.php",
                method: "POST",
                data: {
                    query: query
                },

                success: function (data) {

                    $('#loadingText').addClass('d-none');

                    $('#datajadwal').hide().html(data).fadeIn(200);
                },

                error: function () {

                    $('#loadingText').addClass('d-none');

                    $('#datajadwal').html(`
                        <div class="alert alert-danger mb-0">
                            Gagal mengambil data jadwal.
                        </div>
                    `);
                }
            });
        }

        $('#poli').change(function () {

            let poli = $('#poli').val();

            load_data(poli);
        });

    });
</script>